<div>
<div class="flex flex-row flex-wrap mt-4 px-2 py-2">
    <div class="flex-initial">
        Per Page: &nbsp;
        <select wire:model="perPage" class="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
    <div class="flex-grow"></div>

    <div class="flex">
        <x-jet-input type="search" wire:model="search"/>


    </div>
    <P>{{$search}} </p> 
    {{-- for testing purpose --}}
</div>
<div class="overflow-x-auto">
    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th>
                    Name
                    
                </th>
                <th>
                    Email
                    
                </th>
                <th>
                    Birthdate
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td >{{$location ->name}}</td>
                    <td>{{$location ->address}}</td>
                    <td>{{$location ->contact_number}}</td>
                </tr>               
            @endforeach
        </tbody>
    </table>
    {{$locations->links()}}
</div>





</div>