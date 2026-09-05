<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationPayment extends Model
{
    protected $fillable = [
        'reservation_id', 'verified_by', 'payment_method', 'amount',
        'payment_proof', 'midtrans_order_id', 'snap_token',
        'midtrans_transaction_id', 'transaction_status',
        'expired_at', 'status', 'paid_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}