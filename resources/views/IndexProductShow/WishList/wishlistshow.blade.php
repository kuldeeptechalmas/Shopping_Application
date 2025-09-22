@extends('index')

@section('content')
    
@if ($wishlist->isNotEmpty())
    <div class="row">
        <div class="col">
            <h1>Yours Wishlist</h1>
                @foreach ($wishlist as $item)
                {{-- @dd($item->product->id) --}}
                  <div class="card" style="margin-left: 25px;margin-top: 25px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4" style="width: 160px;">
                                            <a href="/productdetailsunkown/{{$item->product->id}}">
                                                <img style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ asset('storage/UploadeFile/' . $item->product->image) }}"
                                                    alt="Image">
                                            </a>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text">{{$item->product->name}}</p>
                                            <h5 class="card-title">₹{{$item->product->price}}</h5>

                                            <div class="d-flex justify-content-end">
                                                <div
                                                    style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                                    <p style="margin-top: 27px;">

                                                    <a href="/removewishlist/{{$item->product->id}}" id="remove_a">REMOVE</a>
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
            <h1>NOT WISHLIST</h1>
           </div>
        </div>
    </div>
    @endif
@endsection