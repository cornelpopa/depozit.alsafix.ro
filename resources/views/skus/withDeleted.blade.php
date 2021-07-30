@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Lista SKU</h6>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Lista SKU - {{$skus->total()}} elemente</caption>
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
                    <tr>
                        <form>
                            <td></td>
                            <td><input class="form-control form-control-sm" type="text" name="sku" id="sku" placeholder="SKU" value="{{$filters['sku']}}"></td>
                            <td><input class="form-control form-control-sm" type="text" name="productName"  id="productName"
                                       placeholder="Denumire" value="{{$filters['productName']}}"></td>
                            <td><input class="form-control form-control-sm" type="text" name="ean" id="ean" placeholder="EAN" value="{{$filters['ean']}}"></td>
                            <td colspan="2"><button class="btn btn-outline-primary btn-sm">Filtreaza</button></td>
                        </form>
                    </tr>
                    @foreach($skus as $sku)
                        <tr  @if ($sku->trashed()) class="alert-warning" @endif>
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
                                        <a href="{{route('skus.show',$sku->id)}}"><button class="dropdown-item" type="button">Detalii</button></a>
                                        <form action="{{route('skus.destroy',$sku->id)}}"
                                              method="POST">@method('delete')@csrf
                                            <button class="dropdown-item" type="submit">Restore</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$skus->appends(['sku' => $filters['sku'], 'productName' => $filters['productName'], 'ean' => $filters['ean']])->links()}}
        </div>
    </div>

@endsection
