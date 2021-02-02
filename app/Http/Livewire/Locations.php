<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class Locations extends Component
{    

    /**
     * Show all locations page
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $locations = Location::all();
        return view('livewire.locations', ['locations' => $locations])->layout('layouts.page');
    }
    
    /**
     * Redirect to selected location's details
     *
     * @param  int $details
     * @return void
     */
    public function locations($details)
    {
        return redirect()->route('locationDetails', ['id' => $details]);
    }
}
