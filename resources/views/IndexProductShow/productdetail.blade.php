@extends('index')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
                                <img class="h-75 w-100" style="object-fit: contain;"
                                    src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                            </div>
                            <?php        $count++; ?>
                        @else
                            <div style="height: 500px" class="carousel-item">
                                <img class="h-75 w-100" style="object-fit: contain;"
                                    src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                            </div>
                            <?php        $count++; ?>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;"
                        class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;"
                        class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @if ($productdatails->status == "in stock")
                <div class="row" style="margin-top: 21px;margin-left: 70px;">
                    <a href="/addtocart_desbord/{{$productdatails->id}}" class="col"
                        style="border-radius: 8px;text-align: center;background: #ae708c;margin-right: 11px;text-decoration: none;  color:white;">
                        <p class="m-3">
                            ADD TO CART
                        </p>
                    </a>
                    <a class="col"
                        style="border-radius: 8px;text-align: center;background: #ae708c;text-decoration: none;  color:white;">
                        <p class="m-3">
                            BUY NOW
                        </p>
                    </a>
                </div>
            @else
                <div class="row" style="margin-top: 21px; margin-left: 70px;">
                    <a class="col"
                        style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #ae708c;margin-right: 11px;text-decoration: none;  color:white;">
                        <p class="m-3">
                            ADD TO CART
                        </p>
                    </a>
                    <a class="col"
                        style="cursor: not-allowed;border-radius: 8px;text-align: center;background: #ae708c;text-decoration: none;  color:white;">
                        <p class="m-3">
                            BUY NOW
                        </p>
                    </a>
                </div>
            @endif
        </div>

        <div class="col">
            <div class="likes">
                @if (isset($wishlist))
                    @if ($wishlist->product_id == $productdatails->id)
                        <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')"
                            style="color: red;"></i>
                    @else
                        <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')"
                            style="color: #c2c2c2;"></i>
                    @endif
                @else
            
                <i class="fa-solid fa-heart" onclick="favourite_product_data_save(this,'{{$productdatails->id}}')"
                    style="color: #c2c2c2;"></i>
                @endif
            </div>
            <p>
            <h5>{{$productdatails->name}}</h5>
            </p>
            <br>
            <h2>₹{{round($productdatails->price- ($productdatails->price * $productdatails->discount /100))}}</h2>
                        <div style="color: green"><del>₹{{$productdatails->price}}</del>     {{$productdatails->discount}}%  off</div>
            <br>
            @if ($productdatails->status == "in stock")
                <div class="text-success">{{$productdatails->status}}</div>
            @else
                <div class="text-danger">{{$productdatails->status}}</div>
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
                        Available Offers:{{$couper}}
                    </div>
                    <div class="col-9">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @toastifyJs
    <script>
        function favourite_product_data_save(rs, productid) {

            var element = $(rs)[0].style.color;


            if (element != "red") {

                $.ajax({
                    url: "/favourite/" + productid,
                    type: "get",
                    success: function (res) {
                        if (res.url) {
                            window.location.href = res.url;
                        }
                        else {
                            $(rs)[0].style.color = "red";
                        toastify().success('Add to Wishlist !!!', {
                            position: 'center',
                        });
                        }
                        
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            }
            else {
                $.ajax({
                    url: "/removewishlist/" + productid,
                    type: "get",
                    success: function (res) {
                        if (res.url) {
                            window.location.href = res.url;
                        }
                        else {
                            $(rs)[0].style.color = "#c2c2c2";
                            toastify().error('Remove in Wishlist', {
                                position: 'center',
                            });
                        }
                    },
                    error: function (e) {
                        console.log(e);

                    }
                })
            }
        }
    </script>
@endsection