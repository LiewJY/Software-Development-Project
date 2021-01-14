<div>
@foreach($membershipplans as $membership)  
<div class="container px-5 py-10 mx-auto">
    <h1 class="font-serif sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900 underline">{{$membership->name}} Plan</h1>
    <p class="lg:w-2/3 leading-relaxed text-xl font-medium">
        Come & experience our inviting spaces for yourself as we offer the best workspace solutions for every office need. Ready to move-in office space located in prime locations across the Klang Valley equipped with the finest business amenities for you and your team!
    </p>
</div>

<div class="container px-5 py-3 mx-auto flex flex-col">
<!-- Content Staff -->
    <div class="flex flex-wrap -m-12 my-5">
      <div class="p-12 md:w-1/2 flex flex-col items-start border border-gray-300 bg-gray-100 rounded-lg">
        <h2 class="sm:text-3xl text-2xl title-font font-bold text-gray-900 mt-4 mb-4">Pricing</h2>
        <div class="flex justify-between gap-3">
            <span class="inline-block py-1 px-3">
                {{$membership->name}} Membership Plan
            </span>
            <span class="inline-block ml-10 py-1 px-3 rounded-full bg-gray-900 text-white text-sm font-medium tracking-widest">
                RM {{$membership->price}} /Month
            </span>
        </div>
        <div class="inline-flex items-center leading-none border-b-2 border-gray-200 w-full">
          <br>
        </div>
        <h2 class="sm:text-3xl text-2xl title-font font-bold text-gray-900 mt-4 mb-4">Features</h2>


        @php
          $descriptions = $membership->description;
          $description = (explode(",",$descriptions));         
        @endphp
        @foreach ($description as $desc)
        <div class="mt-auto flex h-full w-full pb-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"  fill="currentColor" stroke="currentColor" class="h-6 text-green-600 ">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="text-gray-900 text-sm mt-1">{{$desc}}</p><br>
        </div>
        @endforeach
      </div>
      <div class="p-12 md:w-1/2 flex flex-col items-start border border-gray-300 bg-gray-100 rounded-lg">
        
      </div>
    </div>
  </div>
  @endforeach
</div>