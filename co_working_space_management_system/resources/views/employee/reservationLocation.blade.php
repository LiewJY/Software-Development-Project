@extends('layouts.page')
@section('content')

    @livewire('employee.reservation-location', ["id" => $id])
    
@endsection