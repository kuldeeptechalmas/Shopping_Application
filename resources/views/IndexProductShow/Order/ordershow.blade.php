@extends('index')

@section('content')

@if ($order->isNotEmpty())
<div class="row">
    <div class="col" style="padding: 10px 270px;">
        <h3 style="text-align: center;display: flex;justify-content: center;">
            <div style="background: white;border-radius: 10px;width: 181px;height: 38px;">My Orders</div>
        </h3>
        @foreach ($order as $item)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4" style="height: 100px; width: 111px;">
                        <a href="/ProductDetails/{{$item->product->id}}">
                            <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                        </a>
                    </div>
                    <div class="col-6">
                        <p class="card-text">{{$item->product->name}}</p>
                        <h6 class="card-title">
                            <?php        $dis = 0; ?>
                            @foreach ($couponuserdata as $cd)
                            @if ($cd->product_id == $item->product->id)
                            <?php                $dis = 1; ?>
                            ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100) - $cd->coupon->value)}}
                        </h6>
                        <div style="color: green">₹{{$cd->coupon->value}}off</div>
                        @endif
                        @endforeach

                        @if ($dis == 0)
                        ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}
                        @endif
                        <br>
                        Quentity : {{ $item->quantity }}
                        <div style="color: green"><del>₹{{$item->product->price}}</del> {{$item->product->discount}}%
                            off</div>
                        <div>
                            <p style="margin-top: 10px;">
                                Rating
                            </p>
                            @if (isset($item->rates))
                            @foreach (range(1,$item->rates->rate) as $it)
                            <i class="fa-solid fa-star star active" data-value="{{ $it }}" data-pid="{{ $item->product->id }}" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
                            @endforeach


                            @if ($item->rates->rate!=5)
                            @foreach (range($item->rates->rate+1,5) as $it)
                            <i class="fa-solid fa-star star" data-value="{{ $it }}" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
                            @endforeach
                            @endif

                            @else

                            <i class="fa-solid fa-star star" data-value="1" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Bad"></i>
                            <i class="fa-solid fa-star star" data-value="2" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Bad"></i>
                            <i class="fa-solid fa-star star" data-value="3" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Good"></i>
                            <i class="fa-solid fa-star star" data-value="4" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Very Good"></i>
                            <i class="fa-solid fa-star star" data-value="5" data-pid="{{ $item->product->id }}" style="color:#e0e0e0" data-toggle="tooltip" data-placement="top" title="Excellent"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-2">
                        <div style="margin-top: 14px;">
                            @if ($item->status == "Pending")
                            <i class="fa-solid fa-circle text-warning" style="font-size: 10px;"></i>
                            <span>{{$item->status}}</span>
                            @elseif ($item->status == "Processing" || $item->status == "Shipped")
                            <i class="fa-solid fa-circle text-info" style="font-size: 10px;"></i>
                            <span>{{$item->status}}</span>
                            @elseif ($item->status == "Delivered")
                            <i class="fa-solid fa-circle text-success" style="font-size: 10px;"></i>
                            <span>{{$item->status}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-flex justify-content-end">
                            <div style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                <p style="margin-top: 0px;">
                                    <button type="button" data-bs-toggle="modal" onclick="deleteorder('{{ $item->id }}')" data-bs-target="#exampleModal" style="color:red;background: white;border: none;">CANCLE ORDER</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Order Cancle Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div>
                <i class="fa-solid fa-xmark" data-bs-dismiss="modal" style="position: relative;top: 151px;left: 67%;color: white;font-size: 23px;"></i>
            </div>
            <div class="modal-dialog" style="margin-top: 123px;display: flex;justify-content: center;align-items: center;">
                <div class="modal-content" style="height: 213px;width: 391px;padding: 18px 14px 26px 28px;">
                    <h4>Remove Order</h4>
                    <div style="margin-top: 16px;">
                        Are you sure you want to cancle this order?
                    </div>
                    <div class="row" style="margin-top: 33px;">
                        <div class="col-6">
                            <form action="{{route('order.Product')}}" method="post">
                                @csrf
                                <input type="text" name="action" value="Remove" hidden id="">
                                <input type="text" name="orderId" value="{{$item->id}}" hidden id="orderId">

                                {{-- <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal" style="color:red;background: white;border: none;">CANCLE ORDER</button> --}}
                                <button type="submit" class="btn btn-primary" style="height: 56px;width: 150px;margin-top: 10px;">REMOVE</button>
                            </form>

                        </div>
                        <div class="col-6">
                            <button type="button" style="height: 56px;width: 150px;margin-left: -5px;margin-top: 10px;" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                    </div>

                </div>
            </div>
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
                Go back to My Order Page <br /><br />
                <a href="/order">
                    <button class="btn btn-primary" style="width: 192px;">Go To My Orders</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/customer/ordershow.js') }}"></script>
@endsection
