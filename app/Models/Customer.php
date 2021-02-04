<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'address', 'contact_number'];

    /**
     * Disable timestamp on customer table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the user's details
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the reservation's payment of the customer
     *
     * @return void
     */
    public function reservationpayment()
    {
        return $this->hasMany(ReservationPayment::class);
    }
}
