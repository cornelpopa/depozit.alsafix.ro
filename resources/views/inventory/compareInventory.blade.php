@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Comparatie stocuri - diferente</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Inventar din gescom:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <caption>Lista diferente</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Denumire Gescom</th>
                                    <th scope="col">Stoc Gescom</th>
                                    <th scope="col">Stoc Depozit</th>
                                    <th scope="col">Denumire Depozit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($compareData as $row)
                                    @if($row[2] > $row[3])
                                        <tr class="table-danger">
                                    @else
                                        <tr class="table-success">
                                            @endif
                                            <td><a href="{{route('skus.show', $row[5])}}">{{$row[0]}}</a></td>
                                            <td>{{$row[1]}}</td>
                                            <td>{{$row[2]}}</td>
                                            <td>{{$row[3]}}</td>
                                            <td>{{$row[4]}}</td>
                                        </tr>
                                        @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection