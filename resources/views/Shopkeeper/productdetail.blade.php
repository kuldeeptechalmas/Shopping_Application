@extends('Shopkeeper.index')

@section('content')
<style>
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        height: 30px !important;
        width: 30px !important;
        padding: 20px !important;
    }

</style>
<div class="row">
    <div class="col">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php $count = 0; ?>
                @foreach ($productdatails->images as $item)
                @if ($count == 0)
                <div style="height: 500px" class="carousel-item active">
                    <img class="h-100 w-100" style="object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @else
                <div style="height: 500px" class="carousel-item">
                    <img class="h-100 w-100" style="object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" class="d-block w-100" alt="...">
                </div>
                <?php        $count++; ?>
                @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;" class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span style="height: 50px; width: 50px; background-color: #000; border-radius: 50px; font-size: 30px;" class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="col">
        <p>
            <h5>{{$productdatails->name}}</h5>
        </p>
        <br>
        <h2>₹{{$productdatails->price}}</h2>
        <br>
        @if ($productdatails->stock>0)
        <div class="text-success">In Stock</div>

        @else
        <div class="text-danger">Out of Stock</div>
        @endif

        <div>Stock : {{$productdatails->stock}}</div>

        <div>Discount : {{$productdatails->discount}} % </div>

        <div>
            @php
            $rateConversion = 0;
            $totalRate = 0;

            // Rate Calculation
            if ($productdatails->rates->isNotEmpty()) {
            foreach ($productdatails->rates as $value) {
            $totalRate += $value->rate;
            }
            $rates = ($totalRate * 100) / ($productdatails->rates->count() * 5);
            $rateConversion = (float)(5 * $rates) / 100;
            }

            @endphp
            <div style="display: flex;">
                <div style="background: #388e3c;width: 49px;height: 22px;color:white;border-radius: 4px;display: flex;justify-content: center;align-items: center;">
                    {{ round($rateConversion ,1)}}
                    <i class="fa-solid fa-star" style="font-size: 11px;margin-top: 4px;margin-left: 2px;"></i>
                </div>
                <div style="margin-left:13px">{{ $productdatails->rates->count() }} Ratings</div>
            </div>
        </div>
        @php
        $dataString = $productdatails->description;
        $items = explode('-', $dataString);
        @endphp

        <div style="margin-top: 3%;">
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
        </div>
    </div>
</div>
@endsection
