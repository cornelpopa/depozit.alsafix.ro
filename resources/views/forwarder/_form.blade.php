<label for="sku">Nume:</label>
<input class="form-control mb-4" type="text" id="name" name="name" minlength="3"
       value="@if (isset($forwarder)){{$forwarder->name}}@else{{ old('name')}} @endif">
@error('name')
<div class="alert alert-danger">{{$message}}</div>
@enderror
<label for="sku">Lungime scan:</label>
<input class="form-control mb-4" type="number" id="scan_length" name="scan_length"
       value="@if (isset($forwarder)){{$forwarder->scan_length}}@else{{ old('scan_length')}} @endif">
@error('scan_length')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="sku">Cod bare identificare:</label>
<input class="form-control mb-4" type="text" id="barcode" name="barcode" minlength="3"
       value="@if (isset($forwarder)){{$forwarder->barcode}}@else{{ old('barcode')}} @endif">
@error('barcode')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="limits">Limite cod bare citit (inceput-sfarsit):</label>
<input class="form-control mb-4" type="text" id="limits" name="limits" minlength="3"
       value="@if (isset($forwarder)){{$forwarder->limits}}@else{{ old('limits')}} @endif">
@error('limits')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="tracking_website">Website urmarire:</label>
<input class="form-control mb-4" type="text" id="tracking_website" name="tracking_website" minlength="3"
       value="@if (isset($forwarder)){{$forwarder->tracking_website}}@else{{ old('tracking_website')}} @endif">
@error('tracking_website')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<label for="is_active">Este activ?</label>
<select class="form-control form-control-sm" name="is_active" id="is_active">
    <option value="1"
            @if(isset($forwarder) && $forwarder->is_active) selected="selected" @endif
    >Da
    </option>
    <option value="0"
            @if(isset($forwarder) && !$forwarder->is_active) selected="selected" @endif
    >Nu
    </option>
</select>

<button type="submit" class="btn btn-primary mt-4">Submit</button>