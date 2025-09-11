@extends('Shopkeeper.index')

@section('content')
    <div class="row">
        <div class="col-2">

        </div>
        <div class="row">
            <div class="col-8">
                {{-- @dd($datacart->isEmpty(),isset($datacart),empty($datacart)) --}}
                @if ($datacart->isNotEmpty())
                    @foreach ($datacart as $item)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <img style="width: 100%; height: 100%; object-fit: cover;"
                                            src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                                    </div>
                                    <div class="col-8">
                                        <p class="card-text">{{$item->product->name}}</p>
                                        <h5 class="card-title">{{$item->product->price}}</h5>

                                        <div class="d-flex ">
                                            <div
                                                style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                                <p style="margin-top: 27px;">
                                                    REMOVE
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.5);">
                    @endforeach
                @else
                    <div style="background-color: transparent;">
                        <img src="{{ asset('storage/UploadeFile/missingcart.png') }}" style="width:237px;" alt="Image">
                    </div>
                @endif

            </div>
            <div class="col-4">
                hello
            </div>
        </div>
    </div>


@endsection