<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>
        <div class="w-full flex md:justify-end md:w-1/2">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Locatio</x-jet-button>
        </div>
    </div>
    <div class="overflow-x-auto mx-1">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-black">Name</th>
                    <th class="border border-black">Address</th>
                    <th class="border border-black">Contact Number</th>
                    <th class="border border-black">Description</th>
                    <th class="border border-black">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <td class="border border-black">{{$location->name}}</td>
                    <td class="border border-black">{{$location->address}}</td>
                    <td class="border border-black">{{$location->contact_number}}</td>
                    <td class="border border-black">{{$location->description}}</td>
                    <td class="border border-black  py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$location->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$location->id}}, '{{$location->name}}')">Delete</x-jet-button>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        {{$locations->links()}}

        <x-jet-dialog-modal wire:model="locationForm">
            <x-slot name="title">
                @if($locationID)
                <h1>Edit Location</h1>
                @else
                <h1>Add Location</h1>
                @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="name" value="Location name" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name" />
                    <x-jet-input-error for="name" />

                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address" />
                    <x-jet-input-error for="address" />

                    <x-jet-label for="contact_number" value="Contact Number" />
                    <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.lazy="contact_number" />
                    <x-jet-input-error for="contact_number" />

                    <x-jet-label for="description" value="Description" />
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.lazy="description" />
                    <x-jet-input-error for="description" />
                </x-slot>
                <x-slot name="footer">
                    @if($locationID)
                    <x-jet-button wire:click.prevent="store">Save</x-jet-button>
                    @else
                    <x-jet-button wire:click.prevent="store">Add</x-jet-button>
                    @endif
                    <x-jet-button wire:click="$toggle('locationForm')">Cancel</x-jet-button>


                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove the location with the name {{$name}}</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="delete({{$locationID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>