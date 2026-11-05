<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationPayment;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Menampilkan daftar reservasi
    public function index()
    {
        $reservations = Reservation::with('payments')->orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $reservations
        ]);
    }

    // Update status reservasi
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'status' => 'required|in:menunggu,dikonfirmasi,ditolak'
    ]);

    $reservation = Reservation::findOrFail($id);

    // Kalau admin mau mengonfirmasi
    if ($validated['status'] === 'dikonfirmasi') {

        $tamuSudahDikonfirmasi = Reservation::whereDate(
                'date',
                $reservation->date
            )
            ->where('status', 'dikonfirmasi')
            ->where('id', '!=', $reservation->id)
            ->where('start_time', '<', $reservation->end_time)
            ->where('end_time', '>', $reservation->start_time)
            ->sum('guests');

        $totalJikaDikonfirmasi =
            $tamuSudahDikonfirmasi + (int) $reservation->guests;

        if ($totalJikaDikonfirmasi > 100) {

            $sisa = max(
                0,
                100 - $tamuSudahDikonfirmasi
            );

            return response()->json([
                'success' => false,
                'message' =>
                    "Reservasi tidak dapat dikonfirmasi. Kapasitas tersisa hanya {$sisa} orang, sedangkan reservasi ini berjumlah {$reservation->guests} orang."
            ], 422);
        }
    }

    $reservation->update([
        'status' => $validated['status']
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Status reservasi berhasil diperbarui.',
        'data' => $reservation->fresh()
    ]);
}

    // Hapus reservasi
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dihapus'
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