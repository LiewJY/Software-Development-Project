<div>
    <div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <p class="w-full">Past booking</p>
            {{-- <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Location"/> --}}
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Booking</x-jet-button>
        </div>
    </div>
    <br>
    <div class="overflow-x-auto mx-1">
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
                    <tr>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->locations_name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking ->reservation_date}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$booking->start_time}} - {{$booking->end_time}}</td>
                        <td class="border border-gray-400 bg-gray-100">RM {{$booking->room->price}}</td>
                        <td class="border border-gray-400 bg-gray-100">
                            <div class="border-none flex flex-row flex-nowrap justify-center">
                                <x-jet-button class="mx-2" wire:click="print({{$booking->booking_id}})">Print Receipt</x-jet-button>
                            </div>
                        </td>
                     </tr>               
                @endforeach
            </tbody>
            </table>
        <br>
        {{$bookings->links()}}
    </div>
</div>

