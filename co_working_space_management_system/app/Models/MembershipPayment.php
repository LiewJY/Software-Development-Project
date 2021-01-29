<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    use HasFactory;

    /**
     * Declare that the table doesnt have timestamp
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'membership_id',
        'user_id',
        'expired_on'
    ];

    /**
     * Get user who made the membership's paymenr
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the membership details
     *
     * @return void
     */
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
