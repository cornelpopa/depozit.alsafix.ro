@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Receptia {{$reception->name}} - Adaugare elemente</h4>
            <a href="{{route('receptions.show', $reception->id)}}">
                <button class="btn btn-primary"><i class="ti-check-box mr-2"></i>Finalizare</button>
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">EAN:</h6>
                        <form method="POST" action="{{route('addReceptionElements',$reception->id)}}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" id="ean" name="ean" value="" autofocus
                                       autocomplete="off" aria-describedby="button-ean">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-ean"><i
                                                class="ti-plus mr-2"></i> Adauga
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
                        <form method="POST" action="{{route('addReceptionElements',$reception->id)}}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" id="sku" name="sku" value="" autocomplete="off"
                                       aria-describedby="button-sku">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="SkuSend" id="button-sku" value="skuSend"><i
                                                class="ti-plus mr-2"></i> Adauga
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


       @include('receptionsElements.partialReceptionElements')

    </div>
    @if (!$errors->any())
        <audio autoplay>
            <source src="/assets/media/audio/beep-08b.mp3">
        </audio>
    @endif
@endsection