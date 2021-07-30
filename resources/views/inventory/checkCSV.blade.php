@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Inventare</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Inventar de importat:</h6>

                        <form method="POST" action="{{route('inventories.store')}}">
                            @csrf
                            <label for="name">Nume:</label>
                            <input class="form-control mb-4" type="text" id="name" name="name"
                                   value="{{$formData['name']}}"
                                   readonly>
                            <label for="observations">Observatii:</label>
                            <textarea class="form-control mb-4" id="observation" name="observation"
                                      rows="4" readonly>{{$formData['observation']}}</textarea>
                            <label for="inventoryDate">Data / Ora inventar:</label>
                            <input class="form-control mb-4" type="text" name="inventoryDate" id="inventoryDate"
                                   value="{{$formData['inventoryDate']}}" readonly>
                            <div class="form-group mb-5">
                                <button class="form-control btn btn-primary" type="submit">Continua</button>
                                <a href="{{route('inventories.index')}}">
                                    <button class="form-control btn btn-outline-danger ml-5">Anuleaza</button>
                                </a>
                            </div>
                            <input type="hidden" name="newData" id="newData" value="{{serialize($newData)}}">
                        </form>

                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <caption>Inventar de importat</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Denumire</th>
                                    <th scope="col">Stoc</th>
                                    <th scope="col">Denumire in aplicatia Depozit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newData as $key => $row)
                                    <tr @if ($row[8] < 1 ) class="table-danger" @endif>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$row[0]}}</td>
                                        <td>{{$row[1]}}</td>
                                        <td>{{$row[4]}}</td>
                                        <td>
                                            @if ($row[8]>0)
                                                {{$row[9]}}
                                            @else
                                                {{"not found"}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection