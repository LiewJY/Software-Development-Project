<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;

class LocationTable extends Component
{   
    use WithPagination;
    public $name, $address, $contactNumber, $description, $locationID;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Validation rules that are applied to location 
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required'],
        'address' => ['required', 'max:255'],
        'contactNumber' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/'],
        'description' => ['required', 'max:255']
    ];


    public function render()
    {
        return view('livewire.admin.location-table', [
            'locations' => location::where('name', 'like', '%' . $this->search . '%')->paginate(25),
        ]);
    }

    /**
     * Create or update location 
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate();

        Location::updateOrCreate(['id' => $this->locationID], $validatedData);
        // Location::updateOrCreate(['id' => $this->locationID], [
        //     'name' => $this->name,
        //     'address' => $this->address,
        //     'contact_number' => $this->contactNumber,
        //     'description' =>  $this->description
        // ]);

        session()->flash(
            'message',
            $this->location_id ? 'Location Updated Successfully.' : 'Location Created Successfully.'
        );
    }

    /**
     * Pass location id and it will fill the feilds with data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $this->locationID = $id;
        $this->name = $location->name;
        $this->address = $location->address;
        $this->contactNumber = $location->contact_number;
        $this->description = $location->description;
    }

    /**
     * Delete selected location
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        Location::where('id', $id)->delete();
    }
}
