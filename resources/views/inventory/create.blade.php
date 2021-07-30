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
                        <h6>Inventar nou:</h6>
                        <form action="{{route('checkCSV')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Nume:</label>
                            <input class="form-control mb-4" type="text" id="name" name="name">
                            <label for="observations">Observatii:</label>
                            <textarea class="form-control mb-4" id="observation" name="observation"
                                      rows="4"></textarea>
                            <label for="inventoryDate">Data / Ora inventar:</label>
                            <input class="form-control mb-4" type="text" name="inventoryDate" id="inventoryDate">
                            <div class="custom-file mb-4">
                                <label class="custom-file-label" for="gescomFile">Fisierul CSV din GESCOM:</label>
                                <input class="custom-file-input" type="file" name="gescomFile" id="gescomFile"
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
