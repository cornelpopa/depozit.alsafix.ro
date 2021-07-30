<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6>Lista elemente</h6>
                <div class="table-responsive">
                    <table class="table table-small table-hover">
                        <caption>Lista elemente</caption>
                        <thead class="thead-light">
                        <tr>
                            {{--<th scope="col">#</th>--}}
                            <th scope="col">SKU</th>
                            <th scope="col">EAN</th>
                            <th scope="col">Denumire</th>
                            <th scope="col" class="text-right">Total</th>
                            <th scope="col" class="text-right">Act</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receptionElements as $receptionElement)
                            <tr @if (($lastModified ?? '') == $receptionElement->id) class="table-success" @endif>
                                {{--<td>{{$receptionElement->id}}</td>--}}
                                <td>{{$receptionElement->sku}}</td>
                                <td>{{$receptionElement->ean}}</td>
                                <td>{{$receptionElement->productName}}</td>
                                @if (isset($addForm))
                                    <td class="right">
                                        <div class="form-inline float-right">
                                            <form method="POST"
                                                  action="{{route('updateReceptionElement', [$reception, $receptionElement])}}">
                                                @csrf
                                                <input class="form-control form-control-sm text-right no-spinners"
                                                       type="number"
                                                       name="qty" id="qty-{{$receptionElement->id}}}"
                                                       value="{{$receptionElement->qty}}">
                                                <button type="submit" hidden></button>
                                            </form>
                                            <a href="{{route('plusReceptionElement',[$reception, $receptionElement])}}">
                                                <button class="btn btn-info btn-sm btn-floating"><i
                                                            class="ti-plus"></i></button>
                                            </a>
                                            <a href="{{route('minusReceptionElement',[$reception, $receptionElement])}}">
                                                <button class="btn btn-info btn-sm btn-floating"><i
                                                            class="ti-minus"></i></button>
                                            </a>

                                        </div>
                                    </td>
                                @else
                                    <td class="text-right">{{$receptionElement->qty}}</td>
                                @endif
                                <td class="text-right">{{getFormattedTotal($receptionElement->qty*$receptionElement->unit)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
