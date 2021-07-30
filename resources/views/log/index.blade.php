@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Lista </h4>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary d-flex justify-content-between">
                        <div>
                            Test:
                        </div>
                        <div>
                            <a href="#">
                                <button class="btn btn-sm bg-success m-0">
                                    <i data-feather="plus"></i>
                                    <i data-feather="anchor"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-1 text-rose">#</div>
                            <div class="col-1 text-rose">Nume</div>
                            <div class="col-1 text-rose">Pret</div>
                            <div class="col-2 text-rose">Tip</div>
                            <div class="col-1 text-rose">Modul</div>
                            <div class="col-1 text-rose">Nivel</div>

                            <hr class="mt-2 mb-2">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection