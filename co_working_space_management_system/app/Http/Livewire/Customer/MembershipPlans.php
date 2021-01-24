<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MembershipPlans extends Component
{

    public $plans, $plans_id;
    public $subscriptionConfirmation = false;
    public $plan_name, $plan_cost;
    //public $card_type, $card_number, $month, $year, $card_cvc;


    public function mount($id)
    {
        $this->plans_id = $id;
        $this->plans = Membership::findorFail($id);
    }

    // need to login to access this page


    public function render()
    {
        return view('livewire.customer.membership-plans', [
            'membershipplans' => Membership::all()
                ->where('id', '=', $this->plans_id)
        ]);
    }

    public function subscriptionConfirmationModal($plan_name, $plan_cost)
    {
        $this->subscriptionConfirmation = true;
        $this->plan_name = $plan_name;
        $this->plan_cost = $plan_cost;
    }

    public function subscribe()
    {

        $user = User::find(Auth::user()->id);
        $payment = $user->membership_payments->first()->membership_id;

        if ($payment == $this->plans_id) {
            session()->flash('message', 'Subscription for the plan is still active.');
        } else {
            MembershipPayment::create([
                'membership_id' => $this->plans_id,
                'user_id' => Auth::user()->id
            ]);
        }

    }
}