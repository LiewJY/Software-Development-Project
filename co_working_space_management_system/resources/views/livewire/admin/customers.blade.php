<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            {{-- <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Customer</x-jet-button> --}}
        </div>
    </div>
    <br>

    <div class="overflow-x-auto mx-1">
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
                            @if ($customer->user->membership_payments->first()->updated_at->addDays(30)->isPast())
                            <td class="border border-gray-400 bg-gray-100">
                                No subscription
                            </td>
                            @elseif ($customer->user->membership_payments->first()->updated_at->addDays(30)->isToday())
                            <td class="border border-gray-400 bg-green-200">
                                {{$customer->user->membership_payments->first()->membership->first()->name}} Plan
                            </td>

                            @else
                            <td class="border border-gray-400 bg-green-200">
                                {{$customer->user->membership_payments->first()->membership->first()->name}} Plan
                            </td>
                            @endif
                        @endif                      

                    </tr>               
                @endforeach
            </tbody>

        </table>
        <br>
        {{$customers->links()}}

        {{-- <x-jet-dialog-modal wire:model="customerForm">
            <x-slot name="title">
                <h1>Add Customer</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <x-jet-label for="firstName" value="First name" />
                            <x-jet-input id="firstName" type="text" class="mt-1 block w-full" wire:model.lazy="first_name" />
                            <x-jet-input-error for="first_name" />
                        </span>
                        <span class="w-1/2">
                            <x-jet-label for="lastName" value="Last name" />
                            <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.lazy="last_name" />
                            <x-jet-input-error for="last_name" />
                        </span>
                    </div> 

                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address" />
                    <x-jet-input-error for="address" />
 
                    <x-jet-label for="contact_number" value="Contact Number" />
                    <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.lazy="contact_number" />
                    <x-jet-input-error for="contact_number" />

                    <x-jet-label for="username" value="Username" />
                    <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.lazy="username" />
                    <x-jet-input-error for="username" />
                    
                    <x-jet-label for="email" value="Email" />
                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.lazy="email" />
                    <x-jet-input-error for="email" />
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="store">Add</x-jet-button>
                    <x-jet-button wire:click="$toggle('customerForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal> --}}
    </div>
</div>