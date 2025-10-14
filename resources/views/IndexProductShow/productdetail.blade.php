@extends('index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .likes {
        position: absolute;
        right: 10px !important;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px !important;
        margin-top: 0px !important;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        height: 30px !important;
        width: 30px !important;
        padding: 20px !important;
    }

    .likes {
        position: absolute;
        right: 78px;
        background-color: #e9ecef;
        border-radius: 32px;
        padding: 15px;
        margin-top: 29px;
    }

    /* coupen css */


    .coupon-container {
        width: 188px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        height: 361px;

    }

    .coupon-header {
        background-color: #ff6347;
        /* Tomato color */
        color: white;
        padding: 15px 0;
        border-bottom: 2px solid #e0523a;
    }

    .coupon-header h2 {
        margin: 0;
        font-size: 1.8em;
        text-transform: uppercase;
    }

    .coupon-body {
        padding: 20px;
    }

    .discount-amount {
        font-size: 3em;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .deal-description {
        font-size: 1.1em;
        color: #555;
        margin-bottom: 15px;
    }

    .coupon-code {
        background-color: #f8f8f8;
        border: 1px solid #eee;
        padding: 10px 15px;
        border-radius: 5px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .code-label {
        font-weight: bold;
        color: #777;
        margin-right: 5px;
    }

    .code-value {
        font-size: 1.2em;
        font-weight: bold;
        color: #ff6347;
    }

    .expiration {
        font-size: 0.9em;
        color: #888;
    }

    .coupon-footer {
        background-color: #f2f2f2;
        padding: 10px 0;
        border-top: 1px solid #eee;
    }

    .disclaimer {
        font-size: 0.8em;
        color: #a0a0a0;
        margin: 0;
    }

</style>

@toastifyCss

<div class="row">
    <div class="col">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php $count = 0; ?>
                @foreach ($productdatails->images as $item)
                @if ($count == 0)
                <div style="height: 500px" class="carousel-item active">
                    <img class="h-75 w-100" style="object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @else
                <div style="height: 500px" class="carousel-item">
                    <img class="h-75 w-100" style="object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;" class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;" class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @if ($productdatails->stock > 0)
        <div class="row" style="margin-top: 21px;margin-left: 70px;">
            <a href="/addtocart_desbord/{{$productdatails->id}}" class="col" style="border-radius: 8px;text-align: center;background: #ae708c;margin-right: 11px;text-decoration: none;  color:white;">
                <p class="m-3">
                    ADD TO CART
                </p>
            </a>
            <a href="/BuyNow/{{$productdatails->id}}" class="col" style="border-radius: 8px;text-align: center;background: #ae708c;text-decoration: none;  color:white;">
                <p class="m-3">
                    BUY NOW
                </p>
            </a>
        </div>

        @else

        <div class="row" style="margin-top: 21px; margin-left: 70px;">
            <a class="col" style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #ae708c;margin-right: 11px;text-decoration: none;  color:white;">
                <p class="m-3">
                    ADD TO CART
                </p>
            </a>
            <a class="col" style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #ae708c;text-decoration: none;  color:white;">
                <p class="m-3">
                    BUY NOW
                </p>
            </a>
        </div>
        @endif
    </div>

    <div class="col">
        <div class="likes">
            @if (isset($wishlistProduct))
            @if ($wishlistProduct->product_id == $productdatails->id)
            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')" style="color: red;"></i>
            @else
            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')" style="color: #c2c2c2;"></i>
            @endif
            @else

            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')" style="color: #c2c2c2;"></i>
            @endif
        </div>
        <p>
            <h5>{{$productdatails->name}}</h5>
        </p>
        <br>

        @if (Session::get("discountamount"))
        @if (Session::get("discountamount")["product_id"] == $productdatails->id)

        <h2>₹{{round($productdatails->price - ($productdatails->price * $productdatails->discount / 100) - Session::get("discountamount")["amount"])}}
        </h2>
        <div style="color: green">
            <p> ₹{{Session::get("discountamount")["amount"]}} off <a href="/removediscount/{{$productdatails->id}}">Remove</a></p>
        </div>
        <div style="color: green"><del>₹{{$productdatails->price}}</del> {{$productdatails->discount}}% off</div>
        @else
        <h2>₹{{round($productdatails->price - ($productdatails->price * $productdatails->discount / 100))}}</h2>
        <div style="color: green"><del>₹{{$productdatails->price}}</del> {{$productdatails->discount}}% off</div>
        @endif
        @else

        @if (isset($coupenuserdata))
        <h2>₹{{round($productdatails->price - ($productdatails->price * $productdatails->discount / 100) - $coupenuserdata->coupon->value)}}
        </h2>
        <div style="color: green">
            <p> ₹{{$coupenuserdata->coupon->value}} off <a href="/removediscount/{{$productdatails->id}}">Remove</a></p>
        </div>
        <div style="color: green"><del>₹{{$productdatails->price}}</del> {{$productdatails->discount}}% off</div>
        @else
        <h2>₹{{round($productdatails->price - ($productdatails->price * $productdatails->discount / 100))}}</h2>
        <div style="color: green"><del>₹{{$productdatails->price}}</del> {{$productdatails->discount}}% off</div>
        @endif

        @endif
        <br>
        @if ($productdatails->stock > 0 )
        <div class="text-success">In Stock</div>
        @else
        <div class="text-danger">Out of Stock</div>
        @endif
        @php
        $dataString = $productdatails->description;
        $items = explode('-', $dataString);
        @endphp
        <div style="margin-top: 7%;">
            <div class="row">
                <div class="col">
                    Highlights:
                </div>
                <div class="col-9">
                    @foreach($items as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Available Offers:
                    @if ($coupen->isNotEmpty())
                    <div class="row" style="margin-top: 26px;">
                        @foreach ($coupen as $item)
                        <div class="col-4">
                            <div class="coupon-container">
                                <div class="coupon-header">
                                    <h2>Special Discount!</h2>
                                </div>
                                <div class="coupon-body">
                                    <p class="deal-description">{{$item->name}}</p>
                                    <p class="deal-description">Discount ₹{{$item->value}}</p>
                                    <div class="coupon-code">
                                        <span class="code-label">CODE:</span>
                                        <span class="code-value">{{$item->code}}</span>
                                    </div>
                                    @if (Session::get("customeremail"))
                                    <a href="/discountcoupun/{{$item->id}}/{{$productdatails->id}}">Apply</a>
                                    @else
                                    <a href="/discountcoupun/{{$item->value}}/{{$productdatails->id}}">Apply</a>

                                    @endif
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row w-100" style="padding-left: 27px;margin-top: 23px;">
    @foreach ($SuggestionProduct as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
        <div class="likes">
            @if (isset($wishlist))
            @if ($wishlist->contains('product_id', $item->id))
            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$item->id}}')" style="color: red;"></i>
            @else
            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$item->id}}')" style="color: #c2c2c2;"></i>
            @endif
            @else
            <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$item->id}}')" style="color: #c2c2c2;"></i>
            @endif
        </div>
        <div>
            <a href="/ProductDetails/{{$item->id}}">
                <div style="height: 300px; width: 100%;">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                </div>
            </a>
        </div>
        <div class="card-body">
            <p class="card-text" style="text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                <a class="productnamehover" href="/ProductDetails/{{$item->id}}" style="color:black;text-decoration:none;">
                    {{$item->name}}
                </a>
            </p>
            <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                <h3>₹{{round($item->price- ($item->price * $item->discount /100))}}</h3>
                <div style="color: green"><del>₹{{$item->price}}</del> {{$item->discount}}% off</div>
            </p>
        </div>
    </div>
    @endforeach
    <br>
</div>

@toastifyJs
<script>
    function favourite_product_data_save(rs, productid) {

        var element = $(rs)[0].style.color;


        if (element != "red") {

            $.ajax({
                url: "/favourite/" + productid
                , type: "get"
                , success: function(res) {
                    if (res.url) {
                        window.location.href = res.url;
                    } else {
                        $(rs)[0].style.color = "red";
                        toastify().success('Add to Wishlist !!!', {
                            position: 'center'
                        , });
                    }

                }
                , error: function(e) {
                    console.log(e);
                }
            })
        } else {
            $.ajax({
                url: "/removewishlist/" + productid
                , type: "get"
                , success: function(res) {
                    if (res.url) {
                        window.location.href = res.url;
                    } else {
                        $(rs)[0].style.color = "#c2c2c2";
                        toastify().error('Remove in Wishlist', {
                            position: 'center'
                        , });
                    }
                }
                , error: function(e) {
                    console.log(e);

                }
            })
        }
    }

</script>
@endsection
