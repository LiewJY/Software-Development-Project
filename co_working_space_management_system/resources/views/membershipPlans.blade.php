@extends('layouts.page')

@section('content')
    <h1 class="text-center font-bold text-5xl mt-8 ">Avaliable Plans</h1>
    <div class="grid md:grid-cols-3 gap-4">
        @livewire('membership-plans')

    </div>

@endsection