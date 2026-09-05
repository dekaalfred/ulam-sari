<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationPayment;
use App\Models\Setting;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nomor_whatsapp' => 'required|numeric|digits_between:10,14',
            'tanggal_acara'  => 'required|date',
            'jumlah_peserta' => 'required|integer|min:1',
            'jumlah_meja'    => 'required|integer|min:1',
            'waktu_acara'    => 'required',
            'catatan'        => 'nullable|string',
            'bukti_transfer' => 'required|image|max:4096',
        ]);

        $dpPerPeserta = (int) Setting::get('dp_per_peserta', 10000);
        $dpAmount = $dpPerPeserta * (int) $validated['jumlah_peserta'];

        $reservation = Reservation::create([
            'customer'     => $validated['nama_lengkap'],
            'date'         => $validated['tanggal_acara'],
            'time'         => $validated['waktu_acara'],
            'guests'       => $validated['jumlah_peserta'],
            'table_count'  => $validated['jumlah_meja'],
            'phone'        => $validated['nomor_whatsapp'],
            'notes'        => $validated['catatan'] ?? null,
            'dp_amount'    => $dpAmount,
            'status'       => 'menunggu',
        ]);

        $proofPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        ReservationPayment::create([
            'reservation_id' => $reservation->id,
            'payment_method' => 'manual',
            'amount'         => $dpAmount,
            'payment_proof'  => $proofPath,
            'status'         => 'pending',
        ]);

return response()->json([
    'message' => 'Reservasi berhasil disimpan',
    'data' => [
        'kode_reservasi' => $reservation->reservation_code,
        'nama_lengkap'   => $reservation->customer,
        'jumlah_peserta' => $reservation->guests,
        'nominal_dp'     => $reservation->dp_amount,
    ],
], 201);}}