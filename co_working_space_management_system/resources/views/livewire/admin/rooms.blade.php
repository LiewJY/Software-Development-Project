<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>
        <div class="w-full flex md:justify-end md:w-1/2">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Rooms</x-jet-button>
        </div>
    </div>

    <div class="overflow-x-auto mx-1">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-black">Location Name</th>
                    <th class="border border-black">Room Name</th>
                    <th class="border border-black">Description</th>
                    <th class="border border-black">Price</th>
                    <th class="border border-black">Size</th>
                    <th class="border border-black">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td class="border border-black">{{$room ->location_name}}</td>
                    <td class="border border-black">{{$room ->name}}</td>
                    <td class="border border-black">{{$room ->description}}</td>
                    <td class="border border-black">{{$room ->price}}</td>
                    <td class="border border-black">{{$room ->size}}</td>
                    <td class="border border-black  py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$room ->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$room ->id}}, '{{$room ->name}}', '{{$room ->location_name}}')">Delete</x-jet-button>
                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{$rooms->links()}}

        <x-jet-dialog-modal wire:model="roomForm">
            <x-slot name="title">
                @if($roomID)
                <h1>Edit Room</h1>

                @else
                <h1>Add Room</h1>
                @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="locationID" value="Location name" />
                    <select id="locationID" wire:model.lazy="location_id" name="locationID" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">Select a location</option>
                        @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="location_id" />

                    <x-jet-label for="name" value="Room name" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name" />
                    <x-jet-input-error for="name" />

                    <x-jet-label for="description" value="Description" />
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.lazy="description" />
                    <x-jet-input-error for="description" />

                    <x-jet-label for="price" value="Price" />
                    <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.lazy="price" />
                    <x-jet-input-error for="price" />

                    <x-jet-label for="size" value="Size" />
                    <x-jet-input id="size" type="text" class="mt-1 block w-full" wire:model.lazy="size" />
                    <x-jet-input-error for="size" />

                    <x-jet-label for="slot" value="Time Slot" />

                    <div class="flex flex-row flex-wrap">

                        @foreach($slots as $slot )

                        <div class="flex items-start">
                            <div class="flex items-center h-5 pl-3">
                                <input name="{{$slot->id}}" wire:click.lazy="timeClicked({{$roomID}} , {{$slot->id}})" id="{{$slot->id}}" type="checkbox" wire:model.lazy="time" value="{{$slot->id}}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="slot" class="font-medium text-gray-700">{{$slot ->start_time}} -- {{$slot ->end_time}}</label>
                            </div>

                        </div>

                        @endforeach
                        <x-jet-input-error for="time" />
                    </div>

                </x-slot>
                <x-slot name="footer">
                    @if($roomID)
                    <x-jet-button wire:click="store">Save</x-jet-button>
                    @else
                    <x-jet-button wire:click="store">Add</x-jet-button>
                    @endif
                    <x-jet-button wire:click="$toggle('roomForm')">Cancel</x-jet-button>


                </x-slot>
            </form>

        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove the room with the name {{$name}} at {{$location_name}}.</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="delete({{$roomID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>

    </div>
