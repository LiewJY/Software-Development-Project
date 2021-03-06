<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    /**
     * Disable timestamp on membership table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the user's membership payment
     *
     * @return void
     */
    public function membership_payments()
    {
        return $this->hasMany(MembershipPayment::class);
    }
}
