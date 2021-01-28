<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LocationRooms extends Component
{
    public function render()
    {
        return view('livewire.location-rooms')->layout('layouts.page');
    }
}
