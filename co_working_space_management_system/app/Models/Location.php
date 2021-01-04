<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'description'
    ];

    /**
     * To disable timestamp on locations table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define one to many relationship to rooms table
     *
     * @return void
     */
    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    /**
     * Get all of the maintenances for the location.
     *
     * @return void
     */
    public function maintenances()
    {
        return $this->hasManyThrough(Maintenance::class, Room::class);
    }

    /**
     * Get the count of maintenance of the location.
     *
     * @return void
     */
    public function maintenanceCount()
    {
        return $this->maintenances()->where('status', 0)->count();
    }
}
