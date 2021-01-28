<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Location;

class LocationDetails extends Component
{

    public $details, $details_id;

    public function mount($id)
    {
        $this->details_id = $id;
        $this->details = Location::findorFail($id);
    }

    public function render()
    {
        return view('livewire.customer.location-details', [
            'locationdetails' => Location::all()
                ->where('id', '=', $this->details_id)
        ])->layout('layouts.page');
    }
}
