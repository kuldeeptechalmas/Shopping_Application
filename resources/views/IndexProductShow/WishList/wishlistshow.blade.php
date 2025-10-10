@extends('index')

@section('content')
<div class="row">
</div>
@if ($wishlist->isNotEmpty())
<div class="row" style="padding: 10px 270px;">
    <h5>My Wishlist ({{$wishlist->count()}})</h5>
    <div class="col">

        @foreach ($wishlist as $item)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <a href="/ProductDetails/{{$item->product->id}}">
                            <img style="width: 62%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->product->image) }}" alt="Image">
                        </a>
                    </div>
                    <div class="col-8">
                        <p class="card-text">{{$item->product->name}}</p>
                        <h5 class="card-title">₹{{round($item->product->price-($item->product->price*$item->product->discount/100))}}</h5>
                        <div style="color: green"><del>₹{{$item->product->price}}</del> {{$item->product->discount}}% off</div>
                        <div class="d-flex justify-content-end">
                            <div style="border-radius: 8px;text-align: center;margin-right: 11px;text-decoration: none;font-weight: bold;">
                                <p style="margin-top: 27px;">
                                    <form action="{{route('wishlist')}}" method="post">
                                        @csrf
                                        <input type="text" name="action" value="Remove" hidden id="">
                                        <input type="text" name="productId" value="{{$item->product->id}}" hidden id="">

                                        <button type="submit" style="background: white;border: none;"><i class="fa-solid fa-trash" style="margin-right: 27px;"></i></button>
                                    </form>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                Edit search or go back to WishList Page <br /><br />
                <a href="/wishlist">
                    <button class="btn btn-primary" style="width: 192px;">Go To WishList</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('index_Main_js')
<script>

</script>
@endpush
