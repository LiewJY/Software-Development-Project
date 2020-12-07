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
}
