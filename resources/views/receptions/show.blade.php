@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Receptia {{$reception->name}}</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Redenumeste receptia</h6>
                        <form method="POST" action="{{route('receptions.update', $reception->id)}}">
                            @csrf
                            @method('patch')
                            <div class="input-group">
                                <input class="form-control" type="text" id="name" name="name"
                                       value="{{$reception->name}}" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon1"><i
                                                class="ti-ink-pen mr-2"></i> Redenumeste
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 text-right">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Actiuni</h6>
                        <a href="{{route('addReceptionElements', $reception->id)}}">
                            <button class="btn btn-success"><i class="ti-plus mr-2"></i> Adauga</button>
                        </a>
                        <a href="{{route('exportReception' , $reception->id)}}">
                            <button class="btn btn-secondary"><i class="ti-export mr-2"></i> Exporta</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @include('receptionsElements.partialReceptionElements')
    </div>

@endsection