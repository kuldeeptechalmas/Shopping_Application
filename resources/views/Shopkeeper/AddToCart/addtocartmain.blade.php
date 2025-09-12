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
                                        <div class="col-4">
                                            <a href="/productdetails/{{$item->product->id}}">
                                                <img style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                                            </a>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text">{{$item->product->name}}</p>
                                            <h5 class="card-title">₹{{$item->product->price}}</h5>

                                            <div class="d-flex justify-content-end">
                                                <div
                                                    style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                                    <p style="margin-top: 27px;">
                                                        {{-- <a href="/deletetocart/{{$item->id}}" --}} <div data-bs-toggle="modal"
                                                            data-bs-target="#removecart"
                                                            style="text-decoration: none;color:red; cursor: pointer;">remove
                                                </div>
                                                <!--Remove Cart Modal -->
                                                <div class="modal fade" id="removecart" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Item</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Are you sure you want to remove this item?
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <a href="/deletetocart/{{$item->id}}"><button type="button"
                                                                        class="btn btn-primary">REMOVE</button></a>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">CANCLE</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                    <img src="{{ asset('storage/UploadeFile/missingcart.png') }}"
                        style="margin-left: 59%;margin-top: 10%;width:237px;" alt="Image">
                </div>
            @endif

        </div>
        @if ($datacart->isNotEmpty())
            <div class="col-4">
                <div class="card" style="border-radius: 0px;">
                    <div class="card-body">
                        <div>
                            <h5 class="card-subtitle mb-2 text-muted">PRICE DETAILS</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <?php    $count = 0;
            $amount = 0; ?>
                            @foreach ($datacart as $item)
                                            <?php        $count++;
                                $amount = $amount + $item->product->price; ?>
                                            {{-- {{$item->product->price}} --}}
                            @endforeach
                            <div class="col-8">
                                <h6 class="card-subtitle mb-2 text-muted">Price ({{$count}} item)</h6>
                            </div>
                            <div class="col-4 font-weight-bold">₹{{$amount}}</div>

                        </div>
                        <hr>
                        <div class="row" style="font-weight: bold;">

                            <div class="col-8">
                                <h6 class="card-subtitle mb-2">Total Amount</h6>
                            </div>
                            <div class="col-4">₹{{$amount}}</div>
                        </div>
                        {{-- <div>

                            <h6 class="card-subtitle mb-2 text-muted">Total Amount</h6>
                        </div> --}}
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>


@endsection