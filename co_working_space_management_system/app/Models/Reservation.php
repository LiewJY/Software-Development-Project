<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'room_id', 'slot_id', 'reservation_date'
    ];

    /**
     * Disable timestamps on reservation table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the reserved room
     *
     * @return void
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * get the slot of the reservation
     *
     * @return void
     */
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    /**
     * get the payment of the reservation
     *
     * @return void
     */
    public function reservationpayment()
    {
        return $this->belongsTo('App\Models\ReservationPayment', 'reservation_payment_id');
    }
}
