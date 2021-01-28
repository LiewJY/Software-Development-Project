@extends('layouts.page')

@section('content')
    <br>
    <h1 class="text-center font-bold text-3xl md:text-4xl my-4">Available Locations</h1>
    
        @livewire('locations')

@endsection

