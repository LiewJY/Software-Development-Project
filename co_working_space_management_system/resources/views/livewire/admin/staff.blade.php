<div>
<div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
    <div class="w-full md:w-1/2">
        <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
    </div>
    <div class="w-full flex md:justify-end md:w-1/2">
        <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Employee</x-jet-button>
    </div>
</div>
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
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$employee ->id}}, '{{$employee ->first_name}}')">Delete</x-jet-button>
                        </div>
                    </td>


                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$employees->links()}} 

    <x-jet-dialog-modal wire:model="employeeForm" >
        <x-slot name="title">
                @if($employeeID)
                    <h1>Edit Employee</h1>
                @else
                    <h1>Add Employee</h1>
                @endif
        </x-slot>
        <form>
            <x-slot name="content">
                <x-jet-label for="first_name" value="First name"/>
                <x-jet-input id="first_name" type="text" class="mt-1 block w-full" wire:model.defer="first_name"/>
                <x-jet-input-error for="first_name"/>

                <x-jet-label for="last_name" value="Last name" />
                <x-jet-input id="last_name" type="text" class="mt-1 block w-full" wire:model.defer="last_name"/>
                <x-jet-input-error for="last_name"/>

                <x-jet-label for="address" value="Address"/>
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address"/>
                <x-jet-input-error for="address"/>

                <x-jet-label for="contactNumber" value="Contact Number" />
                <x-jet-input id="contactNumber" type="text" class="mt-1 block w-full" wire:model.defer="contactNumber"/>
                <x-jet-input-error for="contactNumber"/>
            </x-slot>
            <x-slot name="footer">
                @if($employeeID)
                    <x-jet-button wire:click="store">Save</x-jet-button>
                @else
                    <x-jet-button wire:click="store">Add</x-jet-button>
                @endif
                    <x-jet-button wire:click="$toggle('employeeForm')">Cancel</x-jet-button>


            </x-slot>
        </form>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="deleteConEmployeeForm">
        <x-slot name="title">
            <h1>Delete Confirmation</h1>
        </x-slot>
        <form>
            <x-slot name="content">
                <p>Are you sure you want to remove the employee with the name {{$first_name}}</p>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="delete({{$employeeID}})">Delete</x-jet-button>
                <x-jet-button wire:click="$toggle('deleteConEmployeeForm')">Cancel</x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>
