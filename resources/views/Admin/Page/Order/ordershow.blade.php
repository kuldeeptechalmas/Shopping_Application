@extends('Admin.index')

@section('css_content')

@endsection

@section('content')

@if ($order->isNotEmpty())
<div id="dataOutput" class="mt-3">
    <h1>Show Order</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Order Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($order as $item)
            <tr>
                <th scope="col">{{$item->product->name}}</th>
                <th scope="col">
                    <a href="/AdminProductDetail/{{$item->product->id}}">
                        <div style="height: 100px; width: 100%;">
                            <img style="width: 100%; height: 100%; object-fit: cover;" src="{{asset("storage/UploadeFile/" . $item->product->image)}}" alt="">
                        </div>
                    </a>
                </th>
                <th scope="col">
                    ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}</th>
                <th scope="col">{{$item->name}}</th>
                <th scope="col">{{$item->email}}</th>
                <th scope="col">{{$item->phone}}</th>
                <th scope="col">
                    @if ($item->status == "Pending")
                    <span class="text-warning">{{$item->status}}</span>
                    @elseif ($item->status == "Processing" || $item->status == "Shipped")
                    <span class="text-info">{{$item->status}}</span>
                    @elseif ($item->status == "Delivered")
                    <span class="text-success">{{$item->status}}</span>
                    @endif
                </th>
                <th scope="col">
                    <form action="{{ route('order.Manage') }}" method="post">
                        @csrf
                        <input type="text" name="action" value="view" hidden>
                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                        <button type="submit" class="btn btn-primary">
                            View
                        </button>
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h1 style="color: red;display: flex;justify-content: center;align-items: center;margin-top: 172px;">Not Found Order</h1>
    @endif

    <div class="paginationDiv" style="margin-right: 73%;">
        <p> {{ $order->links('pagination::bootstrap-5') }}</p>
    </div>

    @endsection

    @push("script_content")


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href');
            console.log(page);
            window.location.href = page;
        });

        function vieworderspcific(orderid) {
            console.log(orderid);

            $.ajax({
                url: "/vieworder/" + orderid
                , type: "get"
                , success: function(res) {
                    $("#vieworderdetail").html(res);
                }
                , error: function(e) {
                    console.log(e);
                }
            })
        }

    </script>

    @endpush
