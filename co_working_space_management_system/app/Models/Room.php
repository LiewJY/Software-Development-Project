<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'name',
        'description',
        'price',
        'size'
    ];

    /**
     * Disable timestamps on rooms table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the location of the room
     *
     * @return void
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * Get the maintenances of the room
     *
     * @return void
     */
    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function workingRoom()
    {
        return $this->maintenance()->where('status', 1)->get();
    }

    /**
     * Get the slots of the room
     *
     * @return void
     */
    public function slots()
    {
        return $this->belongsToMany(Slot::class);
    }

    /**
     * Get the room reservation
     *
     * @return void
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
