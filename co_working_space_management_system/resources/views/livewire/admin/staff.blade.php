<div>
    <h1 class="px-2 font-bold text-xl md:text-2xl pt-2">Employee</h1>
    <div class="flex flex-row flex-wrap-reverse justify-between mt-4 px-2 py-2">
        <div class="w-full md:w-1/2">
            <x-jet-input class="w-full" type="search" wire:model="search" placeholder="Search by Name" />
        </div>
        <div class="w-full flex md:justify-end md:w-1/2 mb-3 md:mb-0">
            <x-jet-button class="w-full flex items-center justify-center md:w-auto" wire:click="add">Add Employee</x-jet-button>
        </div>
    </div>
    <br>
    @if (session()->has('success'))
    <div id="alert" class="relative py-3 pl-4 pr-10 leading-normal text-green-700 bg-green-100 rounded-lg">
        <p>{{ session('success') }}</p>
    </div>
    <br>
    @endif

    <div class="overflow-x-auto mx-1">
        @if(count($employees) === 0 )
        <x-emptyTable>
            <x-slot name="header">
                Employee
            </x-slot>
            <x-slot name="content">

                @if(!empty($search))
                There are no record of employee with the name "{{$search}}"
                @else
                Looks like there are no employee record.
                @endif
            </x-slot>
        </x-emptyTable>
        @else
        <table class="min-w-full table-auto border-collapse border border-black">
            <thead>
                <tr>
                    <th class="border border-gray-700 text-white bg-gray-700">Name</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Address</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Contact Number</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Username</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Email</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Role</th>
                    <th class="border border-gray-700 text-white bg-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr class="text-center">
                    <td class="border border-gray-400 bg-gray-100 mx-2">{{$employee ->last_name}} {{$employee ->first_name}}</td>
                    <td class="border border-gray-400 bg-gray-100 mx-2">{{$employee ->address}}</td>
                    <td class="border border-gray-400 bg-gray-100 mx-2">{{$employee ->contact_number}}</td>
                    <td class="border border-gray-400 bg-gray-100 mx-2">{{$employee ->username}}</td>
                    <td class="border border-gray-400 bg-gray-100 mx-2 px-2">{{$employee ->email}}</td>
                    <td class="border border-gray-400 bg-gray-100 mx-2 p-2">
                        @if($employee ->roles === 0)
                        Admin
                        @elseif($employee ->roles === 1)
                        Staff
                        @else
                        {{$employee ->roles}}
                        @endif
                    </td>
                    <td class="border border-gray-400 bg-gray-100 py-1.5">
                        <div class="border-none flex flex-row flex-nowrap justify-center">
                            <x-jet-button class="mx-2" wire:click="edit({{$employee->id}})">Edit</x-jet-button>
                            <x-jet-button class="mx-2" wire:click="deleteModal({{$employee ->id}}, '{{$employee ->first_name}}')">Delete</x-jet-button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{$employees->links()}}
        @endif

        <!-- Add and edit -->
        <x-jet-dialog-modal wire:model="employeeForm">
            <x-slot name="title">
                @if($employeeID)
                <h1>Edit Employee</h1>
                @else
                <h1>Add Employee</h1>
                @endif
            </x-slot>
            <form>
                <x-slot name="content">
                    @if($employeeID)
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <x-jet-label for="firstName" value="First name" />
                            <x-jet-input id="firstName" readonly type="text" class="mt-1 block w-full" wire:model.lazy="first_name" />
                            <x-jet-input-error for="first_name" />
                        </span>
                        <span class="w-1/2">
                            <x-jet-label for="lastName" value="Last name" />
                            <x-jet-input id="lastName" readonly type="text" class="mt-1 block w-full" wire:model.lazy="last_name" />
                            <x-jet-input-error for="last_name" />
                        </span>
                    </div>
                    @else
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <x-jet-label for="firstName" value="First name" />
                            <x-jet-input id="firstName" type="text" class="mt-1 block w-full" wire:model.lazy="first_name" />
                            <x-jet-input-error for="first_name" />
                        </span>
                        <span class="w-1/2">
                            <x-jet-label for="lastName" value="Last name" />
                            <x-jet-input id="lastName" type="text" class="mt-1 block w-full" wire:model.lazy="last_name" />
                            <x-jet-input-error for="last_name" />
                        </span>
                    </div>
                    @endif

                    <x-jet-label for="address" value="Address" />
                    <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model.lazy="address" />
                    <x-jet-input-error for="address" />

                    <x-jet-label for="contact_number" value="Contact Number" />
                    <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.lazy="contact_number" />
                    <x-jet-input-error for="contact_number" />


                    @if($employeeID)
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <x-jet-label for="username" value="Username" />
                            <x-jet-input id="username" readonly type="text" class="mt-1 block w-full" wire:model.lazy="username" />
                            <x-jet-input-error for="username" />
                        </span>
                        <span class="w-1/2">
                            <x-jet-label for="roles" value="Role" />
                            <select id="roles" disabled="true" wire:model.lazy="roles" name="roles" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default">Select a role</option>
                                <option value="0">Admin</option>
                                <option value="1">Staff</option>
                            </select>
                            <x-jet-input-error for="roles" />
                        </span>
                    </div>
                    <x-jet-label for="email" value="Email" />
                    <x-jet-input id="email" readonly type="text" class="mt-1 block w-full" wire:model.lazy="email" />
                    <x-jet-input-error for="email" />

                    @else
                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                            <x-jet-label for="username" value="Username" />
                            <x-jet-input id="username" type="text" class="mt-1 block w-full" wire:model.lazy="username" />
                            <x-jet-input-error for="username" />
                        </span>
                        <span class="w-1/2">
                            <x-jet-label for="roles" value="Role" />
                            <select id="roles" wire:model.lazy="roles" name="roles" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default">Select a role</option>
                                <option value="0">Admin</option>
                                <option value="1">Staff</option>
                            </select>
                            <x-jet-input-error for="roles" />
                        </span>
                    </div>
                    <x-jet-label for="email" value="Email" />
                    <x-jet-input id="email" type="text" class="mt-1 block w-full" wire:model.lazy="email" />
                    <x-jet-input-error for="email" />

                    <x-jet-label for="password" value="Password" />
                    <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.lazy="password" />
                    <x-jet-input-error for="password" />

                    <x-jet-label for="password_confirmation" value="Confirm Password" />
                    <x-jet-input id="password-confirm" class="block mt-1 w-full" type="password" name="password_confirmation" wire:model.lazy="password_confirmation" />
                    <x-jet-input-error for="password_confirmation" />
                    @endif
                </x-slot>
                <x-slot name="footer">
                    @if($employeeID)
                    <x-jet-button wire:click="update">Save</x-jet-button>
                    @else
                    <x-jet-button wire:click="store">Add</x-jet-button>
                    @endif
                    <x-jet-button wire:click="$toggle('employeeForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>

        <!-- Delete Modal -->
        <x-jet-dialog-modal wire:model="deleteConEmployeeForm">
            <x-slot name="title">
                <h1>Delete Confirmation</h1>
            </x-slot>
            <form>
                <x-slot name="content">
                    <p>Are you sure you want to remove the employee with the name {{$first_name}}.</p>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-danger-button wire:click="delete({{$employeeID}})">Delete</x-jet-button>
                        <x-jet-button wire:click="$toggle('deleteConEmployeeForm')">Cancel</x-jet-button>
                </x-slot>
            </form>
        </x-jet-dialog-modal>
    </div>
</div>