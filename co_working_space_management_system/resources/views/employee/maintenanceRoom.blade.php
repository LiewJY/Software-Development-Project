@extends('layouts.page')
@section('content')
    @livewire('employee.maintenance-room', ["id" => $id])
@endsection