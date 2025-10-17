@extends('index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
    }

    .cross:hover {
        color: red;
    }

    .cart-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 20px auto;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .cart-items {
        border-top: 1px solid #eee;
        padding-top: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .cart-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 20px;
        border-radius: 4px;
    }

    .cart-item-details {
        flex-grow: 1;
    }

    .cart-item-details h3 {
        margin: 0 0 5px 0;
        color: #333;
    }

    .cart-item-details p {
        margin: 0;
        color: #777;
        font-size: 0.9em;
    }

    .cart-item-price {
        font-weight: bold;
        color: #555;
        margin-left: 20px;
    }

    .remove-button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8em;
        margin-left: 20px;
    }

    .remove-button:hover {
        background-color: #c82333;
    }

    .cart-summary {
        text-align: right;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .cart-summary p {
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    .checkout-button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1em;
        margin-top: 15px;
    }

    .checkout-button:hover {
        background-color: #218838;
    }

</style>

<div class="cart-container" style="margin-top: 133px;">
    <h1>Your Shopping Cart</h1>
    <div id="cart-items" class="cart-items">
        @if ($cart->isNotEmpty())
        <?php    $total = 0;$dis=0;?>
        @foreach ($cart as $item)
        <?php        $discountusedata = 0; ?>
        <div class="row" style="margin-bottom: 17px;">
            <div class="col-2" style="justify-content: center;display: flex;align-items: center;">
                <a href="/deletecartsummry/{{$item->id}}" id="remove_a"><i class="fa-solid fa-circle-xmark cross"></i></a>
            </div>
            <div class="col-2" style="width: 86px;">
                <a href="/ProductDetails/{{$item->product->id}}">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                </a>
            </div>
            <div class="col-2 d-flex align-items-center">
                <p style="width: 90px;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;}">
                    {{$item->product->name}}
                </p>
            </div>
            @foreach ($couponuserdata as $cd)
            @if ($cd->product_id == $item->product->id)
            <?php                $discountusedata = 1;
                                $dis=$dis+$cd->coupon->value; ?>
            @endif
            @endforeach

            @foreach ($couponuserdata as $cd)
            @if ($cd->product_id == $item->product->id)

            <div class="col-2 d-flex align-items-center">
                <p>₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100) -
                                        $cd->coupon->value)}}
                </p>
            </div>
            <div class="col-2 d-flex align-items-center">
                <p>{{$item->quantity}}</p>
            </div>
            <div class="col-2 d-flex align-items-center">
                <p>₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100)) *
                                        $item->quantity - $cd->coupon->value}}</p>
                <?php                $total += (round($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->quantity); ?>
            </div>
            @endif
            @endforeach

            @if ($discountusedata == 0)


            <div class="col-2 d-flex align-items-center">
                <p>₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}
                </p>
            </div>
            <div class="col-2 d-flex align-items-center">
                <p>{{$item->quantity}}</p>
            </div>
            <div class="col-2 d-flex align-items-center">
                <p>₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100)) *
                                $item->quantity}}</p>
                <?php            $total += (round($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->quantity); ?>
            </div>
            @endif

        </div>
        @endforeach
        @endif
    </div>

    <div class="cart-summary">
        <p>Total: ₹<span id="cart-total">{{$total-$dis}}</span></p>
        <a href="/CheckOut"><button class="checkout-button">Checkout</button></a>
    </div>
</div>

@endsection
