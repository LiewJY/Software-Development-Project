<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;


class Locations extends Component
{
    public function render()
    {
        $locations = DB::select('SELECT * FROM locations');
        return view('livewire.locations', ['locations' => $locations]);
    }
}
