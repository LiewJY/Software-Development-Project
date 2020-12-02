<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attribute that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'contact_number'
    ];

    /**
     * To disable timestamps on employee table
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * To define the one to one relationship on Users table
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * To defince the one to many relationship on  maintenances table
     *
     * @return void
     */
    public function maintenances()
    {
        return $this->hasMany('App\Models\Maintenance');
    }
}
