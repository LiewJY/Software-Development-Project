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
                        {{-- <th class="border border-gray-700 text-white bg-gray-700">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td class="border border-gray-400 bg-gray-100">{{$reservation->first_name}} {{$reservation->last_name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$reservation->name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$reservation->start_time}} - {{$reservation->end_time}}</td>
                        <td class="border border-gray-400 bg-gray-100">RM {{$reservation->amount}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$reservation->reservation_date}}</td>

                        {{-- not sure what to put in extra details sp i left it blank first --}}

                        {{-- <td class="border border-gray-400  bg-gray-100 py-1.5">
                            <div class="border-none flex flex-row flex-nowrap justify-center">
                                <x-jet-button class="mx-2" wire:click="edit({{$reservation->id}})">Edit</x-jet-button>
                        <x-jet-button class="mx-2" wire:click="deleteModal({{$reservation->id}})">Delete</x-jet-button>
        </div>
        </td> --}}
        </tr>
        @endforeach
        </tbody>
        </table>
        <br>

        <x-jet-dialog-modal wire:model="ReservationForm">
            <x-slot name="title">
                <h1>Add Reservation</h1>
            </x-slot>
            <form>
                <x-jet-label for="customer_id" value="Customer" />
                <x-slot name="content">
                    <select id="customer_id" wire:model.lazy="customer_id" name="customer_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Customer --</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="customer_id" />

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
                    <x-jet-input id="price" readonly type="text" class="mt-1 block w-full" wire:model.lazy="price" />

                    <x-jet-label for="selectedSlot" value="Slot" />
                    {{-- @foreach($slots as $test)
                            
                            {{$test}} {{$test->start_time}}
                    @endforeach --}}
                    <select id="selectedSlot" wire:model.lazy="selectedSlot" name="selectedSlot" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="default">-- Select a Slot --</option>
                        @foreach($slots as $slot)
                        <option value="{{$slot->id}}">{{$slot->start_time}} -- {{$slot->end_time}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="selectedSlot" />
                    @endif

                    @if (!is_null($selectedSlot))
                    <x-jet-label for="amount" value="Payment amount" />
                    <x-jet-input id="amount" type="text" class="mt-1 block w-full" wire:model.debounce.200ms="amount" />
                    <x-jet-input-error for="amount" />

                    <x-jet-label for="balance" value="Balance" />
                    <x-jet-input id="balance" readonly type="text" class="mt-1 block w-full" wire:model="balance" />
                    <x-jet-input-error for="balance" />

                    @endif


                </x-slot>
                <x-slot name="footer">
                    <x-jet-button wire:click.prevent="store">Add</x-jet-button>
                    <x-jet-button wire:click="$toggle('ReservationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
        {{-- <script>
$('.selectedDate').datepicker({
    format: 'yyyy/mm/dd',
    startDate: '-3d'
});
</script> --}}
        {{-- <x-jet-dialog-modal wire:model="deleteConfirmationForm">
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
        </x-jet-dialog-modal> --}}
    </div>
</div>

</div>