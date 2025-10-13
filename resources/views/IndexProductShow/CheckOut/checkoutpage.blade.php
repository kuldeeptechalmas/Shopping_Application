@extends('index')

@section('content')
<style>
    .checkout-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .section {
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .section:last-of-type {
        border-bottom: none;
    }

    h2 {
        color: #555;
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #666;
    }

    input[type="text"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .order-summary ul {
        list-style: none;
        padding: 0;
        margin-bottom: 10px;
    }

    .order-summary li {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px dashed #eee;
    }

    .order-summary p {
        font-weight: bold;
        text-align: right;
        margin-top: 10px;
    }

    .place-order-btn {
        background-color: #007bff;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .place-order-btn:hover {
        background-color: #0056b3;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-7">
            <div class="checkout-container">
                <h1>Checkout</h1>
                <form class="checkout-form" action="/order" method="POST">
                    @csrf
                    <div class="section">
                        <h2>Shipping Information</h2>

                        <input value="{{$customerdata}}" name="customer_data" hidden>
                        <input type="text" value="{{$cart}}" name="cart_data" hidden>

                        <label for="name">Full Name:</label>
                        <input type="text" id="nem" name="name" value="{{$customerdata->name}}">

                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="{{$customerdata->email}}">

                        <label for="phone">Phone No:</label>
                        <input type="text" id="phone" name="phone" value="{{$customerdata->phone}}">

                        <label for="country">Country:</label>
                        <select class="form-select" style="width: 96%;height: 51px;" id="country" value="{{old('country')}}" name="country">
                            <option value="">Select</option>
                            @if (isset($contrylist))
                            @foreach ($contrylist as $item)
                            <option value={{$item['id']}} {{$customerdata->country == $item['id'] ? 'selected' : ''}}>
                                {{$item['name']}}</option>
                            @endforeach
                            @endif
                        </select>
                        <br>

                        <label for="state">State:</label>
                        <select style="width: 96%;height: 51px;" class="form-select" id="state" value="{{old('state')}}" name="state">
                            <option value="">Select</option>
                        </select>
                        <br>

                        <label for="city">City:</label>
                        <select placeholder="Select" style="width: 96%;height: 51px;" class="form-select" id="city" value="{{old('city')}}" name="city">
                            <option value="">Select</option>
                        </select>
                        <br>

                        <label for="pincode">Pin Code:</label>
                        <input type="text" id="pincode" name="pincode" value="{{$customerdata->pincode}}">

                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="{{$customerdata->address}}">

                    </div>
                    <button type="submit" class="place-order-btn">Place Order</button>
                </form>
            </div>

        </div>
        <div class="col-5">
            <div class="checkout-container font-weight-bold">
                <h3 style="color: blue">Your order</h3>
                <div class="row" style="MARGIN-TOP: 32PX;">
                    <div class="col-6 fw-bold">PRODUCT</div>
                    <div class="col-6 fw-bold"> SUBTOTAL</div>
                </div>
                <hr>
                @if ($cart->isNotEmpty())
                @php
                $amount = 0;
                $dis = 0;
                @endphp
                @foreach ($cart as $item)
                <?php $discountusedata=0; ?>
                {{-- coupon data --}}
                @foreach ($couponuserdata as $cd)
                @if ($cd->product_id == $item->product->id)
                <?php     $discountusedata = $discountusedata+ $cd->coupon->value;
                                                $dis = $dis + $cd->coupon->value; ?>
                @endif
                @endforeach

                <div class="row">
                    <div class="col-6">{{$item->product->name}} × {{$item->quantity}}</div>
                    <div class="col-6">
                        ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100)-$discountusedata)}}</div>

                    @php

                    $amount = $amount + (round($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->quantity);
                    @endphp
                </div>
                <hr>
                @endforeach
                @endif
                <div class="row">
                    <div class="col-6 fw-bold">Total</div>
                    <div class="col-6 fw-bold"> ₹{{$amount-$dis}}</div>
                </div>
            </div>
            <div class="checkout-container font-weight-bold" style="margin-top: 24px;">
                <p>Payment</p>

                <input type="radio" name="paymentway" onclick="showpaymentdetail1()">
                <span style="margin-left: 14px;">Direct bank transfer</span><br>
                <div hidden id="detail1" style="margin-left: 32px;">
                    Make your payment directly into our bank account. Please use your Order ID as the payment reference.
                    Your order will not be shipped until the funds have cleared in our account.
                </div>
                <input type="radio" name="paymentway" style="margin-top: 12px;" onclick="showpaymentdetail2()">
                <span style="margin-left: 14px;">Add To Card</span><br>
                <div hidden id="detail2" style="margin-left: 32px;">
                    Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                </div>
                <input type="radio" name="paymentway" style="margin-top: 12px;" onclick="showpaymentdetail3()">
                <span style="margin-left: 14px;">Cash on delivery</span><br>
                <div hidden style="margin-left: 32px;" id="detail3">
                    Pay with cash upon delivery.
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        const selectElement = $('#state');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getstate"
            , data: {
                data: $('#country').val()
            , }
            , success: function(res) {

                var oldstate = "{{$customerdata->state}}";
                $("#state").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function(indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";

                    $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                });
            }
            , error: function(e) {
                console.log(e);

            }
        , })


        const selectElement1 = $('#city');
        selectElement1.empty();
        $.ajax({
            type: "get"
            , url: "/getcity"
            , data: {
                data: "{{$customerdata->state}}"
            , }
            , success: function(res) {

                var oldcity = "{{$customerdata->city}}";
                $("#city").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function(indexInArray, valueOfElement) {
                    var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                    $("#city").append(`<option value="${valueOfElement["id"]}" ${selectcity} >${valueOfElement["name"]}</option>`);

                });

            }
            , error: function(e) {
                console.log(e);

            }
        , })

    })

    function showpaymentdetail1() {
        $("#detail1").removeAttr("hidden");
        $("#detail2").attr("hidden", true);
        $("#detail3").attr("hidden", true);
    }

    function showpaymentdetail2() {
        $("#detail2").removeAttr("hidden");
        $("#detail1").attr("hidden", true);
        $("#detail3").attr("hidden", true);
    }

    function showpaymentdetail3() {
        $("#detail3").removeAttr("hidden");
        $("#detail2").attr("hidden", true);
        $("#detail1").attr("hidden", true);
    }

    $("#country").on("change", function() {
        const selectElement = $('#state');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getstate"
            , data: {
                data: $('#country').val()
            , }
            , success: function(res) {

                var oldstate = "{{old('state')}}";
                console.log(oldstate);
                $("#state").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function(indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                    console.log(selectstate);

                    $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                });
            }
            , error: function(e) {
                console.log(e);

            }
        , })
    });

    $("#state").on("change", function() {
        const selectElement = $('#city');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getcity"
            , data: {
                data: $('#state').val()
            , }
            , success: function(res) {
                $("#city").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function(indexInArray, valueOfElement) {
                    $("#city").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);

                });

            }
            , error: function(e) {
                console.log(e);

            }
        , })
    });

</script>
@endsection
