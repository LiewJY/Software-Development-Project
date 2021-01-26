<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPayment extends Model
{
    use HasFactory;

    /**
     * Properties that are mass assignable
     *
     * @var array
     */
    protected  $fillable = [
        'customer_id', 'amount_paid', 'balance'
    ];

    /**
     * get the reservation of the payment
     *
     * @return void
     */
    public function reservation()
    {
        return $this->hasOne('App\Models\Reservation', 'reservation_payment_id');
    }

    /**
     * Get the customer info of the reservation
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
