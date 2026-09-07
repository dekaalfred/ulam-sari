<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Menampilkan daftar reservasi
    public function index()
    {
        $reservations = Reservation::orderBy('id', 'desc')->get();

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

        $reservation->update([
            'status' => $validated['status']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status reservasi berhasil diperbarui',
            'data' => $reservation
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
}