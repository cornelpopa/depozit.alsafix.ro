@extends('layouts.app')

@section('head')
    <livewire:styles />
@endsection

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Notificare de livare BL - {{$dispatch->name}}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title d-flex justify-content-between font-weight-bold">
                {{$dispatch->gescomClientName}} | {{$dispatch->gescomCity}} | {{$dispatch->phone}}
            </h6>
        </div>
        <div class="card-body">
            <livewire:create-shipping-info :dispatch="$dispatch" :shipping_info="$shipping_info"/>
        </div>
    </div>

    <div class="card">

    </div>

@endsection

@section('script')
    <livewire:scripts />
@endsection
