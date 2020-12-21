<div>
<div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
    <div class="w-full md:w-1/2">
        <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
    </div>
    <div class="w-full flex md:justify-end md:w-1/2">
        <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Locaiton</x-jet-button>
    </div>

    <P>{{$search}}</p> 
    {{-- for testing purpose --}}
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
                    <td class="border border-black">{{$location ->name}}</td>
                    <td class="border border-black">{{$location ->address}}</td>
                    <td class="border border-black">{{$location ->contact_number}}</td>
                    <td class="border border-black">{{$location ->description}}</td>
                    <td class="border border-black  py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$location ->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="delete({{$location ->id}})">Delete</x-jet-button>
                        </div>
                    </td>


                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$locations->links()}} 



        <x-jet-dialog-modal wire:model="locationForm" >
            <x-slot name="title">
                <h1>Edit Locaiton</h1>
            </x-slot>
            <x-slot name="content">
                    <x-jet-form-section submit="store" class="bg-red-200">
                        <x-slot name="title"></x-slot>
                        <x-slot name="description"></x-slot>

                        <x-slot name="form">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="name" value="Locaiton name"/>
                                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"/>
                                <x-jet-input-error for="name"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="address" value="Address"/>
                                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="address"/>
                                <x-jet-input-error for="address"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="contactNumber" value="Contact Number" />
                                <x-jet-input id="contactNumber" type="text" class="mt-1 block w-full" wire:model.defer="contactNumber"/>
                                <x-jet-input-error for="contactNumber"/>
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="description" value="Description" />
                                <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description"/>
                                <x-jet-input-error for="description"/>
                            </div>
                        </x-slot>

                        <x-slot name="actions">
                            <x-jet-button>Add</x-jet-button>
                        </x-slot>
                    </x-jet-form-section>
            </x-slot><x-slot name="footer"></x-slot>
        </x-jet-dialog-modal>




</div>
