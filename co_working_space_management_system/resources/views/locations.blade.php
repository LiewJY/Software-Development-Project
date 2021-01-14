@extends('layouts.page')

@section('content')
    <br>
    <h1 class="font-serif sm:text-3xl text-2xl font-medium text-center title-font mb-4 text-gray-900 underline">Available Locations</h1>
    
        @livewire('locations')

@endsection

