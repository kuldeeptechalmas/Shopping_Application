@extends('index')

@section('content')
@toastifyCss
@if ($data->isNotEmpty())
<div class="row w-100" style="margin-left: 0px;display: flex;justify-content: center;padding-top: 10px;">
    {{-- @if ($item1->productsdata->isNotEmpty()) --}}
    <div class="col-3" style="margin-right: -15px;">
        <div style="padding: 10px 0px 22px 21px;background-color: #ffffff;">
            <h4>Filters</h4>
            {{-- {{ $data }} --}}
            <h6 style="padding-top: 11px;">CATEGORIES</h6>
            <span class="text-muted d-flex">
                <div style="height: 24px;width: 11%;">
                    <img style="width: 81%; height: 92%; object-fit: contain;" src="{{ asset('storage/UploadeFile/lessthen-categories.png' ) }}" alt="Image">
                </div>
                <a class="text-muted" style="text-decoration: none;color:black;" href="/getcategroywiseproduct/{{ $categoryname }}">
                    {{ $categoryname }}
                </a>
            </span>

            @if (isset($subcategoryname))
            <span class="text-muted d-flex" style="margin-left: 27px;">
                <a style="text-decoration: none;color:black;" href="/subgetcategroywiseproduct/{{ $subcategoryname }}">
                    {{ $subcategoryname }}


                </a>
            </span>
            @endif

            <div>
                <h6>BRAND</h6>
                @if (isset($brandproduct))
                @foreach ($brandproduct as $item)
                @if ($item->brand==ucfirst(strtolower($inputdata)))

                <div style="color: white;background: cornflowerblue;width: 100%;height: 40px;align-items: center;display: flex;justify-content: start;">
                    <input type="checkbox" name="" checked id="" style="margin-right: 10px;">
                    {{ $item->brand }}
                </div>
                @else

                <div style="width: 100%;height: 40px;align-items: center;display: flex;justify-content: start;">
                    <input type="checkbox" name="" id="" style="margin-right: 10px;">
                    {{ $item->brand }}
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-9">
        <div class="row">


            @foreach ($data as $item)

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 card" style="border: none;width: 13rem; margin: 10px;">
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
                            <div style="display: flex;">
                                <h5>₹{{round($item->price- ($item->price * $item->discount /100))}}</h5>
                                <div style="margin-left: 11px;">₹{{$item->price}} <span style="color: green">{{$item->discount}}% off</span></div>
                            </div>
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="display: flex;justify-content: center;margin-top: 116px;">
            <div>
                <div style="width: 100px; height: auto; display: flex;justify-content: center;">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
                </div>
            </div>
        </div>
        <div style="display: flex;justify-content: center;text-align: center;">
            <div>

                <h5>Sorry, no results found <br /></h5>
                Edit search or go back to Product Page <br /><br />
                <a href="/MyShop">
                    <button class="btn btn-primary" style="width: 192px;">Go To Product</button>
                </a>
            </div>
        </div>
        @endif
        @toastifyJs
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/customer/mainindex.js') }}"></script> --}}
        @endsection
