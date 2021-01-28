@extends('layouts.page')
@section('content')
<!-- Title -->
<h1 class="font-serif sm:text-3xl text-2xl font-bold title-font mb-4 text-gray-900 underline mx-3">Business Report</h1>

<!-- Status Bar -->
<div class="py-1 sm:px-1 lg:px-2">
    <div class="cointainer px-4 py-2 ">
        <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
            <div class="mb-4">
            <div class="shadow py-2 bg-gray-100">
                <div class="font-serif font-bold text-sm mb-1 mx-3">Total Approved Staff:</div>
                <div class="font-serif mb-0 text-gray-800 text-center">{{ $employeeCount }}</div>
            </div>
            </div>

            <div class="mb-4">
            <div class="shadow py-2 bg-gray-100">
                <div class="font-serif font-bold text-sm mb-1 mx-3">Total Customers:</div>
                <div class="font-serif mb-0 text-gray-800 text-center">1</div>
            </div>
            </div>

            <div class="mb-4">
            <div class="shadow py-2 bg-gray-100">
                <div class="font-serif font-bold text-sm mb-1 mx-3">Total Rooms Available:</div>
                <div class="font-serif mb-0 text-gray-800 text-center">1</div>
            </div>
            </div>

            <div class="mb-4">
            <div class="shadow py-2 bg-gray-100">
                <div class="font-serif font-bold text-sm mb-1 mx-3">Total Rooms under maintenance:</div>
                <div class="font-serif mb-0 text-gray-800 text-center">1</div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="py-3 border bg-gray-200">
    <livewire:admin.business-report/>
</div>
    


@endsection