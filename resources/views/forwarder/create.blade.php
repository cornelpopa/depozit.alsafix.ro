@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Curieri</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Adaugă curier</h6>

            <form class="form-group" method="post" action="{{route('forwarders.store')}}">
                @csrf
                @include('forwarder._form')

            </form>
        </div>
    </div>

@endsection
