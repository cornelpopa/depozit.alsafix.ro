@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Slow Moving SKU's</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title">Lista SKU - {{$skus->count()}} elemente</h6>
                <div class="text-right">
                    <form action="" method="get" class="d-flex justify-content-between text-left pb-2">
                        <div class="pr-3">
                            <label for="interest_id" class="pl-1">Categorie</label>
                            <select name="interest_id" id="interest_id" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                @foreach(\App\Interest::orderBy('name')->get() as $interest)
                                    <option value="{{$interest->id}}"
                                            @if($interest->id == $interest_id) selected="selected" @endif>
                                        {{$interest->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="months">Perioada fara miscare:</label>
                            <select name="months" id="months" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                <option value="3" {{($months == 3 ? "selected" : "")}}>3 luni</option>
                                <option value="6" {{($months == 6 ? "selected" : "")}}>6 luni</option>
                                <option value="12" {{($months == 12 ? "selected" : "")}}>12 luni</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-small table-hover">
                    <caption>Lista Slow Moving SKU - {{$skus->count()}} elemente</caption>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Denumire</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Ultima miscare</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($skus as $sku)
                        <tr>
                            <td>{{$sku->id}}</td>
                            <td><a href="{{$sku->path()}}" target="_blank">{{$sku->sku}}</a></td>
                            <td><a href="{{$sku->path()}}" target="_blank">{{$sku->productName}}</a></td>
                            <td>{{$sku->stock}}</td>
                            <td>{{($sku->created_at ? $sku->created_at->format('Y-m-d') : "null")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
