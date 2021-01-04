<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add User</x-jet-button>
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
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="border border-gray-400 bg-gray-100">{{$customer ->first_name}} {{$customer ->last_name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$customer ->address}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$customer ->contact_number}}</td>
                        
                        
                        <td class="border border-gray-400  bg-gray-100 py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                        <x-jet-button class="mx-2" wire:click="edit({{$customer ->id}})">Edit</x-jet-button>
                        <x-jet-button class="mx-2" wire:click="deleteModal({{$customer ->id}}, '{{$customer ->first_name}}')">Delete</x-jet-button>
                        </div>
                        </td>


                    </tr>               
                @endforeach
            </tbody>

        </table>
        <br>
        {{$customers->links()}}

        <x-jet-dialog-modal wire:model="customerForm">
            <x-slot name="title">
                @if($customerID)
                <h1>Edit Customer</h1>
                @else
                <h1>Add Customer</h1>
                @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    @if($customerID)
                        <div class="flex justify-between gap-3">
                            <span class="w-1/2">
                                <x-jet-label for="firstName" value="First name" />
                                <x-jet-input id="firstName" readonly type="text" class="mt-1 block w-full" wire:model.lazy="first_name" />
                                <x-jet-input-error for="first_name" />
                            </span>
                            <span class="w-1/2">
                                <x-jet-label for="lastName" value="Last name" />
                                <x-jet-input id="lastName" readonly type="text" class="mt-1 block w-full" wire:model.lazy="last_name" />
                                <x-jet-input-error for="last_name" />
                            </span>
                        </div>
                    @else
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
                    @endif
 
                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address" />
                    <x-jet-input-error for="address" />
 
                    <x-jet-label for="contact_number" value="Contact Number" />
                    <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.lazy="contact_number" />
                    <x-jet-input-error for="contact_number" />
                    
                    <x-jet-label for="email" value="Email" />
                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.lazy="email" />
                    <x-jet-input-error for="email" />
                </x-slot>
                <x-slot name="footer">
                    @if($customerID)
                        <x-jet-button wire:click="store">Save</x-jet-button>
                    @else
                        <x-jet-button wire:click="store">Add</x-jet-button>
                    @endif
                        <x-jet-button wire:click="$toggle('customerForm')">Cancel</x-jet-button>


                </x-slot>
            </form>
        </x-jet-dialog-modal>
            <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove this user with the name of {{$first_name}}</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="delete({{$customerID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>