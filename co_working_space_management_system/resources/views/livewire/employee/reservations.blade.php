<div>
    <div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
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
                    <th class="border border-gray-700 text-white bg-gray-700">Customer</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Room</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Slot</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Payment Amount</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Reservation Date</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Payment Status</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td class="border border-gray-400 bg-gray-100">{{$reservation->customer_first_name}} {{$reservation->customer_last_name}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$reservation->room_name}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$reservation->slot_start}} - {{$reservation->slot_end}}</td>
                    <td class="border border-gray-400 bg-gray-100">RM {{$reservation->payments_amount}}</td>
                    <td class="border border-gray-400 bg-gray-100">{{$reservation->reservation_date}}</td>
                    <td class="border border-gray-400 bg-gray-100">
                        @if($reservation ->payment_status === 1)
                            Paid
                        @else
                            Overdue 
                        @endif
                    </td>
                    <td class="border border-gray-400  bg-gray-100 py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$reservation->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$reservation->id}})">Delete</x-jet-button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{$reservations->links()}}

        <x-jet-dialog-modal wire:model="ReservationForm">
            <x-slot name="title">
                @if($reservationID)
                <h1>Edit Reservation</h1>
                @else
                <h1>Add Reservation</h1>
                @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="customer_name" value="Customer" />
                    @if($reservationID)
                    <x-jet-input id="customer_name" readonly type="text" class="mt-1 block w-full" wire:model.lazy="customer_name" />
                    @else
                    <select id="customer_name" wire:model.lazy="customer_name" name="customer_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                        @endforeach
                    </select>
                   
                    @endif
                    <x-jet-input-error for="customer_name" />
                
                    <x-jet-label for="room_id" value="Room" />
                     @if($reservationID)
                    <select id="room_id" wire:model.lazy="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->room_name}}</option>
                        @endforeach
                    </select>
                    @else
                    <select id="room_id" wire:model.lazy="room_id" name="room_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Room --</option>
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->room_name}}</option>
                        @endforeach
                    </select>
                    @endif
                    <x-jet-input-error for="room_id" />

                    <x-jet-label for="room_slot_id" value="Room Slot" />
                     @if($reservationID)
                    <select id="room_slot_id" wire:model.lazy="room_slot_id" name="room_slot_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($slots as $slot)
                            <option value="{{$slot->id}}">{{$slot->slot_start}} - {{$slot->slot_end}}</option>
                        @endforeach
                    </select>
                    @else
                    <select id="room_slot_id" wire:model.lazy="room_slot_id" name="room_slot_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Room Slot --</option>
                        @foreach($slots as $slot)
                            <option value="{{$slot->id}}">{{$slot->slot_start}} - {{$slot->slot_end}}</option>
                        @endforeach
                    </select>
                    @endif
                    <x-jet-input-error for="room_slot_id" />

                    <x-jet-label for="payment_id" value="Payment Amount" />
                    <x-jet-input  id="payment_id" type="text" class="mt-1 block w-full" wire:model.lazy="payment_id"/>
                    <x-jet-input-error for="payment_id" />

                    <x-jet-label for="reservation_date" value="Reservation Date" />
                    <x-jet-input id="reservation_date" type="text" class="mt-1 block w-full" wire:model.lazy="reservation_date" />
                    <x-jet-input-error for="reservation_date" />
                    
                    <x-jet-label for="payment_status" value="Payment Status" />
                    <select id="payment_status" wire:model.lazy="payment_status" name="payment_status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">Select a status</option>
                        <option value="0">Overdue</option>
                        <option value="1">Paid</option>
                    </select>
                </x-slot>
                <x-slot name="footer">
                    @if($reservationID)
                    <x-jet-button wire:click.prevent="store">Save</x-jet-button>
                    @else
                    <x-jet-button wire:click.prevent="store">Add</x-jet-button>
                    @endif
                    <x-jet-button wire:click="$toggle('ReservationForm')">Cancel</x-jet-button>


                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                        <p>Are you sure you want to remove the reservation record for {{$name}} {{$reservationID}}</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click="delete({{$reservationID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>
    
</div>