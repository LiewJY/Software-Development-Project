<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Membership;

class MembershipPlans extends Component
{

    public $plans, $plans_id;

    public function mount($id)
    {
        $this->plans_id = $id;
        $this->plans = Membership::findorFail($id);
    }


    public function render()
    {
        return view('livewire.customer.membership-plans',[
            'membershipplans' => Membership::all()
            ->where('id', '=', $this->plans_id)
        ]);
    }

}