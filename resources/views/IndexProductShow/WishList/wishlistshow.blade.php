@extends('index')

@section('content')
<div class="row">
                    <h1 class="col-4">Yours Wishlist</h1>
                    <div class="col-4"></div>
                    <form class="d-flex dropdown_search_main col-4" style="align-items: center;" action="/searchwishlist" method="post" role="search"
                        style="width: 300px;">
                        @csrf
                        <input class="form-control dropdown_search me-2" type="search" id="search_id" placeholder="Search"
                            aria-label="Search" name="search_data" value="{{isset($inputdata) ? $inputdata : ''}}" />
                        <button type="submit" style="margin-right: 57px;" class="btn btn-primary" name="submit">Search</button>
                        <div class="dropdown_search_content" style="text-decoration: none; color: #000;" id="searchdataname"
                            hidden>
                        </div>
                    </form>
                </div>
    @if ($wishlist->isNotEmpty())
        <div class="row">
            <div class="col">
                
                @foreach ($wishlist as $item)
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
                                    <h5 class="card-title">₹{{round($item->product->price-($item->product->price*$item->product->discount/100))}}</h5>
                        <div style="color: green"><del>₹{{$item->product->price}}</del>     {{$item->product->discount}}%  off</div>
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
                            <h1>NOT WISHLIST FOUND</h1>
                        </div>
                    </div>
                </div>
            @endif
@endsection