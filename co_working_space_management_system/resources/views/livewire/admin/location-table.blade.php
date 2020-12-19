<div>
<div class="flex flex-row flex-wrap mt-4 px-2 py-2">
    {{-- <div class="flex-initial">
        Per Page: &nbsp;
        <select wire:model="perPage" class="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
    <div class="flex-grow"></div> --}}

    <div class="flex">
        <x-jet-input class="w-80" type="search" wire:model="search" placeholder="Search by Name"/>
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
                <th class="border border-black">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td class="border border-black">{{$location ->name}}</td>
                    <td class="border border-black">{{$location ->address}}</td>
                    <td class="border border-black">{{$location ->contact_number}}</td>
                    <td class="border border-black  py-1.5">
                    <div class="border-none flex flex-row flex-nowrap justify-center">
                        <x-jet-button class="mx-2">Edit</x-jet-button>
                        <x-jet-button class="mx-2">Delete</x-jet-button>
                    </div>
                    </td>


                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$locations->links()}}
</div>





</div>