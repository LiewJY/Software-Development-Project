<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Membership;
use App\Models\MembershipPayment;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

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


    /**
     * Show membership plan management page
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.membership-plans', [
            'membershipplans' => Membership::where('name', 'like', '%' . $this->search . '%')->paginate(10),
        ])->layout('layouts.page');
    }

    /**
     * add
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        $this->reset();
        $this->resetErrorBag();
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
        if ($this->membershipID != null) {
            session()->flash('success', 'Membership Plan infomation updated.');
        } else {
            session()->flash('success', 'Membership Plan successfully added.');
        };
        return redirect()->route('membership-plans');
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
        $this->resetErrorBag();
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
        $date = Carbon::now()->toDateString();
        $membership = MembershipPayment::where('membership_id', $id)->whereDate('expired_on', '>', $date)->get();

        if (!$membership->isEmpty()) {
            session()->flash("error", "Could not delete membership plan when there is active subscription");
        } else {
            $membership = Membership::where('id', $id)->firstorfail();
            $membership->delete();
            $this->deleteConfirmationForm = false;
            session()->flash('success', 'Membership Plan successfully removed.');
        }
        return redirect()->route('membership-plans');
    }

    /**
     * Delete confirmation form 
     *
     * @param  int $id
     * @param  string $name
     * @return void
     */
    public function deleteModal($id, $name)
    {
        $this->deleteConfirmationForm = true;
        $this->membershipID = $id;
        $this->name = $name;
    }
}
