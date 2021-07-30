@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Editare SKU</h6>

            <form class="form-group" method="POST" action="{{ route('skus.update', $sku->id) }}">

                @csrf
                @method('patch')
                @include('skus._form')

            </form>

        </div>
    </div>

@endsection
