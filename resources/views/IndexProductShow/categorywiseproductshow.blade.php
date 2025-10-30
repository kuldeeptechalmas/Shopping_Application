@extends('index')
@section('content')
@toastifyCss
@if ($data->isNotEmpty())
<ul class="d-flex justify-content-around" style="list-style: none; box-shadow: 0px 3px 15px #afafaf; padding: 10px;">
    @foreach ($alldata as $item1)
    <div class="hover-trigger position-relative">
        <a style="text-decoration: none;color:black;" href="/getcategroywiseproduct/{{ $item1->category_name }}">
            {{ $item1->category_name }}
        </a>
        <div class="show-on-hover position-absolute" style="right: 0px;left: -49px; width: 222px; background: white;border-radius: 15px;">
            <div class="shadow bg-body rounded">
                @foreach ($item1->subcategory as $subcat)
                <a class="sub_catagory" href="/subgetcategroywiseproduct/{{ $subcat->name }}">

                    {{ $subcat->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</ul>
@foreach ($data as $item1)
<div class="row w-100" style="margin-left: 15px;display: flex;justify-content: center;">
    @if ($item1->productsdata->isNotEmpty())
    <div class="col-3">
        <h1>hello</h1>
    </div>
    <div class="col-9">

        @foreach ($item1->productsdata as $item)
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="border-radius: 10px; margin: 10px;width: 96%;height: 270px;">
            <div class="row">
                <div class="col-6">
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
                    <div class="offer-text" style="margin-left: -4px;">
                        <span>
                            {{ $item->discount }}% <br>
                            OFF
                        </span>
                    </div>
                    <div style="margin: 13px;">

                        <a href="/ProductDetails/{{$item->id}}">
                            <div style="height:216px; width: 100%;">
                                <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6">
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
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="display: flex;justify-content: center;margin-top: 116px;">
        <div>
            <div style="width: 100px; height: auto; display: flex;justify-content: center;">
                <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
            </div>
        </div>
    </div>
    <div style="display: flex;justify-content: center;text-align: center;">
        <div>

            <h5>Sorry, no results found <br /></h5>
            go back to Product Page <br /><br />
            <a href="/MyShop">
                <button class="btn btn-primary" style="width: 192px;">Go To Product</button>
            </a>
        </div>
    </div>
    @endif
    <br>
</div>
@endforeach
@else
<div style="display: flex;justify-content: center;margin-top: 116px;">
    <div>
        <div style="width: 100px; height: auto; display: flex;justify-content: center;">
            <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
        </div>
    </div>
</div>
<div style="display: flex;justify-content: center;text-align: center;">
    <div>

        <h5>Sorry, no results found <br /></h5>
        go back to Product Page <br /><br />
        <a href="/MyShop">
            <button class="btn btn-primary" style="width: 192px;">Go To Product</button>
        </a>
    </div>
</div>
@endif
@toastifyJs

@endsection
