@extends('index')

@section('content')

@toastifyCss

@if ($data->isNotEmpty())
<ul class="d-flex justify-content-around" style="list-style: none; box-shadow: 0px 3px 15px #afafaf; padding: 10px;">
    <li>
        <a href="/getcategroywiseproduct/Electronics" style="text-decoration: none;color:black;">
            <div style="width: 52px;margin-left: 10px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/phones.png') }}" alt="Image">
            </div>
            Electronics
        </a>
    </li>
    <li>
        <a href="/getcategroywiseproduct/TVs & Appliances" style="text-decoration: none;color:black;">
            <div style="width: 52px;margin-left: 25px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/tvandappliances.png') }}" alt="Image">
            </div>
            TVs & Appliances
        </a>
    </li>
    <li>
        <a href="/getcategroywiseproduct/Men" style="text-decoration: none;color:black;">
            <div style="width: 66px;margin-left: -8px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/man.png') }}" alt="Image">
            </div>
            Men
        </a>
    </li>
    <li>
        <a href="/getcategroywiseproduct/Women" style="text-decoration: none;color:black;">
            <div style="width: 66px;margin-left: -8px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/women.png') }}" alt="Image">
            </div>
            Women
        </a>
    </li>
    <li>
        <a href="/getcategroywiseproduct/Home & Furniture" style="text-decoration: none;color:black;">
            <div style="width: 90px;margin-left: 21px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/homeandfurniture.png') }}" alt="Image">
            </div>
            Home & Furniture
        </a>
    </li>
    <li>
        <a href="/getcategroywiseproduct/Sports, Books & More" style="text-decoration: none;color:black;">
            <div style="width: 52px;margin-left: 21px;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/running.png') }}" alt="Image">
            </div>
            Sports, Books & More
        </a>
    </li>
</ul>

{{-- Top Rating Product Show --}}

<h2 style="margin-left: 58px;">Top Rated</h2>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" style="padding-left:60px;width: 91%;height: 400px;margin: 11px 54px 7px 54px;background: white;margin-right: 55px;border-radius: 20px;">

        @if (isset($TopRateProduct))
        @foreach ($TopRateProduct as $key=>$item)

        <div class="carousel-item {{ $key==0 ? 'active':'' }}">
            <div class="row">
                <div class="col-6" style="margin-top: 51px;">
                    <div class="offer" style="top: 1%;left: -5%;margin-left: 0px;height: 47px;width: 51px;">
                    </div>
                    <div class="offer-text" style="margin-left: -54px;margin-top: -56px;">
                        <span>
                            {{ $item->discount }}% <br>
                            OFF
                        </span>
                    </div>
                    <div style="display: flex; align-items: center;justify-content: center;">
                        <a href="/ProductDetails/{{$item->id}}">
                            <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/'.$item->image) }}" alt="Image">
                        </a>
                    </div>
                </div>
                <div class="col-6" style="margin-top: 51px;padding-right: 77px;">
                    <a href="/ProductDetails/{{$item->id}}" style="text-decoration: none;color:black;">
                        <h5>{{ $item->name }}</h5><br>
                    </a>

                    <div style="display: flex;">
                        <div style="background: #388e3c;width: 49px;height: 22px;color:white;border-radius: 4px;display: flex;justify-content: center;align-items: center;">
                            {{round( $item->average_rating,1) }}
                            <i class="fa-solid fa-star" style="font-size: 11px;margin-top: 4px;margin-left: 2px;"></i>
                        </div>
                    </div><br>

                    @php
                    $dataString = $item->description;
                    $items = explode('-', $dataString);
                    @endphp

                    <h5>
                        @foreach($items as $its)
                        {{ $its }} <br>
                        @endforeach
                    </h5>

                    <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                        <h3>₹{{round($item->price- ($item->price * $item->discount /100))}}</h3>
                        <div style="color: green"><del>₹{{$item->price}}</del> {{$item->discount}}% off</div>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <button class="carousel-control-prev" style="width: 148px;" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" style="background-color: wheat;" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" style="background-color: wheat;margin-right:-27px;" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@foreach ($data as $item1)

<h1 class="ps-3">{{$item1->category_name}}</h1>
<div class="row w-100" style="padding-left: 27px;">
    @foreach ($item1->productsdata as $item)
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 card" style="border-radius: 10px;width: 18rem; margin: 10px;">
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
            @php
            $rateConversion = 0;
            $totalRate = 0;

            // Rate Calculation
            if ($item->rates->isNotEmpty()) {
            foreach ($item->rates as $value) {
            $totalRate += $value->rate;
            }
            $rates = ($totalRate * 100) / ($item->rates->count() * 5);
            $rateConversion = (float)(5 * $rates) / 100;
            }

            @endphp
            <div style="display: flex;">
                <div style="background: #388e3c;width: 49px;height: 22px;color:white;border-radius: 4px;display: flex;justify-content: center;align-items: center;">
                    {{round( $rateConversion,1) }}
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

@endforeach
@endif

@toastifyJs
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@endsection
