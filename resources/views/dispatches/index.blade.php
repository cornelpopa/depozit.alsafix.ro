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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Cauta</h6>
                        <form>
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" id="search" value="{{$search}}"
                                       aria-describedby="searchButton">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        Cauta
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Lista iesiri</h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>{{$dispatches->total()}} iesiri</caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Client</th>
                        <th scope="col">Elemente</th>
                        <th scope="col" class="text-right">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dispatches as $dispatch)
                        <tr>
                            <td>{{$dispatch->id}}</td>
                            <td><a href="{{route('dispatches.show', $dispatch->id)}}">{{$dispatch->name}}</a></td>
                            <td>{{$dispatch->gescomClientName}}</td>
                            <td>{{$dispatch->elementsCount}}</td>
                            <td class="text-right">{{$dispatch->created_at->isoFormat("YYYY-MM-DD")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$dispatches->appends(['search' => $search])->links()}}
        </div>
    </div>
@endsection