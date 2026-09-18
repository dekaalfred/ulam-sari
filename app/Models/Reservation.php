<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
protected $fillable = [
    'customer', 
    'date',
    'time', 
    'guests', 
    'table_count',
    'phone', 
    'notes', 
    'status', 
    'dp_amount', 
    'reservation_code',
    'start_time', 
    'end_time',
];

    protected static function booted(): void
    {
        static::creating(function (Reservation $reservation) {
            if (empty($reservation->reservation_code)) {
                $reservation->reservation_code = static::generateCode();
            }
        });
    }

    public static function generateCode(): string
    {
        do {
            $code = 'RSV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (static::where('reservation_code', $code)->exists());

        return $code;
    }

    public function payments()
    {
        return $this->hasMany(ReservationPayment::class);
    }
    protected $casts = [
    'start_time' => 'datetime:H:i',
    'end_time'   => 'datetime:H:i',
    ];

    /**
     * Total tamu yang sudah "menempati" rentang waktu tertentu di tanggal tertentu.
     * Cuma hitung reservasi yang masih aktif (belum ditolak/dibatalkan).
     */
    public static function totalTamuOverlap(string $tanggal, string $mulai, string $selesai, ?int $kecualikanId = null): int
    {
        $query = static::where('date', $tanggal)
            ->whereIn('status', ['menunggu', 'dikonfirmasi'])
            ->where('start_time', '<', $selesai)   // mulai sebelum acara lain selesai
            ->where('end_time', '>', $mulai);      // selesai sesudah acara lain mulai
            // dua baris di atas = syarat overlap waktu standar

        if ($kecualikanId) {
            $query->where('id', '!=', $kecualikanId);
        }

        return (int) $query->sum('guests');
    }
}