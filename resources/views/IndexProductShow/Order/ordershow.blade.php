@extends('index')

@section('content')

    @if ($order->isNotEmpty())
        <div class="row">
            <div class="col">
                <h1>Yours Buy Product</h1>
                @foreach ($order as $item)
                    {{-- @dd($item->product->id) --}}
                    <div class="card" style="margin-left: 25px;margin-top: 25px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4" style="width: 160px;">
                                    <a href="/productdetailsunkown/{{$item->product->id}}">
                                        <img style="width: 100%; height: 100%; object-fit: cover;"
                                            src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                                    </a>
                                </div>
                                <div class="col-8">

                                    <p class="card-text">{{$item->product->name}}</p>
                                    <h5 class="card-title">
                                        <?php $dis=0; ?>
                                        @foreach ($couponuserdata as $cd)
                                            @if ($cd->product_id == $item->product->id)
                                            <?php $dis=1; ?>
                                                    ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100) - $cd->coupon->value)}}
                                                </h5>
                                                <div style="color: green">₹{{$cd->coupon->value}}off</div>
                                            @endif
                                        @endforeach

                                        @if ($dis==0)
                                            ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}
                                        @endif

                                    <div style="color: green"><del>₹{{$item->product->price}}</del> {{$item->product->discount}}%
                                        off</div>
                                    <div style="margin-top: 14px;">
                                        {{$item->status}}
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div
                                            style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                            <p style="margin-top: 27px;">

                                                <a href="/deleteorder/{{$item->id}}" id="remove_a">Cancel</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
    @else
                        <div style="color: red;margin-top: 11%;margin-left: 41%;">
                            <h1>NOT ORDER</h1>
                        </div>
                    </div>
                </div>
            @endif
@endsection