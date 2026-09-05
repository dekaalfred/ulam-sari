<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = [
        'customer', 'date', 'time', 'guests', 'table_count',
        'phone', 'notes', 'status', 'dp_amount', 'reservation_code',
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
}