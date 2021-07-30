@extends('layouts.app')

@section('head')
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

@endsection

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
                        <h6>Lista inventare:</h6>

                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <caption>Lista inventare</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nume</th>
                                    <th scope="col">Observatii</th>
                                    <th scope="col">Data</th>
                                    <th scope="col" class="text-right">Elemente</th>
                                    <th scope="col" class="text-right">Act</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <form>
                                        <td></td>
                                        <td><input class="form-control form-control-sm" type="text" name="name"
                                                   id="name" placeholder="Nume" value="{{$filters["name"]}}"
                                                   autocomplete="off"></td>
                                        <td><input class="form-control form-control-sm" type="text" name="observation"
                                                   id="observation" placeholder="Observatie"
                                                   value="{{$filters["observation"]}}" autocomplete="off"></td>
                                        <td><input class="form-control form-control-sm" type="text"
                                                   name="inventoryRange"
                                                   id="inventoryRange" placeholder="Perioada"
                                                   value="{{$inventoryRange}}">
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-outline-primary btn-sm" type="submit">Filtreaza
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{$inventory->id}}</td>
                                        <td><a href="{{route('inventories.show', $inventory)}}">{{$inventory->name}}</a>
                                        </td>
                                        <td>{{$inventory->observation}}</td>
                                        <td>{{$inventory->inventoryDate}}</td>
                                        <td class="text-right">{{$inventory->elements_count}}</td>
                                        <td class="text-right">
                                            <div class="dropdown p-0">
                                                <a href="#" class="btn btn-sm p-0"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#">
                                                        <button class="dropdown-item" type="button">Detalii</button>
                                                    </a>
                                                    <form>
                                                        <button class="dropdown-item" type="button">Sterge</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$inventories->appends(['name' => $filters['name'], 'observation' => $filters['observation'], 'inventoryRange' => $inventoryRange])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <!-- Datepicker -->
    <script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>

    <script>
        'use strict';
        $(document).ready(function () {

            $('input[name="inventoryRange"]').daterangepicker({
                minYear: 2020,
                showISOWeekNumbers: true,
                locale: {
                    separator: ' → ',
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>

@endsection