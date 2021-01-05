<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
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
     * Define one to one relationship to user table
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * get the reservation patmnet of the customer
     *
     * @return void
     */
    public function reservationpayment()
    {
        return $this->hasMany(ReservationPayment::class);
    }
}
