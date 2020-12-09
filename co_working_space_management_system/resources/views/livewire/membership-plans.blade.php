@foreach($memberships as $membership)

<div class="flex flext-start flex-row">
        <div class="flex flex-col flex-nowrap bg-gray-800 rounded-xl w-full overflow-hidden my-10 mx-2 border-2  border-gray-800">
            <div class="px-4 py-2">
                <h1 class="text-white font-bold text-3xl text-center uppercase">{{$membership->name}}</h1>
                <p class="text-gray-100 text-sm mt-1">{{$membership->description}}</p>
            </div>
            <div class="mt-auto flex items-center justify-between bg-white w-full px-4 py-2">
              <div class="flex items-left align-text-bottom">
                <h1 class="text-gray-800 font-bold text-lg">RM{{$membership->price}} <sub class="italic">/ month</sub></h1> 
              </div>
              <x-jet-button>Join Now</x-jet-button>
            </div>
        </div>
</div>
  
@endforeach



        

        

        