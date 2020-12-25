<div>
<!-- Title -->
<h1 class="font-serif sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900 underline mx-3">Employee</h1>

<!-- Search -->
<div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
    <div class="w-full md:w-1/2">
        <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
    </div>
    <div class="w-full flex md:justify-end md:w-1/2">
        <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Employee</x-jet-button>
    </div>
</div>

<!-- Table -->
<div class="overflow-x-auto mx-1">
    <table class="min-w-full table-auto border-collapse border border-black">
        <thead>
            <tr>
                <th class="border border-black">First Name</th>
                <th class="border border-black">Last Name</th>
                <th class="border border-black">Address</th>
                <th class="border border-black">Contact Number</th>
                <th class="border border-black">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td class="border border-black">{{$employee ->first_name}}</td>
                    <td class="border border-black">{{$employee ->last_name}}</td>
                    <td class="border border-black">{{$employee ->address}}</td>
                    <td class="border border-black">{{$employee ->contact_number}}</td>
                    <td class="border border-black  py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$employee ->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$employee ->id}}, '{{$employee ->firstName}}')">Delete</x-jet-button>
                        </div>
                    </td>


                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$employees->links()}} 

<!-- Edit Modal -->
    <x-jet-dialog-modal wire:model="employeeForm" >
        <x-slot name="title">
            <h1>Edit Employee</h1>
        </x-slot>
        <form>
            <x-slot name="content">
                <x-jet-label for="firstName" value="First name"/>
                <x-jet-input id="firstName" type="text" class="mt-1 block w-full" wire:model.lazy="firstName"/>
                <x-jet-input-error for="firstName"/>

                <x-jet-label for="lastName" value="Last name" />
                <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.lazy="lastName"/>
                <x-jet-input-error for="lastName"/>

                <x-jet-label for="address" value="Address"/>
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address"/>
                <x-jet-input-error for="address"/>

                <x-jet-label for="contactNumber" value="Contact Number" />
                <x-jet-input id="contactNumber" type="text" class="mt-1 block w-full" wire:model.lazy="contactNumber"/>
                <x-jet-input-error for="contactNumber"/>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="store">Save</x-jet-button>
                <x-jet-button wire:click="$toggle('employeeForm')">Cancel</x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>

<!-- Add Modal -->
    <x-jet-dialog-modal wire:model="employeeAddForm" >
        <x-slot name="title">
            <h1>Add Employee</h1>
        </x-slot>
    <form>
            <x-slot name="content">
                <div class="flex justify-between gap-3">
                <span class="w-1/2">
                    <x-jet-label for="firstName" value="First name"/>
                    <x-jet-input id="firstName" type="text" class="mt-1 block w-full" wire:model.lazy="firstName"/>
                    <x-jet-input-error for="firstName"/>
                </span>
                <span class="w-1/2">
                    <x-jet-label for="lastName" value="Last name" />
                    <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.lazy="lastName"/>
                    <x-jet-input-error for="lastName"/>
                </span>
                </div>
                <x-jet-label for="address" value="Address"/>
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address"/>
                <x-jet-input-error for="address"/>

                <x-jet-label for="contactNumber" value="Contact Number" />
                <x-jet-input id="contactNumber" type="text" class="mt-1 block w-full" wire:model.lazy="contactNumber"/>
                <x-jet-input-error for="contactNumber"/>

                <x-jet-label for="username" value="Username" />
                <x-jet-input id="usernamer" type="text" class="mt-1 block w-full" wire:model.lazy="username"/>
                <x-jet-input-error for="username"/>

                <x-jet-label for="email" value="Email" />
                <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.lazy="email"/>
                <x-jet-input-error for="email"/>

                <x-jet-label for="password" value="Password" />
                <x-jet-input id="password" type="text" class="mt-1 block w-full" wire:model.lazy="password"/>
                <x-jet-input-error for="password"/>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="edit">Add</x-jet-button>
                <x-jet-button wire:click="$toggle('employeeAddForm')">Cancel</x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>    

<!-- Delete Modal -->
    <x-jet-dialog-modal wire:model="deleteConEmployeeForm">
        <x-slot name="title">
            <h1>Delete Confirmation</h1>
        </x-slot>
        <form>
            <x-slot name="content">
                <p>Are you sure you want to remove the employee with the name {{$firstName}}</p>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="delete({{$employeeID}})">Delete</x-jet-button>
                <x-jet-button wire:click="$toggle('deleteConEmployeeForm')">Cancel</x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>
