@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Miscare exceptionala</h4>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{$sku->sku}} <small class="text-muted">{{$sku->productName}}</small>
                        </h6>
                        <form method="POST" action="{{route('skus.saveExceptional',$sku)}}">
                            @csrf
                            <label for="gescomClientName">Autor:</label>
                            <input class="form-control mb-4" type="text" id="gescomClientName" name="gescomClientName"
                                   value="{{auth()->user()->name}}" readonly>
                            <label for="note">Nota:</label>
                            <input class="form-control mb-4" type="text" id="note" name="note"
                                   value="">
                            @error('note')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                            <label for="unit">Unitate:</label>
                            <input class="form-control mb-4" type="number" id="unit" name="unit"
                                   value="{{old('unit') ?? $sku->unit}}" autocomplete="off">
                            <label for="qty">Cantitate:</label>
                            <input class="form-control mb-4" type="number" id="qty" name="qty"
                                   value="{{old('qty') ?? "0"}}">
                            <label for="qty">Total:</label>
                            <input class="form-control mb-4" type="number" id="total" name="total"
                                   value="{{old('total') ?? "0"}}" readonly>
                            <button type="submit" class="btn btn-primary">SALVEAZA</button>
                        </form>
                        @error('name')
                        <div class="row">
                            <div class="alert alert-danger">{{$message}}</div>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var unit = document.getElementById('unit');
        var qty = document.getElementById('qty');
        var total = document.getElementById('total')

        unit.addEventListener('keyup', function (){
            total.value = unit.value * qty.value;
        })
        unit.addEventListener('change', function (){
            total.value = unit.value * qty.value;
        })

        qty.addEventListener('keyup', function (){
            total.value = unit.value * qty.value;
        })
        qty.addEventListener('change', function (){
            total.value = unit.value * qty.value;
        })

    </script>

@endsection