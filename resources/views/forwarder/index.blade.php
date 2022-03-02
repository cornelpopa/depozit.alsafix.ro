@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Curieri</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Lista curieri</h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Lista Curieri - {{$forwarders->count()}} elemente</caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nume</th>
                        <th scope="col">Lung.</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Limite</th>
                        <th scope="col" class="text-center">Activ</th>
                        <th scope="col" class="text-right">Act</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($forwarders as $forwarder)
                        <tr>
                            <td>{{$forwarder->id}}</td>
                            <td>
                                <a href="{{route('forwarders.show', $forwarder->id)}}">
                                    {{$forwarder->name}}
                                </a>
                            </td>
                            <td>{{$forwarder->scan_length}}</td>
                            <td>{{$forwarder->barcode}}</td>
                            <td>{{$forwarder->limits}}</td>
                            <td class="text-center">
                                @if($forwarder->is_active) <i data-feather="check"></i>@endif
                            </td>
                            <td class="text-right"><a href="{{route('forwarders.show', $forwarder->id)}}">
                                    <i data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>Nu sunt curieri definiți!</tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

@endsection
