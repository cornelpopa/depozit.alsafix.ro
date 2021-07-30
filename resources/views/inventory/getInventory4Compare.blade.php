@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Comparatie stoc</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Inventar din gescom:</h6>
                        <form action="{{route('compareInventory')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="inventoryDate">Data / Ora inventar:</label>
                            <input class="form-control mb-4" type="text" name="inventoryDate" id="inventoryDate">
                            <div class="custom-file mb-4">
                                <label class="custom-file-label" for="gescomFile">Fisierul CSV din GESCOM:</label>
                                <input class="custom-file-input" type="file" name="gescomFile" id="gescomFile"
                                       accept=".csv">
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
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