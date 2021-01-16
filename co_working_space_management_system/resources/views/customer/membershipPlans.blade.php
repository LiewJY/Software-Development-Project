@extends('layouts.page')
@section('content')

    @livewire('customer.membership-plans', ["id" => $id])
    

@endsection