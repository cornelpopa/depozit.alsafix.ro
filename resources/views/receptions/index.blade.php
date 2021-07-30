@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Receptii</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Receptie noua</h6>
                        <form method="POST" action="{{route('receptions.store')}}">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-sm-6 mr-0 pr-0">
                                    <input class="form-control" type="text" id="name" name="name" value="{{$max}}"
                                           placeholder="Inceput ID receptie">
                                </div>
                                <div class="col-sm-6 ml-0 pl-0">

                                    <div class="input-group">
                                        <input class="form-control" type="text" id="name2" name="name2"
                                               aria-describedby="button-addon1" value="{{date("ymd")}}" autofocus>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="button-addon1">Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Cauta</h6>
                        <form>
                            <div class="input-group">
                                <input class="form-control" type="text" name="search" id="search" value="{{$search ?? ''}}"
                                       aria-describedby="searchButton">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="searchButton" name="searchButton">
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
            <h6 class="card-title">Lista receptii</h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Lista receptii</caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Elemente</th>
                        <th scope="col" class="text-right">Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($receptions as $reception)
                        <tr>
                            <td>{{$reception->id}}</td>
                            <td><a href="{{route('receptions.show', $reception->id)}}">{{$reception->name}}</a></td>
                            <td>{{$reception->elementsCount()}}</td>
                            <td class="text-right">{{$reception->created_at->isoFormat("OD MMM OY")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if (isset($search))
                {{$receptions->appends(['search' => $search])->links()}}
            @else
                {{$receptions->links()}}
            @endif
        </div>
    </div>
@endsection