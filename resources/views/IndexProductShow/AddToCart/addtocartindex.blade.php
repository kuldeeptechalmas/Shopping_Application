@extends('index')

@section('content')

<div class="row">
    <div class="col-2">
    </div>
    {{-- customer is found then show cart --}}

    @if (Session::get("customeremail"))
    <div class="row">
        <div class="col-8">
            @if ($datacart->isNotEmpty())
            @foreach ($datacart as $item)
            @php
            $discountofvalue = 0;
            @endphp
            @foreach ($usercoupondata as $cd)
            @if ($cd->product_id == $item->product->id)
            @php
            $discountofvalue = $discountofvalue + $cd->coupon->value;
            @endphp
            @endif
            @endforeach
            <div class="card" style="margin-left: 25px;margin-top: 25px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4" style="width: 175px;height: 150px;">
                            <a href="/ProductDetails/{{$item->product->id}}" style="height: 100%">
                                <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                            </a>
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-between">
                            <div>
                                <p class="card-text">{{$item->product->name}}</p>
                                <h5 class="card-title">
                                    @if ($discountofvalue == 0)

                                    ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}
                                    @else
                                    ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100) - $discountofvalue)}}

                                    @endif
                                </h5>

                                @foreach ($usercoupondata as $cd)
                                @if ($cd->product_id == $item->product->id)
                                <div style="color: green">₹{{$cd->coupon->value}} off</div>
                                @endif
                                @endforeach

                                <div style="color: green"><del>₹{{$item->product->price}}</del>
                                    {{$item->product->discount}}% off</div>

                                {{-- quentity increament and decriment --}}
                                <div style="margin-top:17px;display:flex;">
                                    <input type="text" hidden value="{{$item->product->id}}">

                                    @if ($item->quantity==1)
                                    <div style="color:#c2c2c2;margin-top: 4px;border: 2px solid #c2c2c2;border-radius: 47px;width: 22px;height: 22px;display: flex;justify-content: center;align-items: center;">
                                        <i class="fa-solid fa-minus product_id" style="font-size: 12px;"></i>
                                    </div>
                                    @else
                                    <div onclick="minus_quentity(this)" style="margin-top: 4px;border: 2px solid black;border-radius: 47px;width: 22px;height: 22px;display: flex;justify-content: center;align-items: center;">
                                        <i class="fa-solid fa-minus product_id" style="font-size: 12px;"></i>
                                    </div>
                                    @endif

                                    <input type="text" name="quentity" oninput="DirectChangeInput('{{$item->product->id}}')" value="{{$item->quantity}}" style="width: 40px;margin-left: 10px;margin-right: 10px;text-align: center;" min="1" max="100" id="quentity">

                                    @if ($item->product->stock==0)
                                    <div style="color:#c2c2c2;margin-top: 4px;border: 2px solid #c2c2c2;border-radius: 47px;width: 22px;height: 22px;display: flex;justify-content: center;align-items: center;">
                                        <i class="fa-solid fa-plus queality product_id" style="font-size: 12px;"></i>
                                    </div>
                                    @else
                                    <div onclick="plus_quentity(this)" style="margin-top: 4px;border: 2px solid black;border-radius: 47px;width: 22px;height: 22px;display: flex;justify-content: center;align-items: center;">
                                        <i class="fa-solid fa-plus queality product_id" style="font-size: 12px;"></i>
                                    </div>
                                    @endif


                                    <input type="text" hidden value="{{$item->product->id}}">
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if ($item->product->stock==0)
                                <div class="col-8" style="color: red;margin-top: 17px;">Now Limited Stock <br>Other Stock Come Then Notify</div>
                                @else
                                <div class="col-8"></div>
                                @endif

                                <div class="col-4 d-flex justify-content-end">
                                    <div style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">

                                        <div class="btn text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            REMOVE
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add To Cart Delete Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div>
                    <i class="fa-solid fa-xmark" data-bs-dismiss="modal" style="position: relative;top: 151px;left: 67%;color: white;font-size: 23px;"></i>
                </div>
                <div class="modal-dialog" style="margin-top: 123px;display: flex;justify-content: center;align-items: center;">
                    <div class="modal-content" style="height: 213px;width: 391px;padding: 18px 14px 26px 28px;">
                        <h4>Remove Item</h4>
                        <div style="margin-top: 16px;">
                            Are you sure you want to remove this item?
                        </div>
                        <div class="row" style="margin-top: 33px;">
                            <div class="col-6">
                                <a href="/deletetocart/{{$item->product->id}}">
                                    <button type="button" class="btn btn-primary" style="height: 56px;width: 150px;margin-top: 10px;">REMOVE</button>
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="button" style="height: 56px;width: 150px;margin-left: -5px;margin-top: 10px;" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <hr style="box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.5);margin-left: 30px;">
            @endforeach
            <div class="card" style="margin-left: 25px;text-align: end;">
                <div style="margin-right: 68px;height: 55px;">
                    <a href="/SummryOfProduct">
                        <button class="btn " style="color:white;background:#fb641b;margin-top: 10px;">PLEASE
                            ORDER</button>
                    </a>
                </div>
            </div>
            @else
            <div style="background-color: transparent;">
                <img src="{{ asset('storage/UploadeFile/missingcart.png') }}" style="margin-left: 59%;margin-top: 10%;width:237px;" alt="Image">
            </div>
            @endif

        </div>
        @if ($datacart->isNotEmpty())
        <div class="col-4">
            <div class="card" style="border-radius: 0px;margin-top: 25px;">
                <div class="card-body">
                    <div>
                        <h5 class="card-subtitle mb-2 text-muted">PRICE DETAILS</h5>
                        <hr>
                    </div>

                    <div class="row">
                        @php

                        $count = 0;
                        $discount = 0;
                        $amount = 0;
                        $discountofvalues = 0;
                        @endphp
                        {{-- {{ $datacart }} --}}
                        @foreach ($datacart as $item)

                        @foreach ($usercoupondata as $cd)
                        @if ($cd->product_id == $item->product->id)
                        @php
                        $discountofvalues = $discountofvalues + $cd->coupon->value;
                        @endphp
                        @endif

                        @endforeach

                        @php
                        $count+=$item->quantity;
                        $amount = $amount + (round($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->quantity);
                        $discount = $discount + (round($item->product->price * $item->product->discount / 100));
                        $discount*= $item->quantity;
                        @endphp
                        @endforeach

                        <div class="col-8">
                            <h6 class="card-subtitle mb-2 text-muted">Price ({{$count}} item)</h6>
                        </div>
                        <div class="col-4 font-weight-bold"> ₹{{$amount + $discount - $discountofvalues}}</div>

                        <div class="col-8" style="margin-top: 20px;">
                            <h6 class="card-subtitle mb-2" style="color:green;">Special Discount</h6>
                        </div>
                        <div class="col-4 font-weight-bold" style="margin-top: 20px;color:green;">-
                            ₹{{$discountofvalues}}</div>

                        <div class="col-8" style="margin-top: 20px;">
                            <h6 class="card-subtitle mb-2" style="color:green;">Discount</h6>
                        </div>
                        <div class="col-4 font-weight-bold" style="margin-top: 20px;color:green;">- ₹{{$discount}}</div>

                    </div>
                    <hr>
                    <div class="row" style="font-weight: bold;">

                        <div class="col-8">
                            <h6 class="card-subtitle mb-2">Total Amount</h6>
                        </div>
                        <div class="col-4">₹{{$amount-$discountofvalues}}</div>
                    </div>
                    <hr>
                    <div class="row ms-2 text-success">
                        You will save ₹{{$discount}} on this order
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function DirectChangeInput(productId) {

        if ($("#quentity").val() == 0) {
            console.log("boom...");

            $("#quentity").val("");
        } else {

            if ($("#quentity").val() != "") {

                $.ajax({
                    type: "get"
                    , url: "/DirectChangeQuentity"
                    , data: {
                        product_id: productId
                        , queantity: $("#quentity").val()
                    , }
                    , success: function(res) {
                        console.log(res);

                        window.location.href = res.redirect_url;
                    }
                    , error: function(e) {
                        console.log(e);
                    }
                , });
            }
        }

    }

    function plus_quentity(e) {

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).next()[0].value
                , queantity: $(e).prev()[0].value
                , action: "plus"
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , });
    }

    function minus_quentity(e) {
        console.log($(e).prev()[0].value);

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).prev()[0].value
                , queantity: $(e).next()[0].value
                , action: "minus"
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , })
    }

</script>

@endsection
