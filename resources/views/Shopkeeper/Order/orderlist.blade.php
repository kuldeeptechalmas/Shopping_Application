@extends('Shopkeeper.index')

@section('content')
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

            @if (isset($order_Data))
            @foreach ($order_Data as $item)
            <tr>
                <th scope="col">{{$item->product->name}}</th>
                <th scope="col">
                    <a href="/productdetails/{{$item->product->id}}">
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
                    <form action="{{ route('shopkeeper.Order.List') }}" method="post">
                        @csrf
                        <input type="text" name="action" value="edit" hidden>
                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                        <button type="submit" class="btn btn-primary">
                            View
                        </button>
                    </form>
                </th>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <div class="paginationDiv" style="margin-right: 73%;">
        <p>
            {{ $order_Data->links('pagination::bootstrap-5') }}
        </p>
    </div>

    @endsection

    @push("shopkeeper_script")
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href');
            console.log(page);
            window.location.href = page;
        });

    </script>
    @endpush
