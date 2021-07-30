@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Detalii SKU - <strong>{{$sku->sku}}</strong></h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Detalii SKU</caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Denumire</th>
                        <th scope="col">EAN</th>
                        <th scope="col">Unit</th>
                        <th scope="col" class="text-right">Stock</th>
                        <th scope="col" class="text-center">Cat.</th>
                        <th scope="col" class="text-right">Act</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr @if ($sku->trashed()) class="alert-warning" @endif>
                        <td>{{$sku->id}}</td>
                        <td>{{$sku->sku}}</td>
                        <td>{{$sku->productName}}</td>
                        <td>{{$sku->ean}}</td>
                        <td>{{$sku->unit}}</td>
                        <td class="text-right">{{getFormattedTotal($stock)}}</td>
                        <td class="text-center">{{$sku->interest->name}}</td>
                        <td class="text-right">
                            <div class="dropdown p-0">
                                <a href="#" class="btn btn-sm p-0"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route("skus.edit", $sku->id)}}">
                                        <button class="dropdown-item" type="button">Edit</button>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{route("skus.exceptional", $sku->id)}}">
                                            <button class="dropdown-item" type="button">Miscare exceptionala</button>
                                        </a>
                                    @endif
                                    @if (!$sku->trashed())
                                        <form action="{{route('skus.destroy',$sku->id)}}"
                                              method="POST">@method('delete')@csrf
                                            <button class="dropdown-item" type="submit">Sterge</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h6>Miscare pe SKU</h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Miscare pe SKU</caption>
                    <thead class="thead-light">
                    <tr class="">
                        <th scope="col">#</th>
                        <th scope="col">Receptie/Iesire</th>
                        <th scope="col">Info</th>
                        <th scope="col">Data</th>
                        <th class="text-right" scope="col">Cantitate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($referenceInventory))
                        <tr class="table-warning">
                            <td><small>{{$referenceInventory->id}}</small></td>
                            <td>Inventar: {{$referenceInventory->name}}</td>
                            <td></td>
                            <td>{{$referenceInventory->inventoryDate->format('Y-m-d')}}</td>
                            <td class="text-right">{{getFormattedTotal($inventoryQuantity)}}</td>
                        </tr>
                    @endif
                    @foreach($allMovements as $movement)
                        @if($movement instanceof App\ReceptionElement)
                            <tr class="table-success">
                                <td><small>{{$movement->id}}</small></td>
                                <td>
                                    <a href="{{route('receptions.show', $movement->reception->id)}}">{{$movement->reception->name}}</a>
                                </td>
                                <td></td>
                                <td>{{$movement->updated_at->format('Y-m-d')}}</td>
                                <td class="text-right">{{getFormattedTotal($movement->qty * $movement->unit)}}</td>
                            </tr>
                        @else
                            @if($movement->dispatch->name > 9020000000 )
                                <tr class="table-secondary">
                            @else
                                <tr class="table-danger">
                            @endif
                                    <td><small>{{$movement->id}}</small></td>
                                    <td>
                                        <a href="{{route('dispatches.show', $movement->dispatch->id)}}">{{$movement->dispatch->name}}</a>
                                    </td>
                                    <td>{{$movement->dispatch->gescomClientName}}
                                        / {{$movement->dispatch->gescomCity}}</td>
                                    <td>{{$movement->updated_at->format('Y-m-d')}}</td>
                                    <td class="text-right">{{getFormattedTotal(-$movement->qty * $movement->unit)}}</td>
                                </tr>
                        @endif

                    @endforeach
                            <tr class="table-primary">
                                <td></td>
                                <td>Stoc:</td>
                                <td></td>
                                <td>{{date("Y-m-d")}}</td>
                                <td class="text-right">{{getFormattedTotal($stock)}}</td>

                            </tr>
                    </tbody>
                </table>

            </div>


        </div>
    </div>

@endsection
