<div>
    <div>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <h1 class="px-2 font-bold text-xl md:text-2xl pt-2">Subscription History</h1>
        </div>
    </div>
    <br>
    <div class="overflow-x-auto mx-1">
        @if(count($subscriptions) === 0 )
                <x-emptyTable>
                <x-slot name="header">
                    Subscription History
                </x-slot>
                <x-slot name="content">
                    Looks like you do not have any subscription yet.
                </x-slot>
            </x-emptyTable>
        @else
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
                    @foreach ($subscriptions as $subscription)
                        <tr >
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
                                    <x-jet-button class="mx-2" wire:click="print({{$subscription->id}})">Print Invoice</x-jet-button>
                                </div>
                            </td>
                        </tr>               
                    @endforeach
                </tbody>
            </table>
            <br>
            {{$subscriptions->links()}}
        @endif
    </div>
</div>

