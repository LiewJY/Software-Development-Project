<?php

namespace App\Http\Livewire\Admin;

use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Location;
use Livewire\Component;

class Rooms extends Component
{

    use WithPagination;
    public $roomForm = false;
    public $deleteConfirmationForm = false;
    public $name, $location_id,  $description, $price, $size, $roomID, $location_name;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * validation rules that applied to room
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:55'],
        'description' => ['required', 'string', 'max:255', 'min:10'],
        'price' => ['required', 'regex:/^\d+\.\d{1,2}/', 'not_in:0'],
        'size' => ['required', 'numeric'],
        'location_id' => ['required', 'numeric']
    ];

    protected $messages = [
        'location_id.required' => 'Please select a location.',
        'location_id.numeric' => 'Please select a location.',
        'price.regex' => 'Please use the format xxx.xx',
        'size.numeric' => "Please input a valid number."
    ];


    public function render()
    {
        return view('livewire.admin.rooms', [
            'rooms' => room::where('rooms.name', 'like', '%' . $this->search . '%')
                ->join('locations', 'rooms.location_id', '=', 'locations.id')
                ->select('rooms.*', 'locations.name as location_name')
                ->paginate(10),
        ], [
            'locations' => location::get(),
            'slots' => slot::get()
        ]);

    }

    /**
     * Real time validation
     *
     * @return void
     */
    public function updated($propertyname)
    {
        $this->validateOnly($propertyname);
    }

    public function add()
    {
        $this->reset();
        $this->roomForm = true;
    }

    /**
     * Create or update existing room
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate();

        Room::updateOrCreate(
            ['id' => $this->roomID],
            $validatedData
        );

        $this->roomForm = false;
    }

    /**
     * Fill fields with room details from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->roomForm = true;
        $room = Room::findorFail($id);
        $this->location_id = $room->location_id;
        $this->roomID =  $id;
        $this->name =  $room->name;
        $this->description = $room->description;
        $this->price = $room->price;
        $this->size =  $room->size;
    }

    public function deleteModal($id, $name, $location_name)
    {
        $this->deleteConfirmationForm = true;
        $room = Room::findorFail($id);
        $this->roomID = $id;
        $this->name = $name;
        $this->location_name = $location_name;
    }
    /**
     * Delete selected room
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $room = Room::where('id', $id)->firstorfail();
        $room->delete();
        $this->deleteConfirmationForm = false;
    }
}
