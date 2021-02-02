<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Membership;
use App\Models\MembershipPayment;
use App\Models\User;
use Carbon\Carbon;
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

    
    /**
     * Show payment page of membership subscription
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.customer.membership-plans', [
            'membershipplans' => Membership::all()
                ->where('id', '=', $this->plans_id)
        ])->layout('layouts.page');
    }

    public function subscriptionConfirmationModal($plan_name, $plan_cost)
    {
        $this->subscriptionConfirmation = true;
        $this->plan_name = $plan_name;
        $this->plan_cost = $plan_cost;
    }
    
    /**
     * Creating new subscription entry
     *
     * @return void
     */
    public function subscribe()
    {

        $user = User::find(Auth::user()->id);
        $payment = $user->membership_payments->sortByDesc('created_at')->first();

        if ($payment == null) {

            MembershipPayment::create([
                'membership_id' => $this->plans_id,
                'user_id' => Auth::user()->id,
                'expired_on' => Carbon::now()->addDays(30)
            ]);

            $this->subscriptionConfirmation = false;
            session()->flash('success', 'Subscription added. Valid until ' . Carbon::now()->addDays(30));
        } elseif ($payment != null && $payment->expired_on->isPast()) {

            MembershipPayment::create([
                'membership_id' => $this->plans_id,
                'user_id' => Auth::user()->id,
                'expired_on' => Carbon::now()->addDays(30)
            ]);
            $this->subscriptionConfirmation = false;
            session()->flash('success', 'Subscription added. Valid until ' . Carbon::now()->addDays(30));
        } else {

            $endDate = $payment->expired_on->toDateString();
            session()->flash('message', 'Could not subscribe when you have an active subscription. End at ' . $endDate);
        }
    }
}
