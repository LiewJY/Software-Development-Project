<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>
    </div>
    <br>

    <div class="overflow-x-auto mx-1">
        @if(count($customers) === 0 )
        <x-emptyTable>
            <x-slot name="header">
                Location
            </x-slot>
            <x-slot name="content">
                @if(!empty($search))
                There are no record of customer with the name "{{$search}}"
                @else
                Looks like there are no customer record.
                @endif
            </x-slot>
        </x-emptyTable>
        @else
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-gray-700 text-white bg-gray-700">Name</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Address</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Contact Number</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Email</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Membership Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr class=" h-12 text-center">
                    <td class="border border-gray-400 bg-gray-100">{{$customer ->first_name}} {{$customer ->last_name}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$customer ->address}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$customer ->contact_number}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$customer ->email}}</td>
                    @if ($customer->user->membership_payments->first() == null)
                    <td class="border border-gray-400 bg-gray-100">
                        No subscription
                    </td>
                    @else
                    @if ($customer->user->membership_payments->sortByDesc('created_at')->first()->expired_on->isPast())
                    <td class="border border-gray-400 bg-gray-100">
                        No subscription
                    </td>
                    @elseif ($customer->user->membership_payments->sortByDesc('created_at')->first()->expired_on->isToday())
                    <td class="border border-gray-400 bg-green-200">
                        {{$customer->user->membership_payments->sortByDesc('created_at')->first()->membership->name}} Plan
                    </td>
                    @else
                    <td class="border border-gray-400 bg-green-200">
                        {{$customer->user->membership_payments->sortByDesc('created_at')->first()->membership->name}} Plan
                    </td>
                    @endif
                    @endif

                </tr>
                @endforeach
            </tbody>

        </table>
        <br>
        {{$customers->links()}}
        @endif
    </div>
</div>