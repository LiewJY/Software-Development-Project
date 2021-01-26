<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'employee_id',
        'description',
        'status'
    ];

    /**
     * Disable timestamps on maintenances table
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Get the room of the maintenance
     *
     * @return void
     */
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    /**
     * Get the employee's details that made the maintenance
     *
     * @return void
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
