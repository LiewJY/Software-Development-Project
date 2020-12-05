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
     * Define the one to many relationsip to Locations table
     *
     * @return void
     */
    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    /**
     * Define the one to many relationship to maintenances table
     *
     * @return void
     */
    public function maintenance()
    {
        return $this->hasMany('App\Models\Maintenance');
    }

    /**
     * Define many to many relationship on slots table
     *
     * @return void
     */
    public function slots()
    {
        return $this->belongsToMany(Slot::class);
    }
}
