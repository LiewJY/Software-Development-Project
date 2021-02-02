<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Location;

class LocationTable extends Component
{
    use WithPagination;


    /**
     * Edit and create location form
     *
     * @var bool
     */
    public $locationForm = false;

    /**
     * Delete confirmation form
     *
     * @var bool
     */
    public $deleteConfirmationForm = false;


    /**
     * Location component attributes
     *
     * @var string name
     * @var string address
     * @var string contact_number
     * @var string description
     * @var string location id
     */
    public $name, $address, $contact_number, $description, $locationID;


    /**
     * Search query
     *
     * @var string
     */
    public $search = '';
    protected $queryString = ['search'];

    /**
     * Validation rules that are applied to location 
     *
     * @var array
     */
    protected $rules =
    [
        'name' => ['required'],
        'address' => ['required', 'max:255'],
        'contact_number' => ['required', 'regex:/^(01)[0-46-9]*[0-9]{7,8}$/'],
        'description' => ['required', 'max:255']
    ];


    /**
     * Show the location management page
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.location-table', [
            'locations' => location::where('name', 'like', '%' . $this->search . '%')->paginate(25),
        ])->layout('layouts.page');
    }


    /**
     * Show and reset component attributes when clicking add button 
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->locationForm = true;
    }

    /**
     * Real time validation
     *
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Create or update location 
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate();

        Location::updateOrCreate(
            ['id' => $this->locationID],
            $validatedData
        );

        // Location::create($validatedData);

        $this->locationForm = false;
        if ($this->locationID != null) {
            session()->flash('success', 'Location infomation updated.');
        } else {
            session()->flash('success', 'Location created');
        };
    }

    /**
     * Pass location id and it will fill the feilds with data from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {

        $this->locationForm = true;
        $this->resetErrorBag();
        $location = Location::findOrFail($id);
        $this->locationID = $id;
        $this->name = $location->name;
        $this->address = $location->address;
        $this->contact_number = $location->contact_number;
        $this->description = $location->description;
    }


    /**
     * Show delete confirmation form
     *
     * @param  int $id
     * @param  string $name
     * @return \Illuminate\View\View
     */
    public function deleteModal($id, $name)
    {
        $this->deleteConfirmationForm = true;
        $this->locationID = $id;
        $this->name = $name;
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
        $this->deleteConfirmationForm = false;
        session()->flash('success', 'Location successfully removed');
    }
}
