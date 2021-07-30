@extends('layouts.app')

@section('head')

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

@endsection

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Importare fisier relatii Sku -> categorie/interes</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Fisier:</h6>
                        <form action="{{route('skus.importSkuCat')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file mb-4">
                                <label class="custom-file-label" for="gescomFile">Fisierul CSV:</label>
                                <input class="custom-file-input" type="file" name="csv_file" id="csv_file"
                                       accept=".csv">
                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>

                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2">Model:</h6>
                        <a href="{{asset('assets/models/model.csv')}}" class="mb-4"><button class="rounded bg-dark-bright">Download</button></a>

                        <h6 class="mt-4">Lista categorii/interese:</h6>
                        <div class="table-responsive">
                            <table class="table table-small table-hover">
                                <caption>Lista categorii/interese</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Denumire</th>
                                    <th scope="col">ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\App\Interest::orderBy('Name')->get() as $interest)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$interest->name}}</td>
                                        <td>{{$interest->id}}</td>
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

@section('script')

    <!-- Datepicker -->
    <script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
    <script>
        'use strict';
        $(document).ready(function () {

            $('input[name="inventoryDate"]').daterangepicker({
                singleDatePicker: true,
                minYear: 2020,
                showISOWeekNumbers: true,
                timePicker: true,
                startDate: moment().startOf('hour'),
                timePicker24Hour: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });

            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            });
        });
    </script>

    <!-- Prism -->
    <script src="{{ url('vendors/prism/prism.js') }}"></script>

@endsection
