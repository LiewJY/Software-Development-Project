<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Location;
use Livewire\Component;

class Rooms extends Component
{

    use WithPagination;
    public $roomForm = false;
    public $deleteConfirmationForm = false;
    public $name, $locationID,  $description, $price, $size, $roomID;
    public $search = '';
    protected $queryString = ['search'];

    /**
     * validation rules that applied to room
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:55'],
        'description' => ['requried', 'string', 'max:255', 'min:10'],
        'price' => ['required', 'reges:\d+\.\d{1,2}', 'not_in:0'],
        'size' => ['required', 'numeric']
    ];


    public function render()
    {
        return view('livewire.admin.rooms', [
            'rooms' => room::where('rooms.name', 'like', '%' . $this->search . '%')
                    ->join('locations' , 'rooms.location_id', '=', 'locations.id')
                    ->select('rooms.*', 'locations.name as location_name')
            ->paginate(10),
        ],[
            'locations' => location::get()
        ]);
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
        $validatedData = $this->validate(
            ['locationID' => ['required']]
        );

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
        $this->roomID =  $id;
        $this->name =  $room->name;
        $this->description = $room->description;
        $this->price = $room->price;
        $this->size =  $room->size;
    }

    public function deleteModal($id, $name)
    {
        $this->deleteConfirmationForm = true;
        $this->locationID = $id;
        $this->name = $name;
        
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