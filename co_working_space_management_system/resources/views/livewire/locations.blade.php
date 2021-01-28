<div class="grid grid-cols-1">
@foreach($locations as $location)

<div class="grid md:grid-cols-8 grid-cols-1 rounded-2xl bg-gray-200 mx-2 my-2">
    <div class="relative bg-gray-200 rounded-2xl col-span-5">
        <div class="bg-cover bg-center text-white py-0 px-0 object-fill">
            <x-image.image1 class="sm:rounded-t-2xl md:rounded-none md:rounded-l-2xl" />
        </div>
    </div>
    <div class="p-8 col-span-3 relative">
        <h1 class="text-gray-900 font-bold text-3xl text-center uppercase">{{$location->name}}</h1>
        <hr class="bg-gray-300">
        <p class="block mt-1 text-lg leading-tight font-medium text-black">Address</p>
        <p class="text-gray-900 text-sm mt-1">{{$location->address}}</p>
        <br>
        <p class="block mt-1 text-lg leading-tight font-medium text-black">Contact Number</p>
        <p class="text-gray-900 text-sm mt-1">{{$location->contact_number}}</p>
        <br>
        <x-jet-button class="absolute bottom-5 right-5 text-md" wire:click="locations({{$location->id}})">
            Learn More
        </x-jet-button>
    </div>
</div>

@endforeach
</div>