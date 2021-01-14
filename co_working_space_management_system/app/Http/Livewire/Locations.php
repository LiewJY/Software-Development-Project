<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class Locations extends Component
{
    public function render()
    {
        $locations = Location::all();
        return view('livewire.locations', ['locations' => $locations]);
    }

    public function locations($details)
    {
        return redirect()->route('locationDetails', ['id' => $details]);
    }
}
