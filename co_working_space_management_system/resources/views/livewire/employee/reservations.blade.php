<div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>

    </div>
    <br>

    <div class="cotainer">
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($locations as $location)
            <div>
                <div class="flex flext-start flex-row">
                    <div class="flex flex-col flex-nowrap bg-gray-800 rounded-xl w-full overflow-hidden my-10 mx-2 border-2  border-gray-800">
                        <div class="px-4 py-2">
                            <h1 class="text-white font-bold text-xl text-center uppercase">{{$location->name}}</h1>
                        </div>

                        <div class="flex justify-center bg-white py-2">
                            <h1 class="text-gray-800 text-center font-bold text-xl">Number of rooms: {{$location->roomCount()}}</h1>
                        </div>
                        <div class="flex justify-center">
                            <x-jet-button class="py-3 w-full flex items-center bg-white justify-center rounded-none" wire:click="room({{$location->id}})">Select</x-jet-button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>