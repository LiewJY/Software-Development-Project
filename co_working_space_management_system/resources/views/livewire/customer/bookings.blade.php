<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <h1 class="w-full font-bold text-xl md:text-2xl">Upcoming booking </h1>
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
                <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Make Booking</x-jet-button>
        </div>
    </div>
    <br>
    @if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" class="relative py-3 pl-4 pr-10 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert" x-data="{ open: false }">
            <p>{{ session('error') }}</p>
        <span class="absolute inset-y-0 right-0 flex items-center mr-4" @click= "show = false">
            <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20"><path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
        </span>
    </div>
    @endif
    <br>

    <div class="overflow-x-auto mx-1">
        @if(count($bookings) === 0 )
            <x-emptyTable>
                <x-slot name="header">
                    Upcoming Booking
                </x-slot>
                <x-slot name="content">
                    Looks like you do not have any upcoming booking
                </x-slot>
            </x-emptyTable>
        @else
            <table class="min-w-full table-auto border-collapse border border-black">
                <thead>
                    <tr>
                        <th class="border border-gray-700 text-white bg-gray-700">Location</th>
                        <th class="border border-gray-700 text-white bg-gray-700">Room</th>
                        <th class="border border-gray-700 text-white bg-gray-700">Reservation Date</th>
                        <th class="border border-gray-700 text-white bg-gray-700">Slot</th>
                        <th class="border border-gray-700 text-white bg-gray-700">Price</th>
                        <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                    <tr class="text-center">
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->locations_name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->reservation_date}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking->start_time}} - {{$booking->end_time}}</td>
                        <td class="border border-gray-400 bg-gray-100">RM {{$booking->room->price}}</td>
                        <td class="border border-gray-400 bg-gray-100">
                            <div class="border-none flex flex-row flex-nowrap justify-center">
                                <x-jet-button class="mx-2" wire:click="deleteModal({{$booking ->booking_id}})">Cancel</x-jet-button>
                                <x-jet-button class="mx-2" wire:click="print({{$booking->booking_id}})">Print Invoice</x-jet-button>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{$bookings->links()}}
        @endif

        <x-jet-dialog-modal wire:model="bookingsForm">
            <x-slot name="title">
                <h1>Add Booking</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="customer_name" value="Name" />
                    <x-jet-input id="customer_name" type="text" readonly class="mt-1 block w-full" wire:model.lazy="customer_name" />
                    <x-jet-input-error for="customer_name" />

                    <x-jet-label for="selectedLocation" value="Location" />
                    <select id="selectedLocation" wire:model.lazy="selectedLocation" name="selectedLocation" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Location --</option>
                        @foreach($location as $loc)
                        <option value="{{$loc->id}}">{{$loc->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="selectedLocation" />

                    @if (!is_null($selectedLocation))
                        <x-jet-label for="selectedDate" value="Date" />
                        <x-jet-input placeholder="yyyy/mm/dd" id="selectedDate" type="date" class="mt-1 block w-full" wire:model.lazy="selectedDate" />
                        <x-jet-input-error for="selectedDate" />
                    @endif

                    @if (!is_null($selectedDate))
                        <x-jet-label for="selectedRoom" value="Room" />
                        <select id="selectedRoom" wire:model.lazy="selectedRoom" name="selectedRoom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="default">-- Select a Room --</option>
                            @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->name}}, {{$room->size}}pax</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="selectedRoom" />
                    @endif

                   

                    @if (!is_null($selectedRoom))
                    <x-jet-label for="price" value="Price" />
                    <x-jet-input id="price" readonly type="text" class="mt-1 block w-full" wire:model="price" />

                    <x-jet-label for="selectedSlot" value="Slot" />
                    <select id="selectedSlot" wire:model.lazy="selectedSlot" name="selectedSlot" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Slot --</option>
                        @foreach($slots as $slot)
                        <option value="{{$slot->id}}">{{$slot->start_time}} -- {{$slot->end_time}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="selectedSlot" />
                    @endif

                    @if (!is_null($selectedSlot))
                    {{-- <x-jet-label for="card_type" value="Card Type" />
                    <select id="card_type" wire:model.lazy="card_type" name="card_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">Select a Card</option>
                        <option value="">Visa</option>
                        <option value="">Master</option>
                    </select>
                    <x-jet-input-error for="card_type" />

                    <x-jet-label for="card_number" value="Card Number" />
                    <x-jet-input readonly id="card_number" type="text" class="mt-1 block w-full" wire:model.lazy="card_number" />
                    <x-jet-input-error for="card_number" />

                    <x-jet-label for="exp_date" value="Expire Date" />
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                        <x-jet-label for="month" value="Month" />
                        <x-jet-input id="month" readonly type="text" class="mt-1 block w-full" wire:model.lazy="month" />
                        <x-jet-input-error for="month" />
                        </span>
                        <span class="w-1/2">
                        <x-jet-label for="year" value="Year" />
                        <x-jet-input id="year" readonly type="text" class="mt-1 block w-full" wire:model.lazy="year" />
                        <x-jet-input-error for="year" />
                        </span>
                    </div>
                    <x-jet-label for="card_cvc" value="Card CVV2/CVC2/4DBC" />
                    <x-jet-input readonly id="card_cvc" type="text" class="mt-1 block w-1/4" wire:model.lazy="card_cvc" />
                    <x-jet-input-error for="card_cvc" /> --}}
                    @endif
                </x-slot>

                <x-slot name="footer">
                    <x-jet-button wire:click="store">Make Booking</x-jet-button>
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
                    <p>Are you sure you want to cancel this booking ?</p>

                    {{-- add flash message to say money will be refunded --}}
                </x-slot>
                <x-slot name="footer">
                    <x-jet-danger-button wire:click="delete({{$bookingID}})">Cancel Booking</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>