@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Iesiri / Avize / BL</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Iesire noua</h6>
                        <form method="POST" action="{{route('dispatches.store')}}">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-sm-6 ml-0 pl-0">
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="name" name="name"
                                               aria-describedby="button-addon1" value="" autofocus>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="button-addon1">Add
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </form>
                        @error('name')
                        <div class="row">
                            <div class="alert alert-danger">{{$message}}</div>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
    </div>


@endsection