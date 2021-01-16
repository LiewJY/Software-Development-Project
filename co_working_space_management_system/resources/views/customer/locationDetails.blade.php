@extends('layouts.page')
@section('content')

    @livewire('customer.location-details', ["id" => $id])
    

@endsection