<div>
    <div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <p class="w-full">Subscription history</p>
            {{-- <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Location"/> --}}
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            {{-- <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add"></x-jet-button> --}}
        </div>
    </div>
    <br>
    <div class="overflow-x-auto mx-1">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-gray-700 text-white bg-gray-700">Plan Name</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Start Date</th>
                    <th class="border border-gray-700 text-white bg-gray-700">End Date</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Price</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
            @if(count($subscriptions) === 0 )
                you do not have any subscription (will style later)
            @else

                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td class="border border-gray-400 bg-gray-100">{{$subscription->membership->name}}</td>
                        @php
                            $start_at = date('Y-m-d', strtotime($subscription->updated_at));
                            $end_at = date('Y-m-d', strtotime($subscription->updated_at->addDays(30)));
                        @endphp
                        <td class="border border-gray-400 bg-gray-100">{{$start_at}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$end_at}}</td>
                        <td class="border border-gray-400 bg-gray-100">RM {{$subscription->membership->price}}</td>
                        <td class="border border-gray-400 bg-gray-100">
                            <div class="border-none flex flex-row flex-nowrap justify-center">
                                <x-jet-button class="mx-2" wire:click="print({{$subscription->id}})">Print Receipt</x-jet-button>
                            </div>
                        </td>
                     </tr>               
                @endforeach
            </tbody>
            @endif
        </table>
        <br>
        {{$subscriptions->links()}}
    </div>
</div>

