<div>
    <h1 class="px-2 font-bold text-xl md:text-2xl pt-2">Membership Plans</h1>

    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name"/>
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Membership Plans</x-jet-button>
        </div>
    </div>
    <br>

    <div class="overflow-x-auto mx-1">
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-gray-700 text-white bg-gray-700">Name</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Price</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Description</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($membershipplans as $membershipplan)
                    <tr class="text-center">
                        <td class="border border-gray-400 bg-gray-100">{{$membershipplan ->name}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$membershipplan ->price}}</td>
                        <td class="border border-gray-400 bg-gray-100">{{$membershipplan ->description}}</td>
                        <td class="border border-gray-400  bg-gray-100 py-1.5">
                            <div class="border-none flex flex-row flex-nowrap justify-center">
                                <x-jet-button class="mx-2" wire:click="edit({{$membershipplan ->id}})">Edit</x-jet-button>
                                <x-jet-button class="mx-2" wire:click="deleteModal({{$membershipplan ->id}}, '{{$membershipplan ->name}}')">Delete</x-jet-button>
                            </div>
                        </td>


                    </tr>               
                @endforeach
            </tbody>
        </table>
        <br>
        {{$membershipplans->links()}}

        <x-jet-dialog-modal wire:model="membershipForm" >
            <x-slot name="title">
                    @if($membershipID)
                        <h1>Edit Membership</h1>
                    @else
                        <h1>Add Membership</h1>
                    @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    <x-jet-label for="name" value="Name"/>
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="name"/>
                    <x-jet-input-error for="name"/>

                    <x-jet-label for="price" value="Price"/>
                    <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.lazy="price"/>
                    <x-jet-input-error for="price"/>

                    <x-jet-label for="description" value="Description" />
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.lazy="description"/>
                    <x-jet-input-error for="description"/>
                </x-slot>
                <x-slot name="footer">
                    @if($membershipID)
                        <x-jet-button wire:click="store">Save</x-jet-button>
                    @else
                        <x-jet-button wire:click="store">Add</x-jet-button>
                    @endif
                        <x-jet-button wire:click="$toggle('membershipForm')">Cancel</x-jet-button>


                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <x-jet-dialog-modal wire:model="deleteConfirmationForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove the membership {{$name}}</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-danger-button wire:click="delete({{$membershipID}})">Delete</x-jet-button>
                    <x-jet-button wire:click="$toggle('deleteConfirmationForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>