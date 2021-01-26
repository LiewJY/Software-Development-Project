<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\MembershipPayment;


class SubscriptionHistory extends Component
{
    public function render()
    {
        $user = Auth::user()->id;

        return view('livewire.customer.subscription-history', [
            'subscriptions' => MembershipPayment::where('user_id', '=', $user)
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10),
        ]);
    }

    /**
     * open receipt
     *
     * @param  mixed $id
     * @return void
     */
    public function print($id)
    {
        return redirect()->route('printmembership', ['id' => $id]);
    }
}
