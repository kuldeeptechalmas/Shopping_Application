@extends('index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .likes {
        position: absolute;
        right: 10px;
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
    }

    .offer {
        position: absolute;
        margin-left: -12px;
        background-color: #fff;
        border-radius: 10px 0px;
        padding: 15px;
        background: #cc0c39;
        height: 41px;
        width: 45px;
    }

    .offer-text {
        font-size: 11px;
        color: white;
        position: absolute;
        /* right: 10px; */
        /* background-color: #fff; */
        border-radius: 10px;
        padding: 15px;
        margin-left: -14px;
        margin-top: -11px;
    }

    .productnamehover:hover {
        color: rgba(0, 0, 255, 0.575) !important;
    }

</style>
@toastifyCss

@if ($data->isNotEmpty())

<ul class="d-flex justify-content-around" style="list-style: none; box-shadow: 0px 3px 15px #afafaf; padding: 10px;">
    @foreach ($data as $item1)
    <a href="/getcategroywiseproduct/{{$item1->category_name}}" style="text-decoration: none;color:black;">
        <li>{{$item1->category_name}}</li>
    </a>
    @endforeach
</ul>
@foreach ($data as $item1)

<h1 class="ps-3">{{$item1->category_name}}</h1>
<div class="row w-100" style="padding-left: 27px;">
    @foreach ($item1->productsdata as $item)
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 card" style="width: 18rem; margin: 10px;">
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
<script>
    function favourite_product_data_save(rs, productid) {

        var element = $(rs)[0].style.color;
        console.log(element);

        if (element != "red") {

            $.ajax({
                url: "/favourite/" + productid
                , type: "get"
                , success: function(res) {
                    if (res.url) {
                        window.location.href = res.url;
                    } else {
                        toastify().success('Add To Favourite List', {
                            position: 'center'
                        , });
                        showproduct();
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
                        toastify().error('Remove in Wishlist', {
                            position: 'center'
                        , });
                        showproduct();
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
