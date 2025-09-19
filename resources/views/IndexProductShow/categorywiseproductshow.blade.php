@extends('index')

@section('content')
    @if ($data->isNotEmpty())
    <ul class="d-flex justify-content-around" style="list-style: none; box-shadow: 0px 3px 15px #afafaf; padding: 10px;">
        @foreach ($alldata as $item1)
        <a href="/getcategroywiseproduct/{{$item1->category_name}}" style="text-decoration: none;color:black;"><li>{{$item1->category_name}}</li></a>
        @endforeach
    </ul>
        @foreach ($data as $item1)
            <div class="row w-100">
                @foreach ($item1->productsdata as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
                        <a href="/productdetailsunkown/{{$item->id}}">
                            <div style="height: 300px; width: 100%;">
                                <img style="width: 100%; height: 100%; object-fit: cover;"
                                    src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                            </div>
                        </a>
                        <div class="card-body">
                            <p class="card-text" style="text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                                {{$item->name}}</p>
                            <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                            <h3>₹{{$item->price}}</h3>
                            </p>
                        </div>
                    </div>
                @endforeach
                <br>
            </div>
        @endforeach
    @endif
@endsection