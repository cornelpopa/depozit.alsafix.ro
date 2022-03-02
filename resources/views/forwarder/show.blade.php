@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Curieri - info curier {{$forwarder->name}}</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title d-flex justify-content-between font-weight-bold">
                {{$forwarder->name}}
                <a href="{{route('forwarders.edit', $forwarder)}}">
                    <button class="btn">
                        <i data-feather="edit"></i>
                    </button>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="">Barcode: {{$forwarder->barcode}}</div>
            <div class="">Limite: {{$forwarder->limits}}</div>
            <div class="">Website: {{$forwarder->tracking_website}}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Info</div>
        <div class="card-body">Info</div>
    </div>

@endsection
