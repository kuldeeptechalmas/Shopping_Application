@extends('Shopkeeper.index')

@section('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Welcome</title>
<link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .pagination {
        margin-bottom: 0px;
        margin-right: 120px;
    }

</style>
@endsection

@section('content')

<h1>product</h1>


<a href="/AddProductPage/{{ $catagoryid }}" type="button" class="btn btn-primary" style="margin-left: 86%;">Add Product</a>

@if (isset($dataProduct))
@if ($dataProduct->isNotEmpty())
<div class="row">
    @foreach ($dataProduct as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
        <a href="/ProductDetailsShow/{{$item->id}}">
            <div style="height: 300px; width: 100%;">
                <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
            </div>
        </a>
        <div class="card-body">
            <p class="card-text">{{$item->name}}</p>
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
                    {{ round($rateConversion ,1)}}
                    <i class="fa-solid fa-star" style="font-size: 11px;margin-top: 4px;margin-left: 2px;"></i>
                </div>
                <div style="margin-left:13px">{{ $item->rates->count() }} Ratings</div>
            </div>
            <br>
            <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                {{$item->description}}
            </p>
        </div>

        <div class="d-flex justify-content-between ps-3 pe-3" style="margin-bottom: 15px;">
            <a href="/productview/{{ $item->id }}">
                <button type="button" class="btn btn-primary">
                    Edit
                </button>
            </a>

            <button type="button" class="btn btn-danger text-white" style="" onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#productdeletemodel">
                Delete
            </button>
        </div>
    </div>
    @endforeach
</div>

<div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">

    <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">
        <div class="card row" style="margin-left: 0px;width: 96%;height: 58px;justify-content:center;">
            <div class="col-2">
                Page {{ $dataProduct->currentPage() }} of {{ $dataProduct->lastPage() }} in {{ $dataProduct->count() }} Records
            </div>
            <div class="col-10" style="display: flex;justify-content: center;">
                {{ $dataProduct->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@else
<div style="display: flex;justify-content: center;margin-top: 48px;">
    <div>
        <div style="width: 100px; height: auto; display: flex;justify-content: center;">
            <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
        </div>
    </div>
</div>
<div style="display: flex;justify-content: center;text-align: center;">
    <div>

        <h5>Sorry, no results found <br /></h5>
        Edit search or go back to Product Page <br /><br />
        <form action="" method="get">
            <button class="btn btn-primary" type="submit" style="width: 192px;">Go To Product</button>
        </form>
    </div>
</div>
@endif
@else
<div style="display: flex;justify-content: center;margin-top: 48px;">
    <div>
        <div style="width: 100px; height: auto; display: flex;justify-content: center;">
            <img style="width: 100%; height: 100%; object-fit: contain;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
        </div>
    </div>
</div>
<div style="display: flex;justify-content: center;text-align: center;">
    <div>

        <h5>Sorry, no results found <br /></h5>
        Edit search or go back to Product Page <br /><br />
        <form action="" method="get">

            <button class="btn btn-primary" type="submit" style="width: 192px;">Go To Product</button>
        </form>
    </div>
</div>
@endif

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
