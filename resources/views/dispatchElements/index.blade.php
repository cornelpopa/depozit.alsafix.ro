@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Iesirea {{$dispatch->name}}</h4>
            <div>
                @if(auth()->user()->isAdmin())
                    <button class="btn btn-danger" data-toggle="modal" data-target="#stergeIesire">
                        <i data-feather="trash"></i>Sterge
                    </button>
                @endif
                <a href="{{route('DispatchElementsEdit', $dispatch)}}">
                    <button class="btn btn-primary"><i data-feather="edit"></i>Editeaza</button>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6>Detalii</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Gescom</th>
                                <th scope="col">Client</th>
                                <th scope="col">Oras</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Comanda</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$dispatch->dispatchDate}}</td>
                                <td>{{$dispatch->gescomCodeClient}}</td>
                                <td>{{$dispatch->gescomClientName}}</td>
                                <td>{{$dispatch->gescomCity}}</td>
                                <td>{{$dispatch->agent_id}}</td>
                                <td>{{$dispatch->gescomReferenceOrder}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6>Lista elemente</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <caption>Lista elemente</caption>
                            <thead class="thead-light">
                            <tr>
                                {{--<th scope="col">#</th>--}}
                                <th scope="col">SKU</th>
                                <th scope="col">Denumire</th>
                                <th scope="col">Unitate</th>
                                <th scope="col" class="text-right">Necesar</th>
                                <th scope="col" class="text-right">Total</th>
                                <th scope="col" class="text-right">Scanat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dispatchElements as $dispatchElement)

                                @if ($dispatchElement->qty * $dispatchElement->unit < $dispatchElement->qtyDelivered )
                                    <tr>
                                @endif
                                @if ($dispatchElement->qty * $dispatchElement->unit == $dispatchElement->qtyDelivered )
                                    <tr class="table-success">
                                @endif
                                @if ($dispatchElement->qty * $dispatchElement->unit > $dispatchElement->qtyDelivered )
                                    <tr class="table-danger">
                                        @endif
                                        {{--<td>{{$dispatchElement->id}}</td>--}}
                                        <td data-toggle="tooltip" title="{{$dispatchElement->ean}}"
                                            data-placement="top">{{$dispatchElement->sku}}</td>
                                        <td>{{$dispatchElement->productName}}</td>
                                        <td>{{$dispatchElement->unit}}</td>
                                        <td class="text-right">{{$dispatchElement->qtyDelivered}}</td>
                                        <td class="text-right">{{getFormattedTotal($dispatchElement->qty*$dispatchElement->unit)}}</td>
                                        <td class="text-right">{{$dispatchElement->qty}}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- .modal-sm -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="stergeIesire">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form method="POST" action="{{route('dispatches.destroy',$dispatch)}}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h6 class="modal-title">Stergere Iesire</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        Sunteti sigur ca doriti stergerea?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            <i data-feather="trash"></i>Sterge
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
