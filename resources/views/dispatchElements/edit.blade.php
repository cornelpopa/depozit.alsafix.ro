@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <div><h4>Iesirea {{$dispatch->name}} - Adaugare elemente</h4></div>
            <div>
                <a href="{{route('dispatches.updateSkuUnit',$dispatch)}}">
                    <button class="btn btn-primary"><i class="ti-reload mr-2"></i>Update SKU->unitate</button>
                </a>
                <a href="{{route('DispatchElementsIndex',$dispatch)}}">
                    <button class="btn btn-primary"><i class="ti-check-box mr-2"></i>Finalizare</button>
                </a>
                <a href="{{route('dispatches.create')}}">
                    <button class="btn btn-primary"><i class="ti-check-box mr-2"></i>Finalizare & Iesire noua</button>
                </a>
                @if($dispatch->phone)
                    <a href="{{route('shipping_info', $dispatch)}}">
                        <button class="btn btn-light-success"><i class="ti-check-box mr-2"></i>Expeditie</button>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">EAN:</h6>
                        <form method="POST" action="#">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" id="ean" name="ean" value="" autofocus
                                       autocomplete="off" aria-describedby="button-ean">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-ean" name="eanSend"
                                            value="eanSend"><i class="ti-plus mr-2"></i> Adauga
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if ($errors->any())
                            <div>
                                @foreach($errors->all() as $error)
                                    <li class="text-sm-left">{{$error}}</li>
                                @endforeach
                            </div>
                            <audio autoplay>
                                <source src="/assets/media/audio/error.mp3">
                            </audio>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">SKU:</h6>
                        <form method="POST" action="#">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" id="sku" name="sku" value="" autocomplete="off"
                                       aria-describedby="button-sku">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="SkuSend" id="button-sku"
                                            value="skuSend"><i
                                                class="ti-plus mr-2"></i> Adauga
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!$errors->any())
        <audio autoplay>
            <source src="/assets/media/audio/beep-08b.mp3">
        </audio>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


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
                                <th scope="col">Nume</th>
                                <th scope="col">GESCOM</th>
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
                                {{--{{dd($dispatchElement, $dispatchElement->skuD)}}--}}
                                @if ($dispatchElement->qty * $dispatchElement->unit > $dispatchElement->qtyDelivered )
                                    <tr class="table-danger">
                                        @endif
                                        {{--<td>{{$dispatchElement->id}}</td>--}}
                                        <td data-toggle="tooltip" title="{{$dispatchElement->ean}}"
                                            data-placement="top">
                                            <a href="{{route('skus.show', $dispatchElement->skuD->id)}}"
                                               target="_blank">
                                                <u>{{$dispatchElement->sku}}</u>
                                            </a>
                                        </td>
                                        <td>{{$dispatchElement->productName}}</td>
                                        <td>{{$dispatchElement->skuD->stock}}</td>
                                        <td>{{$dispatchElement->unit}}</td>
                                        <td class="text-right">{{$dispatchElement->qtyDelivered}}</td>
                                        <td class="text-right">{{getFormattedTotal($dispatchElement->qty*$dispatchElement->unit)}}</td>
                                        <td class="text-right">
                                            <div class="form-inline float-right">
                                                <form method="POST"
                                                      action="{{route('updateDispatchElement', [$dispatch, $dispatchElement])}}">
                                                    @csrf
                                                    <input class="form-control form-control-sm text-right no-spinners"
                                                           type="number"
                                                           name="qty" id="qty-{{$dispatchElement->id}}}"
                                                           value="{{$dispatchElement->qty}}">
                                                    <button type="submit" hidden></button>
                                                </form>
                                                <a href="{{route('moreDispatchElement',[$dispatch, $dispatchElement])}}">
                                                    <button class="btn btn-info btn-sm btn-floating"><i
                                                                class="ti-plus"></i></button>
                                                </a>
                                                <a href="{{route('lessDispatchElement',[$dispatch, $dispatchElement])}}">
                                                    <button class="btn btn-info btn-sm btn-floating"><i
                                                                class="ti-minus"></i></button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
