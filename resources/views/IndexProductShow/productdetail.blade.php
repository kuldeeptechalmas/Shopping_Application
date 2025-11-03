@extends('index')

@section('content')

@toastifyCss

<div class="row" style="padding-top: 20px;">
    <div class="col">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">

                <?php $count = 0; ?>
                @foreach ($productdatails->images as $item)
                @if ($count == 0)
                <div style="height: 500px" class="carousel-item active">
                    <img class="h-75 w-100" style="object-fit: scale-down;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @else
                <div style="height: 500px" class="carousel-item">
                    <img class="h-75 w-100" style="object-fit: scale-down;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span style="height: 50px; width: 50px; background-color: #565656; border-radius: 50px; font-size: 30px;" class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span style="height: 50px; width: 50px; background-color: #565656; border-radius: 50px; font-size: 30px;" class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @if ($productdatails->stock > 0)
        <div class="row" style="margin-top: 21px;margin-left: 70px;">
            <a href="/addtocart_desbord/{{$productdatails->id}}" class="col" style="border-radius: 8px;text-align: center;background: #ff9f00;margin-right: 11px;text-decoration: none;  color:white;">
                <p class="m-3">
                    ADD TO CART
                </p>
            </a>
            <a href="/BuyNow/{{$productdatails->id}}" class="col" style="border-radius: 8px;text-align: center;background: #fb641b;text-decoration: none;  color:white;">
                <p class="m-3">
                    BUY NOW
                </p>
            </a>
        </div>

        @else

        <div class="row" style="margin-top: 21px; margin-left: 70px;">
            <a class="col" style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #ff9f00;margin-right: 11px;text-decoration: none;  color:white;">
                <p class="m-3">
                    ADD TO CART
                </p>
            </a>
            <a class="col" style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #fb641b;text-decoration: none;  color:white;">
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

        <p style="margin-top: 7px;">
        </p>
        @php
        $rateConversion = 0;
        $totalRate = 0;

        // // Rate Calculation
        if ($productdatails->rates->isNotEmpty()) {
        foreach ($productdatails->rates as $value) {
        $totalRate += $value->rate;
        }
        $rates = ($totalRate * 100) / ($productdatails->rates->count() * 5);
        $rateConversion = (float)(5 * $rates) / 100;
        }

        @endphp
        <div style="display: flex;">
            <div style="background: #388e3c;width: 49px;height: 22px;color:white;border-radius: 4px;display: flex;justify-content: center;align-items: center;">
                <div id="ratingsStar">
                    {{round( $rateConversion,1) }}
                </div>
                <i class="fa-solid fa-star" style="font-size: 11px;margin-top: 4px;margin-left: 2px;"></i>
            </div>
            <div style="margin-left:13px" id="ratingsUser">{{ $productdatails->rates->count() }} Ratings</div>
        </div>
        <div>
            <p style="margin-top: 10px;">
                Rating
            </p>
            @if (Session::get("customeremail"))
            @if (isset($ratingdata[0]->rate))

            @foreach (range(1,$ratingdata[0]->rate) as $it)
            <i class="fa-solid fa-star star active" data-value="{{ $it }}" data-pid="{{ $productdatails->id }}" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
            @endforeach

            @if ($ratingdata[0]->rate!=5)
            @foreach (range($ratingdata[0]->rate+1,5) as $it)
            <i class="fa-solid fa-star star" data-value="{{ $it }}" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
            @endforeach
            @endif

            @else
            <i class="fa-solid fa-star star" data-value="1" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
            <i class="fa-solid fa-star star" data-value="2" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Bad"></i>
            <i class="fa-solid fa-star star" data-value="3" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Good"></i>
            <i class="fa-solid fa-star star" data-value="4" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Good"></i>
            <i class="fa-solid fa-star star" data-value="5" data-pid="{{ $productdatails->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Excellent"></i>
            @endif
            @else
            <a href="/Login" style="text-decoration: none;">

                <i class="fa-solid fa-star" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
                <i class="fa-solid fa-star" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Bad"></i>
                <i class="fa-solid fa-star" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Good"></i>
                <i class="fa-solid fa-star" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Good"></i>
                <i class="fa-solid fa-star" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Excellent"></i>
            </a>
            @endif

        </div>
        @php
        $dataString = $productdatails->description;
        $items = explode('-', $dataString);
        @endphp
        <div style="margin-top: 5%;">
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

@if ($SuggestionProduct->isNotEmpty())
<div class=" row w-100" style="padding-left: 27px;margin-top: 23px;">
    <h3 style="padding-left: 27px;margin-top: 23px;">Similar Products</h3>
    @foreach ($SuggestionProduct as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="border-radius: 10px;width: 18rem; margin: 10px;">
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

        <div class="offer">
        </div>
        <div class="offer-text">
            <span>
                {{ $item->discount }}% <br>
                OFF
            </span>
        </div>
        <div style="margin: 13px;">
            <div>
                <a href="/ProductDetails/{{$item->id}}">
                    <div style="height: 300px; width: 100%;">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                    </div>
                </a>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text" style="text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                <a class="productnamehover" href="/ProductDetails/{{$item->id}}" style="color:black;text-decoration:none;">
                    {{$item->name}}
                </a>
            </p>
            @php
            $rateConversion = 0;
            $totalRate = 0;

            // // Rate Calculation
            if ($item->rates->isNotEmpty()) {
            foreach ($item->rates as $value) {
            $totalRate += $value->rate;
            }
            $rates = ($totalRate * 100) / ($item->rates->count() * 5);
            $rateConversion = (float)(5 * $rates) / 100;
            }

            @endphp
            <div style="display: flex;">
                <div style="background: #388e3c;width: 36px;height: 22px;color:white;border-radius: 4px;display: flex;justify-content: center;align-items: center;">
                    {{round($rateConversion,1) }}
                    <i class="fa-solid fa-star" style="font-size: 11px;margin-top: 4px;margin-left: 2px;"></i>
                </div>
                <div style="margin-left:13px">{{ $item->rates->count() }} Ratings</div>
            </div>
            <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                <h3>₹{{round($item->price- ($item->price * $item->discount /100))}}</h3>
                <div style="color: green"><del>₹{{$item->price}}</del> {{$item->discount}}% off</div>
            </p>
        </div>
    </div>
    @endforeach
    <br>
</div>
@endif
@toastifyJs
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/customer/ordershow.js') }}"></script>
@endsection
