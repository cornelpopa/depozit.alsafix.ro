@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>SKU's</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Editare SKU</h6>

            <form class="form-group" method="POST" action="{{ route('skus.store') }}">

                @csrf
                @include('skus._form')

            </form>

        </div>
    </div>

@endsection
