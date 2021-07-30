@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-danger">
            <h6 class="card-title"><strong>Eroare!</strong></h6>
        </div>
        <div class="card-body">
            {{$errorMessage}}
        </div>
    </div>

@endsection