@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Inventar "{{$inventory->name}}"</h4>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Detalii inventar: # {{$inventory->id}}</h6>
                        <label for="name">Nume:</label>
                        <input class="form-control mb-4" type="text" id="name" name="name"
                               value="{{$inventory->name}}"
                               readonly>
                        <label for="observations">Observatii:</label>
                        <textarea class="form-control mb-4" id="observation" name="observation"
                                  rows="4" readonly>{{$inventory->observation}}</textarea>
                        <label for="inventoryDate">Data / Ora inventar:</label>
                        <input class="form-control mb-4" type="text" name="inventoryDate" id="inventoryDate"
                               value="{{$inventory->inventoryDate}}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6>Elemente:</h6>
                        <form action="{{route('inventories.show', $inventory)}}" method="GET">
                            <label for="search">Cauta SKU:</label>
                            <input class="form-control mb-4" type="text" id="search" name="search"
                                   value="{{$search ?? ""}}">
                        </form>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <caption>Inventar importat : {{$inventoryElements->total()}} elemente <br> {{$inventoryElements->appends(['search'=>$search])->links()}}</caption>
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Denumire</th>
                                    <th scope="col">Stoc</th>
                                    <th scope="col">Denumire in aplicatia Depozit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1 ?>
                                @foreach($inventoryElements as $inventoryElement)
                                    <tr>
                                        <td>{{($inventoryElements->currentPage()-1)*$inventoryElements->perPage()+ $i++}}</td>
                                        <td><a href="{{route('skus.show', $inventoryElement->sku)}}">{{$inventoryElement->readSku}}</a></td>
                                        <td>{{$inventoryElement->readProductName}}</td>
                                        <td>{{$inventoryElement->realStock}}</td>
                                        <td>{{$inventoryElement->sku->productName}}</td>
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