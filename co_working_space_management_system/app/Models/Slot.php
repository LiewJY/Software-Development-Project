<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    /**
     * Disable timestamp
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define many to many relationship on rooms table
     *
     * @return void
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    /**
     * Get the reservations for the time slot
     *
     * @return void
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
