@foreach($locations as $location)
<div class="flex flext-start flex-row">
        <div class="flex flex-col flex-nowrap bg-gray-50 rounded-xl w-full overflow-hidden my-10 mx-2 border-2 border-white">
            <div class="px-4 py-2">
                <h1 class="text-gray-900 font-bold text-3xl text-center uppercase">{{$location->name}}</h1>
                <hr class="bg-gray-300">
                <p class="text-gray-900 text-sm mt-1 underline ">Address</p>
                <p class="text-gray-900 text-sm mt-1">{{$location->address}}</p>
            </div>
            <div class="mt-auto bg-gray-800 text-white text-right w-full px-4 py-2">
                <button>see more...<button>
            </div>
        </div>
</div>

@endforeach