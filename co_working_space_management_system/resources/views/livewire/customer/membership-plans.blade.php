<div>
@foreach($membershipplans as $membership)  
<div class="container px-5 py-10 mx-auto">
    <h1 class="font-serif sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900 underline">{{$membership->name}} Plan</h1>
    <p class="lg:w-2/3 leading-relaxed text-xl font-medium">
        Come & experience our inviting spaces for yourself as we offer the best workspace solutions for every office need. Ready to move-in office space located in prime locations across the Klang Valley equipped with the finest business amenities for you and your team!
    </p>
</div>

<div class="container px-5 py-3 mx-auto flex flex-col">
<!-- Content -->
    <div class="flex flex-wrap mx-1 my-5">
      <div class="p-12 lg:w-1/2 w-full flex flex-col items-start border border-gray-300 bg-gray-100 rounded-lg">
        <h2 class="sm:text-3xl text-2xl title-font font-bold text-gray-900 mt-4 mb-4">Pricing</h2>
        <div class="flex justify-between">
            <span class="inline-block py-1 px-1">
                {{$membership->name}} Membership Plan
            </span>
            <span class="inline-block ml-10 py-1 px-3 rounded-full bg-gray-900 text-white text-sm font-medium tracking-widest text-center items-center">
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
      <div class="p-12 lg:w-1/2 w-full flex flex-col items-start border border-gray-300 bg-gray-100 rounded-lg mt-2 lg:mt-0">
        <form class="w-full">
          <x-jet-label for="card_type" value="Card Type"/>
          <select id="card_type"  wire:model.lazy="card_type" name="card_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="default">Select a Card</option>
            <option value="">Visa</option>
            <option value="">Master</option>
          </select>
          <x-jet-input-error for="card_type"/> 

          <x-jet-label for="card_number" value="Card Number"/>
          <x-jet-input readonly id="card_number" type="text" class="mt-1 block w-full" wire:model.lazy="card_number"/>
          <x-jet-input-error for="card_number"/>

          <x-jet-label for="exp_date" value="Expire Date"/>
          <div class="flex justify-between gap-3">
            <span class="w-1/2">
                <x-jet-label for="month" value="Month" />
                <x-jet-input id="month" readonly type="text" class="mt-1 block w-full" wire:model.lazy="month" />
                <x-jet-input-error for="month" />
            </span>
            <span class="w-1/2">
                <x-jet-label for="year" value="Year" />
                <x-jet-input id="year" readonly type="text" class="mt-1 block w-full" wire:model.lazy="year" />
                <x-jet-input-error for="year" />
            </span>
          </div>
          <x-jet-label for="card_cvc" value="Card CVV2/CVC2/4DBC"/>
          <x-jet-input readonly id="card_cvc" type="text" class="mt-1 block w-1/4" wire:model.lazy="card_cvc"/>
          <x-jet-input-error for="card_cvc"/>


          <div class="py-4 bg-gray-100 text-left">
            <x-jet-button wire:click="">Clear</x-jet-button>
            {{-- this need to be type = "button" or not the form willl submit and not show popup --}}
            <x-jet-button type="button" wire:click="subscriptionConfirmationModal('{{$membership->name}}',  {{$membership->price}})">Pay</x-jet-button>
          </div>
        </form>

        
        
      </div>
    </div>
  </div>
  @endforeach
    <!-- Delete Modal -->
  <x-jet-dialog-modal wire:model="subscriptionConfirmation">
      <x-slot name="title">
          <h1>Delete Confirmation</h1>
      </x-slot>
      <form>
          <x-slot name="content">
            <p>You are going to subscribe to the {{$plan_name}} Plan for ONE MONTH with price of RM {{$plan_cost}}.</p>
          </x-slot>
          <x-slot name="footer">
            <x-jet-button wire:click="">Subscribe</x-jet-button>
            <x-jet-button wire:click="">Cancel</x-jet-button>
          </x-slot>
      </form>
  </x-jet-dialog-modal>
</div>