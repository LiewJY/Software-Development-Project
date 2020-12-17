<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Location;


class LocationTable extends Component
{

    public $search='';
    protected $queryString = ['search'];


    public function render()
    {
        return view('livewire.admin.location-table',[
            'locations' => location::where('name', 'like', '%'.$this->search.'%')->paginate(1),
        ]);


    }
}
