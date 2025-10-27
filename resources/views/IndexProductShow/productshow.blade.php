@extends('index')

@section('content')

@toastifyCss

@if ($data->isNotEmpty())
<ul class="d-flex justify-content-around" style="list-style: none; box-shadow: 0px 3px 15px #afafaf; padding: 10px;">
    {{-- @foreach ($data as $item1)
    <a href="/getcategroywiseproduct/{{$item1->category_name}}" style="text-decoration: none;color:black;">
    <li>{{$item1->category_name}}</li>
    </a>
    @endforeach --}}
    {{-- @foreach ($data as $item1)
    <div class="hover-trigger position-relative">
        {{ $item1->category_name }}
    <div class="show-on-hover position-absolute" style="right: 0px;left: -49px; width: 222px; background: white;border-radius: 15px;">
        <div class="shadow p-3 bg-body rounded">
            @foreach ($item1->subcategory as $subcat)
            {{ $subcat->name }}
            <br>
            @endforeach
        </div>
    </div>
    </div>
    @endforeach --}}
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
