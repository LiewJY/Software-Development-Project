<div>
    <h1 class="px-2 font-bold text-xl md:text-2xl pt-2">Locations</h1>

    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Location</x-jet-button>
        </div>
    </div>
    <br>
    @if (session()->has('success'))
    <div id="alert" class="relative py-3 pl-4 pr-10 leading-normal text-green-700 bg-green-100 rounded-lg">
        <p>{{ session('success') }}</p>
    </div>
    <br>
    @endif
    <div class="overflow-x-auto mx-1">
        @if(count($locations) === 0 )
        <x-emptyTable>
            <x-slot name="header">
                Location
            </x-slot>
            <x-slot name="content">
                @if(!empty($search))
                There are no record of locaiton with the name "{{$search}}"
                @else
                Looks like there are no location record.
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
                    <th class="border border-gray-700 text-white bg-gray-700">Description</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                <tr class="text-center">
                    <td class="border border-gray-400 bg-gray-100">{{$location->name}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$location->address}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$location->contact_number}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$location->description}}</td>
                    <td class="border border-gray-400  bg-gray-100 py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$location->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$location->id}}, '{{$location->name}}')">Delete</x-jet-button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{$locations->links()}}
        @endif

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
                    <p class="font-bold"> This will delete all the rooms and it's maintenances related this location.</p>

                </x-slot>
                <x-slot name="footer">
                    <x-jet-danger-button wire:click="delete({{$locationID}})">Delete</x-jet-button>
                        <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>