<div>
<div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
    <div class="w-full md:w-1/2">
        <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Room"/>
    </div>
    <div class="w-full flex md:justify-end md:w-1/2">
        <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Maintenance Form</x-jet-button>
    </div>
</div>

<div class="overflow-x-auto mx-1">
    <table class="min-w-full table-auto border-collapse border border-black">
        <thead>
            <tr>
                <th class="border border-black">Location</th>
                <th class="border border-black">Room</th>
                <th class="border border-black">Employee Name</th>
                <th class="border border-black">Description</th>
                <th class="border border-black">Status</th>
                <th class="border border-black">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenances as $maintenance)
                <tr>
                    <td class="border border-black">{{$maintenance ->location_name}}</td>
                    <td class="border border-black">{{$maintenance ->room_name}}</td>
                    <td class="border border-black">{{$maintenance ->employee_name}}</td>
                    <td class="border border-black">{{$maintenance ->description}}</td>
                    <td class="border border-black">
                        @if($maintenance ->status === 1)
                            Completed
                        @else 
                            Ongoing 
                        @endif
                    </td>
                    <td class="border border-black  py-1.5">
                    <div class="border-none flex flex-row flex-nowrap justify-center">
                    <x-jet-button class="mx-2" wire:click="edit({{$maintenance ->id}})">Edit</x-jet-button>
                    <x-jet-button class="mx-2" wire:click="deleteModal({{$maintenance ->id}}, '{{$maintenance ->room_id}}')">Delete</x-jet-button>
                    </div>
                    </td>


                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$maintenances->links()}}

     <x-jet-dialog-modal wire:model="maintenanceForm" >
        <x-slot name="title">
                @if($room_id)
                    <h1>Edit Maintenance</h1>
                @else
                    <h1>Add Maintenance</h1>
                @endif
        </x-slot>
        <form>
            <x-slot name="content">
                <x-jet-label for="room_id" value="Room ID"/>
                <x-jet-input id="room_id" type="text" class="mt-1 block w-full" wire:model.lazy="room_id"/>
                <x-jet-input-error for="room_id"/>

                <x-jet-label for="employee_id" value="Employee ID"/>
                <x-jet-input id="employee_id" type="text" class="mt-1 block w-full" wire:model.lazy="employee_id"/>
                <x-jet-input-error for="employee_id"/>

                <x-jet-label for="description" value="Description" />
                <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.lazy="description"/>
                <x-jet-input-error for="description"/>

                <x-jet-label for="status" value="Status" />
                    <select id="status" wire:model.lazy="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="{{$maintenance ->status}}">Ongoing</option>
                    <option value="{{$maintenance ->status}}">Completed</option>
                    </select>
            </x-slot>
            <x-slot name="footer">
                @if($room_id)
                    <x-jet-button wire:click="store">Save</x-jet-button>
                @else
                    <x-jet-button wire:click="store">Add</x-jet-button>
                @endif
                <x-jet-button wire:click="$toggle('maintenanceForm')">Cancel</x-jet-button>


            </x-slot>
        </form>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="deleteConfirmationForm">
        <x-slot name="title">
            <h1>Delete Confirmation</h1>
        </x-slot>
        <form>
            <x-slot name="content">
                <p>Are you sure you want to remove the maintenance form with the room id {{$room_id}}</p>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button wire:click="delete({{$room_id}})">Delete</x-jet-button>
                <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
            </x-slot>
        </form>
    </x-jet-dialog-modal>
</div>
