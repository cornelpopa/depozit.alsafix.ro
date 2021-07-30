<label for="sku">SKU:</label>
<input class="form-control mb-4" type="text" id="sku" name="sku" minlength="3"
       value="@if (isset($sku)){{$sku->sku}}@else{{ old('sku')}} @endif">
@error('sku')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="productName">Denumire:</label>
<input class="form-control mb-4" type="text" id="productName" name="productName" minlength="3"
       value="@if (isset($sku)){{$sku->productName}}@else{{ old('productName') }}@endif">
@error('productName')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="ean">EAN:</label>
<input class="form-control mb-4" type="text" id="ean" name="ean"
       value="@if (isset($sku)){{$sku->ean}}@else{{ old('ean') }}@endif">
@error('ean')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="unit">Unitate:</label>
<input class="form-control mb-4" type="number" id="unit" name="unit"
       value="@if (isset($sku)){{$sku->unit}}@else{{ old('unit') }}@endif">
@error('unit')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="interest">Categorie:</label>
<select class="form-control mb-4" name="interest_id">
    @foreach(\App\Interest::all()->sortBy('name') as $interest)
        <option value="{{$interest->id}}"
                @if(isset($sku) AND $sku->interest_id == $interest->id) selected="selected" @endif
        >{{$interest->name}}</option>
    @endforeach
</select>

<button type="submit" class="btn btn-primary">Submit</button>
