<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Membership;

class MembershipPlans extends Component
{
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $name, $price, $description, $membershipID;
    public $membershipForm = false;
    public $deleteConfirmationForm = false;


    /**
     * Validation rules that applied to membership
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:55'],
        'price' => ['required', 'regex:/^\d+\.\d{1,2}/', 'not_in:0'],
        'description' => ['required', 'string', 'max:255', 'min:10']
    ];


    public function render()
    {
        return view('livewire.admin.membership-plans', [
            'membershipplans' => Membership::where('name', 'like', '%' . $this->search . '%')->paginate(10),
        ])->layout('layouts.page');
    }

    public function add()
    {
        $this->reset();
        $this->membershipForm = true;
    }

    /**
     * Create or update existing membership plan
     *
     * @return void
     */
    public function store()
    {
        $validatedData = $this->validate();
        Membership::updateOrCreate(
            ['id' => $this->membershipID],
            $validatedData
        );

        $this->membershipForm = false;
    }

    /**
     * Fill fields with membership details from database
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $this->membershipForm = true;
        $membership = Membership::findorFail($id);
        $this->membershipID = $id;
        $this->name =  $membership->name;
        $this->description = $membership->description;
        $this->price = $membership->price;
    }

    /**
     * Delete selected membership plan
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        $membership = Membership::where('id', $id)->firstorfail();
        $membership->delete();
        $this->deleteConfirmationForm = false;
    }

    public function deleteModal($id, $name)
    {
        $this->deleteConfirmationForm = true;
        $this->membershipID = $id;
        $this->name = $name;
    }
}
