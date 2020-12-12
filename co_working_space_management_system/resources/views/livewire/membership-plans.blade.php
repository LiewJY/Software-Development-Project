@foreach($memberships as $membership)
  <div class="flex flext-start flex-row">
    <div class="flex flex-col flex-nowrap bg-gray-800 rounded-xl w-full overflow-hidden my-10 mx-2 border-2  border-gray-800">
      <div class="px-4 py-2">
        <h1 class="text-white font-bold text-xl text-center uppercase">{{$membership->name}}</h1>
      </div>
      <div class="flex justify-center bg-white py-5 pt-5">
          <h1 class="text-gray-800 text-center font-bold text-xl">RM{{$membership->price}}<sub class="italic">/ month</sub></h1> 
      </div>
        
        @php
          $descriptions = $membership->description;
          $description = (explode(",",$descriptions));         
        @endphp
        @foreach ($description as $desc)
          <div class="mt-auto flex h-full justify-center bg-white w-full pb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"  fill="currentColor" stroke="currentColor" class="h-6 text-green-600 ">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="text-gray-900 text-sm mt-1">{{$desc}}</p><br>
          </div>
        @endforeach

          <div class="flex justify-center">
            <x-jet-button class="py-3 w-full flex items-center bg-white justify-center rounded-none">Join Now</x-jet-button>
          </div>
      </div>
  </div>
@endforeach



        

        