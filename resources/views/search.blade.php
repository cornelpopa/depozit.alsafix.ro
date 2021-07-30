@extends('layouts.app')

@section('content')


    @if($skus)

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Rezultate cautare <strong>{{$searchAll}}</strong> in SKU's <small>(limita 5)</small>
                </h6>

                <div class="table-responsive">
                    <table class="table table-small table-hover">
                        <caption>Lista SKU</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Denumire</th>
                            <th scope="col">EAN</th>
                            <th scope="col">Unit</th>
                            <th scope="col" class="text-right">Act</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($skus as $sku)
                            <tr>
                                <td>{{$sku->id}}</td>
                                <td><a href="{{$sku->path()}}">{{$sku->sku}}</a></td>
                                <td><a href="{{$sku->path()}}">{{$sku->productName}}</a></td>
                                <td>{{$sku->ean}}</td>
                                <td>{{$sku->unit}}</td>
                                <td class="text-right">
                                    <div class="dropdown p-0">
                                        <a href="#" class="btn btn-sm p-0"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('skus.show',$sku->id)}}">
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


            </div>
        </div>

    @endif

    @if($receptionElements)

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Rezultate cautare <strong>{{$searchAll}}</strong> in Receptii <small>(limita
                        5, cele mai noi)</small></h6>

                <div class="table-responsive">
                    <table class="table table-small table-hover">
                        <caption>Lista elemente</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Receptia</th>
                            <th scope="col">Data</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Denumire</th>
                            <th scope="col" class="text-right">Total</th>
                            <th scope="col" class="text-right">Act</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receptionElements as $receptionElement)
                            <tr>
                                <td>
                                    <a href="{{route('receptions.show', $receptionElement->reception->id)}}">
                                        {{$receptionElement->reception->name}}
                                    </a>
                                </td>
                                <td>{{$receptionElement->reception->created_at->isoFormat("OD MMM OY")}}</td>
                                <td>{{$receptionElement->sku}}</td>
                                <td>{{$receptionElement->productName}}</td>
                                <td class="text-right">{{$receptionElement->qty}}</td>
                                <td class="text-right">{{getFormattedTotal($receptionElement->qty*$receptionElement->unit)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    @endif


    @if($dispatchElements)

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Rezultate cautare <strong>{{$searchAll}}</strong> in Iesiri <small>(limita
                        5, cele mai noi)</small></h6>

                <div class="table-responsive">
                    <table class="table table-small table-hover">
                        <caption>Lista elemente</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Iesirea</th>
                            <th scope="col">Data</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Denumire</th>
                            <th scope="col" class="text-right">Total</th>
                            <th scope="col" class="text-right">Act</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dispatchElements as $dispatchElement)
                            <tr>
                                <td>
                                    <a href="{{route('dispatches.show', $dispatchElement->dispatch->id)}}">
                                        {{$dispatchElement->dispatch->name}}
                                    </a>
                                </td>
                                <td>{{$dispatchElement->dispatch->created_at->isoFormat("OD MMM OY")}}</td>
                                <td>{{$dispatchElement->sku}}></td>
                                <td>{{$dispatchElement->productName}}</td>
                                <td class="text-right">{{$dispatchElement->qty}}</td>
                                <td class="text-right">{{getFormattedTotal($dispatchElement->qty*$dispatchElement->unit)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    @endif


@endsection
