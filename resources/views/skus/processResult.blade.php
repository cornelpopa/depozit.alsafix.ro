@extends('layouts.app')

@section('head')

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

@endsection

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Rezultate</h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold bg-dark-gradient p-2 rounded">Procesat {{count($processed)}} elemente, ignorat {{count($skipped)}} dintr-un total de {{$total}} elemente</h3>

                        <h4 class="mt-4 ml-3">Lista elementelor ignorate</h4>
                        @forelse($skipped as $item)
                            <div class="row ml-3">
                                {{$item}}
                            </div>
                        @empty
                            <div class="row ml-3">
                                Nu au fost elemente ignorate!
                            </div>
                        @endforelse

                        <h4 class="mt-4 ml-3">Lista elementelor procesate</h4>
                        @forelse($processed as $item)
                            <div class="row ml-3">
                                {{$item->sku}} -> {{$interests->where('id', $item->interest_id)->first()->name}}
                            </div>
                        @empty
                            <div class="row ml-3">
                                Nu au fost elemente procesate!
                            </div>
                        @endforelse


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
