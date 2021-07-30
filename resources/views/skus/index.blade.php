@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>SKU's</h4>
        </div>
    </div>

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
                        <th scope="col" class="text-center">Cat.</th>
                        <th scope="col">Unit</th>
                        <th scope="col">UMV</th>
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
                            <td><select class="form-control form-control-sm" name="interest">
                                    <option value="0">Toate</option>
                                    @foreach(\App\Interest::all() as $interest)
                                        <option value="{{$interest->id}}">{{$interest->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td colspan="3" class="text-right"><button class="btn btn-outline-primary btn-sm">Filtreaza</button></td>
                        </form>
                    </tr>
                    @foreach($skus as $sku)
                        <tr>
                            <td>{{$sku->id}}</td>
                            <td><a href="{{$sku->path()}}">{{$sku->sku}}</a></td>
                            <td><a href="{{$sku->path()}}">{{$sku->productName}}</a></td>
                            <td>{{$sku->ean}}</td>
                            <td class="text-center">{{$sku->interest->name}}</td>
                            <td>{{$sku->unit}}</td>
                            <td>{{$sku->sale_unit->value}}</td>
                            <td class="text-right">
                                <div class="dropdown p-0">
                                    <a href="#" class="btn btn-sm p-0"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('skus.show',$sku->id)}}"><button class="dropdown-item" type="button">Detalii</button></a>
                                        <form><button class="dropdown-item" type="button">Sterge</button></form>
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
