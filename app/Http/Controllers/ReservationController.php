<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationPayment;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\MidtransService;

class ReservationController extends Controller
{
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_lengkap'      => 'required|string|max:255',
        'nomor_whatsapp'    => ['required', 'regex:/^08[0-9]{8,12}$/'],
        'tanggal_acara'     => 'required|date',
        'jumlah_peserta'    => 'required|integer|min:1',
        'jam_mulai'         => 'required|date_format:H:i',
        'jam_selesai'       => 'required|date_format:H:i|after:jam_mulai',
        'catatan'           => 'nullable|string',
        'metode_pembayaran' => 'required|in:dp_qris,bayar_ditempat',
        'bukti_transfer'    => 'required_if:metode_pembayaran,dp_qris|nullable|image|max:4096',
    ]);

    $mulai = $validated['jam_mulai'];
    $selesai = $validated['jam_selesai'];
    $isQris = $validated['metode_pembayaran'] === 'dp_qris';

    // ===== CEK KAPASITAS (cuma 1 blok, gak dobel lagi) =====
    $tamuSudahAda = Reservation::totalTamuOverlap($validated['tanggal_acara'], $mulai, $selesai);
    $sisaKapasitas = max(0, 100 - $tamuSudahAda);

    if ((int) $validated['jumlah_peserta'] > $sisaKapasitas) {
        $pesan = "Kapasitas tidak mencukupi. Saat ini sudah ada {$tamuSudahAda} orang pada jam {$mulai}-{$selesai}. Kapasitas tersisa hanya {$sisaKapasitas} orang.";

        if ($request->wantsJson()) {
            return response()->json(['message' => $pesan], 422);
        }

        return back()->withInput()->with('error', $pesan);
    }
    // ===== AKHIR CEK KAPASITAS =====

    $dpPerPeserta = (int) Setting::get('dp_per_peserta', 10000);
    $dpAmount = $dpPerPeserta * (int) $validated['jumlah_peserta'];

    $reservation = Reservation::create([
        'customer'    => $validated['nama_lengkap'],
        'date'        => $validated['tanggal_acara'],
        'time'        => $mulai . ' - ' . $selesai,
        'start_time'  => $mulai,
        'end_time'    => $selesai,
        'guests'      => $validated['jumlah_peserta'],
        'phone'       => $validated['nomor_whatsapp'],
        'notes'       => $validated['catatan'] ?? null,
        'dp_amount'   => $isQris ? $dpAmount : null,
        'status'      => 'menunggu',
    ]);

    if ($isQris) {
        $proofPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');
        ReservationPayment::create([
            'reservation_id' => $reservation->id,
            'payment_method' => 'manual',
            'amount'         => $dpAmount,
            'payment_proof'  => $proofPath,
            'status'         => 'pending',
        ]);
    } else {
        ReservationPayment::create([
            'reservation_id' => $reservation->id,
            'payment_method' => 'bayar_ditempat',
            'amount'         => 0,
            'status'         => 'pending',
        ]);
    }

    if ($request->wantsJson()) {
        return response()->json([
            'message' => 'Reservasi berhasil disimpan',
            'data' => [
                'kode_reservasi' => $reservation->reservation_code,
                'nama_lengkap'   => $reservation->customer,
                'jumlah_peserta' => $reservation->guests,
                'nominal_dp'     => $reservation->dp_amount,
            ],
        ], 201);
    }

    return back()->with('success', 'Reservasi berhasil dikirim! Kode reservasi Anda: ' . $reservation->reservation_code . '. Pembayaran dilakukan penuh langsung di restoran.');
}

public function cekKetersediaan(Request $request)
{
    $validated = $request->validate([
        'tanggal' => 'required|date',
        'peserta' => 'required|integer|min:1',
    ]);

    $tanggal = $validated['tanggal'];
    $jumlahPeserta = (int) $validated['peserta'];

    $slots = [];

    $jamBuka = strtotime('09:00');
    $jamTutup = strtotime('21:00');

    // Buat slot per 1 jam
    for ($t = $jamBuka; $t < $jamTutup; $t += 3600) {

        $mulai = date('H:i', $t);
        $selesai = date('H:i', $t + 3600);

        $terisi = Reservation::totalTamuOverlap(
            $tanggal,
            $mulai,
            $selesai
        );

        $kapasitas = 100;
        $tersisa = max(0, $kapasitas - $terisi);

        $penuh = $terisi >= $kapasitas;
        $bisaDipilih = !$penuh && $tersisa >= $jumlahPeserta;

        $slots[] = [
            'mulai' => $mulai,
            'selesai' => $selesai,
            'terisi' => $terisi,
            'kapasitas' => $kapasitas,
            'tersisa' => $tersisa,
            'penuh' => $penuh,
            'bisa_dipilih' => $bisaDipilih,
        ];
    }

    return response()->json([
        'success' => true,
        'slots' => $slots,
    ]);
    
}
public function createMidtransPayment(Request $request, $reservationId, MidtransService $midtrans)
{
    $reservation = Reservation::findOrFail($reservationId);

    $orderId = $reservation->reservation_code . '-' . now()->timestamp;

    $snapToken = $midtrans->createSnapToken(
        $orderId,
        (int) $reservation->dp_amount,
        [
            'first_name' => $reservation->customer,
            'phone'      => $reservation->phone,
        ]
    );

    ReservationPayment::create([
        'reservation_id'     => $reservation->id,
        'payment_method'     => 'midtrans',
        'amount'             => $reservation->dp_amount,
        'midtrans_order_id'  => $orderId,
        'snap_token'         => $snapToken,
        'transaction_status' => 'pending',
        'status'             => 'pending',
    ]);

    return response()->json([
        'snap_token' => $snapToken,
        'client_key' => config('services.midtrans.client_key'),
    ]);
}

public function midtransNotification(Request $request)
{
    $payload = $request->all();

    $signature = hash('sha512',
        $payload['order_id'] . $payload['status_code'] . $payload['gross_amount']
        . config('services.midtrans.server_key')
    );

    if ($signature !== $payload['signature_key']) {
        \Log::warning('Midtrans notifikasi ditolak: signature tidak cocok', $payload);
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $payment = ReservationPayment::where('midtrans_order_id', $payload['order_id'])->first();

    if (!$payment) {
        return response()->json(['message' => 'Payment not found'], 404);
    }

    $status = $payload['transaction_status'];
    $payment->update([
        'transaction_status' => $status,
        'midtrans_transaction_id' => $payload['transaction_id'] ?? null,
    ]);

    if (in_array($status, ['capture', 'settlement'])) {
        $payment->update(['status' => 'paid', 'paid_at' => now()]);
        $payment->reservation->update(['status' => 'dikonfirmasi']);
    } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
        $payment->update(['status' => $status === 'expire' ? 'expired' : 'rejected']);
    }

    return response()->json(['message' => 'OK']);
}
}