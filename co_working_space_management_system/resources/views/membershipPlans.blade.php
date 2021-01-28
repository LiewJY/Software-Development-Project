@extends('layouts.page')

@section('content')
    <h1 class="text-center font-bold text-3xl md:text-4xl my-4">Available Plans</h1>
    
        @livewire('membership-plans')

@endsection
