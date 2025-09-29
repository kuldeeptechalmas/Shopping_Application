@extends('index')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row">
    <div class="col-2">
    </div>
    {{-- customer is found then show cart --}}

    @if (Session::get("customeremail"))
    <div class="row">
        <div class="col-8">
            @if ($datacart->isNotEmpty())
            @foreach ($datacart as $item)
            <?php            $discountofvalue = 0; ?>
            @foreach ($usercoupondata as $cd)
            @if ($cd->product_id == $item->product->id)
            <?php                    $discountofvalue = $discountofvalue + $cd->coupon->value; ?>
            @endif
            @endforeach
            <div class="card" style="margin-left: 25px;margin-top: 25px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4" style="width: 255px;">
                            <a href="/productdetailsunkown/{{$item->product->id}}">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                            </a>
                        </div>
                        <div class="col-8">
                            <p class="card-text">{{$item->product->name}}</p>
                            <h5 class="card-title">
                                @if ($discountofvalue == 0)

                                ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}
                                @else
                                ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100) - $discountofvalue)}}

                                @endif
                            </h5>

                            @foreach ($usercoupondata as $cd)
                            @if ($cd->product_id == $item->product->id)
                            <div style="color: green">₹{{$cd->coupon->value}} off</div>
                            @endif
                            @endforeach

                            <div style="color: green"><del>₹{{$item->product->price}}</del>
                                {{$item->product->discount}}% off</div>
                            {{-- quentity increament and decriment --}}
                            <div style="margin-top:46px">
                                <input type="text" hidden value="{{$item->product->id}}">

                                <i class="fa-solid fa-minus product_id" onclick="minus_quentity(this)"></i>

                                <input type="text" name="quentity" value="{{$item->quantity}}" style="width: 29px;margin-left: 10px;margin-right: 10px;text-align: center;" min="1" max="100" id="quentity">

                                <i class="fa-solid fa-plus queality product_id" onclick="plus_quentity(this)"></i>

                                <input type="text" hidden value="{{$item->product->id}}">
                            </div>



                            <div class="d-flex justify-content-end">
                                <div style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                    <p style="margin-top: 27px;">
                                        <a href="/deletetocart/{{$item->product->id}}" id="remove_a">Remove</a>

                                        <!--Remove Cart Modal -->
                                        <div class="modal fade" id="removecart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Remove Item</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        Are you sure you want to remove this item?
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <a href="/deletetocart" id="remove_a"><button type="button" id="remove_button" class="btn btn-primary">REMOVE</button></a>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCLE</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.5);">
            @endforeach
            <div class="card" style="margin-left: 25px;text-align: end;">
                <div style="margin-right: 68px;height: 55px;">
                    <a href="/summryproductdetail">
                        <button class="btn " style="color:white;background:#fb641b;margin-top: 10px;">PLEASE
                            ORDER</button>
                    </a>
                </div>
            </div>
            @else
            <div style="background-color: transparent;">
                <img src="{{ asset('storage/UploadeFile/missingcart.png') }}" style="margin-left: 59%;margin-top: 10%;width:237px;" alt="Image">
            </div>
            @endif

        </div>
        @if ($datacart->isNotEmpty())
        <div class="col-4">
            <div class="card" style="border-radius: 0px;margin-top: 25px;">
                <div class="card-body">
                    <div>
                        <h5 class="card-subtitle mb-2 text-muted">PRICE DETAILS</h5>
                        <hr>
                    </div>

                    <div class="row">
                        <?php        $count = 0;
                    $discount = 0;
                    $amount = 0;
                    $discountofvalues = 0;?>
                        @foreach ($datacart as $item)

                        @foreach ($usercoupondata as $cd)
                        @if ($cd->product_id == $item->product->id)
                        <?php                    $discountofvalues = $discountofvalues + $cd->coupon->value; ?>
                        @endif
                        @endforeach

                        <?php            $count++;
                                        $amount = $amount + (round($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->quantity);
                                        $discount = $discount + (round($item->product->price * $item->product->discount / 100));
                                                                                                                                                                                                                                                                        ?>
                        @endforeach

                        <div class="col-8">
                            <h6 class="card-subtitle mb-2 text-muted">Price ({{$count}} item)</h6>
                        </div>
                        <div class="col-4 font-weight-bold"> ₹{{$amount + $discount - $discountofvalues}}</div>

                        <div class="col-8" style="margin-top: 20px;">
                            <h6 class="card-subtitle mb-2" style="color:green;">Special Discount</h6>
                        </div>
                        <div class="col-4 font-weight-bold" style="margin-top: 20px;color:green;">-
                            ₹{{$discountofvalues}}</div>

                        <div class="col-8" style="margin-top: 20px;">
                            <h6 class="card-subtitle mb-2" style="color:green;">Discount</h6>
                        </div>
                        <div class="col-4 font-weight-bold" style="margin-top: 20px;color:green;">- ₹{{$discount}}</div>

                    </div>
                    <hr>
                    <div class="row" style="font-weight: bold;">

                        <div class="col-8">
                            <h6 class="card-subtitle mb-2">Total Amount</h6>
                        </div>
                        <div class="col-4">₹{{$amount-$discountofvalues}}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @else
    {{-- customer is not found then use Session to show data
            done --}}
    <div class="row">
        <div class="col-8">
            @if (!empty($datacart))
            <?php        $removeid = 0; ?>
            @foreach ($datacart as $item1)
            <div class="card" style="margin-left: 25px;margin-top: 25px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4" style="width: 255px;;">
                            <a href="/productdetailsunkown/{{$item1['product_data']->id}}">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item1['product_data']->image) }}" alt="Image">
                            </a>
                        </div>
                        <div class="col-8">
                            <p class="card-text">{{$item1['product_data']->name}}</p>
                            @if (Session::get("discountamount"))
                            @if (Session::get("discountamount")["product_id"] == $item1['product_data']->id)


                            <h2>
                                ₹{{round($item1['product_data']->price - ($item1['product_data']->price *
                                                    $item1['product_data']->discount / 100) - Session::get("discountamount")["amount"])}}
                            </h2>
                            <div style="color: green">
                                ₹{{Session::get("discountamount")["amount"]}} off <a href="/removediscount/{{$item1['product_data']->id}}">Remove</a>
                            </div>
                            <div style="color: green">
                                <del>₹{{$item1['product_data']->price}}</del>
                                {{$item1['product_data']->discount}}% off
                            </div>
                            @else
                            <h5>₹{{round($item1['product_data']->price - ($item1['product_data']->price *
                                                    $item1['product_data']->discount / 100))}}</h5>
                            <div style="color: green">
                                <del>₹{{$item1['product_data']->price}}</del>
                                {{$item1['product_data']->discount}}% off
                            </div>
                            @endif

                            @else
                            <h5>₹{{round($item1['product_data']->price - ($item1['product_data']->price *
                                                $item1['product_data']->discount / 100))}}</h5>
                            <div style="color: green">
                                <del>₹{{$item1['product_data']->price}}</del>
                                {{$item1['product_data']->discount}}% off
                            </div>
                            @endif

                            <div style="margin-top:46px">
                                <input type="text" hidden value="{{$item1['product_data']->id}}">

                                <i class="fa-solid fa-minus product_id" onclick="minus_quentity(this)"></i>

                                <input type="text" name="quentity" value="{{$item1['quantity']}}" style="width: 29px;margin-left: 10px;margin-right: 10px;text-align: center;" min="1" max="100" id="quentity">

                                <i class="fa-solid fa-plus queality product_id" onclick="plus_quentity(this)"></i>

                                <input type="text" hidden value="{{$item1['product_data']->id}}">
                            </div>

                            <div class="d-flex justify-content-end">
                                <div style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                    <p style="margin-top: 27px;">
                                        <a href="/deletetocart/{{$removeid}}" id="remove_a">Remove</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php            $removeid++; ?>
            <hr style="box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.5);">
            @endforeach
            <div class="card" style="margin-left: 25px;text-align: end;">
                <div style="margin-right: 68px;height: 55px;">
                    <a href="/checkouttoconform">
                        <button class="btn " style="color:white;background:#fb641b;margin-top: 10px;">PLEASE
                            ORDER</button>
                    </a>
                </div>
            </div>
            @else
            <div style="background-color: transparent;">
                <img src="{{ asset('storage/UploadeFile/missingcart.png') }}" style="margin-left: 59%;margin-top: 10%;width:237px;" alt="Image">
            </div>
            @endif

        </div>
        @if (!empty($datacart))
        <div class="col-4">
            <div class="card" style="border-radius: 0px;margin-top: 25px;">
                <div class="card-body">
                    <div>
                        <h5 class="card-subtitle mb-2 text-muted">PRICE DETAILS</h5>
                        <hr>
                    </div>
                    <div class="row">
                        <?php        $count = 0;
                    $amount = 0; ?>
                        @if (isset(Session::get("discountamount")["amount"]))
                        @foreach ($datacart as $item1)

                        <?php            $count++;
                                        $amount = $amount + (round(($item1['product_data']->price - (($item1['product_data']->price * $item1['product_data']->discount / 100)) - Session::get("discountamount")["amount"])) * $item1['quantity']); ?>
                        @endforeach

                        @else
                        @foreach ($datacart as $item1)

                        <?php            $count++;
                                        $amount = $amount + (round(($item1['product_data']->price - (($item1['product_data']->price * $item1['product_data']->discount / 100)))) * $item1['quantity']); ?>
                        @endforeach
                        @endif


                        <div class="col-8">
                            <h6 class="card-subtitle mb-2 text-muted">Price ({{$count}} item)</h6>
                        </div>
                        <div class="col-4 font-weight-bold">₹{{$amount}}</div>

                    </div>
                    <hr>
                    <div class="row" style="font-weight: bold;">

                        <div class="col-8">
                            <h6 class="card-subtitle mb-2">Total Amount</h6>
                        </div>
                        <div class="col-4">₹{{$amount}}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function plus_quentity(e) {
        $(e).prev()[0].value = parseInt($(e).prev()[0].value, 10) + 1;

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).next()[0].value
                , queantity: $(e).prev()[0].value
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , });
    }

    function minus_quentity(e) {
        $(e).next()[0].value = $(e).next()[0].value - 1;
        console.log($(e).prev()[0].value);

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).prev()[0].value
                , queantity: $(e).next()[0].value
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , })
    }

</script>

@endsection
