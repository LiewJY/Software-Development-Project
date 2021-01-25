<div>
    <div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Location"/>
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Reservation</x-jet-button>
        </div>
    </div>
    <br>

    <div class="overflow-x-auto mx-1">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    
                    <th class="border border-gray-700 text-white bg-gray-700">Room ID</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Payment ID</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Reservation Date</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Payment Status</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->room_id}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->payment_id}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->reservation_date}}</td>
                        
                        <td class="border border-gray-400 bg-gray-100">
                            @if($booking ->payment_status === 1)
                                Completed
                            @else 
                                Pending 
                            @endif
                        <td class="border border-gray-400  bg-gray-100 py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                        <x-jet-button class="mx-2" wire:click="deleteModal({{$booking ->id}})">Delete</x-jet-button>
                        </div>
                        </td>
                     </tr>               
                @endforeach
            </tbody>
            </table>
        <br>
        {{$bookings->links()}}
        <x-jet-dialog-modal wire:model="bookingsForm" >
            <x-slot name="title">
                        <h1>Add Reservation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="room_id" value="Room ID"/>
                    <select id="room_id" wire:model.lazy="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">Select a Room</option>
                        @foreach($bookings as $booking)
                            <option value="{{$booking->id}}">{{$booking->name}}, {{$booking->location_name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="room_id"/>


                    <x-jet-label for="first_name" value="Customers Name"/>
                    <x-jet-input disabled id="first_name" type="text" class="mt-1 block w-full" wire:model.lazy="first_name"/>
                    <x-jet-input-error for="first_id"/>

                    <x-jet-label for="reservation_date" value="Reservation Date" />
                    <x-jet-input id="reservation_date" type="text" class="mt-1 block w-full" wire:model.lazy="reservation_date"/>
                    <x-jet-input-error for="reservation_date"/>


                </x-slot>
                <x-slot name="footer">
                        <x-jet-button wire:click="store">Save</x-jet-button>
                    <x-jet-button wire:click="$toggle('bookingsForm')">Cancel</x-jet-button>


                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove this reservation record of {{$booking ->first_name}}</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="delete({{$reservationID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>

