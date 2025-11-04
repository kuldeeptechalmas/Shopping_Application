@extends('index')

@section('content')
<style>
    .likes {
        position: absolute;
        right: 0px;
        background-color: #e9ecef;
        border-radius: 32px;
        padding: 15px;
        margin-top: 0px;
    }

</style>
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
                        <div style="height: 314px;">
                            <a href="/ProductDetails/{{$item->id}}">
                                <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/'.$item->image) }}" alt="Image">
                            </a>
                        </div>
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
{{--
<div class="slider-container" style="width: 95%;margin-left: 30px;">
    <div class="slider-title">Best of Electronics</div>
    <div class="arrow left" onclick="scrollSlider(-1074)">&#10094;</div>
    <div class="arrow right" onclick="scrollSlider(1074)">&#10095;</div>

    <div class="product-slider" id="slider">
        @foreach ($data as $item1)
        @foreach ($item1->productsdata as $item)

        <div class="product">
            <img src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="">
<h4>{{ $item->name }}</h4>
<p>₹{{ $item->price }}</p>
</div>
@endforeach
@endforeach

</div>
</div> --}}

@foreach ($data as $item1)


<div class="row" style="margin: 20px 20px 0px 20px;background: white;">
    <div style="display: flex;align-items: center;justify-content: space-between;">
        <div class="slider-title" style="margin: 20px 0px 20px 0px;">Best of {{$item1->category_name}}</div>
        <a href="/getcategroywiseproduct/{{$item1->category_name}}">
            <div style="margin-right: 17px;background-color: blue;width: 25px;color: white;border-radius: 15px;text-align: center;">&#10095;</div>
        </a>
    </div>

    @php
    $ct=1;
    @endphp
    @foreach ($item1->productsdata as $item)
    @php
    if($ct>10)
    {
    break;
    }
    @endphp
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 card" style="border: none;width: 14rem; margin: 10px;">
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
        <div style="margin: 13px;height: 213px; width: 100%;">
            <a href="/ProductDetails/{{$item->id}}">
                <div class="imagehover" style="height: 196px;width: 96%;margin-top: 20px;margin-left: -7px;">
                    <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
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
            <a href="/ProductDetails/{{$item->id}}" style="color:black;text-decoration:none;">
                <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                    <h4>₹{{round($item->price- ($item->price * $item->discount /100))}}</h4>
                    <div style="color: green"><del>₹{{$item->price}}</del> {{$item->discount}}% off</div>
                </p>
            </a>
        </div>
    </div>
    @php
    $ct++;
    @endphp
    @endforeach
    <br>
</div>

@endforeach
@endif

@toastifyJs
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@endsection
