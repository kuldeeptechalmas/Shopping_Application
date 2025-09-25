@extends('Admin.index')

@section('css_content')

@endsection

@section('content')

    <div id="dataOutput" class="mt-3" style="">
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

                @if (isset($order))
                    @foreach ($order as $item)
                        <tr>
                            <th scope="col">{{$item->product->name}}</th>
                            <th scope="col">
                                <a href="/productdetails/{{$item->product->id}}">
                                    <div style="height: 100px; width: 100%;">
                                        <img style="width: 100%; height: 100%; object-fit: cover;"
                                            src="{{asset("storage/UploadeFile/" . $item->product->image)}}" alt="">
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
                            <th scope="col"><button type="button" class="btn btn-primary"
                                    onclick="vieworderspcific('{{$item->id}}')" data-bs-toggle="modal" data-bs-target="#orderview">
                                    View
                                </button></th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="paginationDiv" style="margin-right: 73%;">
            <p>
                Paginate Index : {{ $order->links('pagination::bootstrap-4') }}
            </p>
        </div>


        <!-- View Order Modal -->
        <div class="modal fade" id="orderview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">View Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="vieworderdetail">

                    </div>
                </div>
            </div>
        </div>

@endsection

    @section('script_content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>

            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();
                var page = $(this).attr('href');
                console.log(page);
                window.location.href = page;
            });

            function vieworderspcific(orderid) {
                console.log(orderid);

                $.ajax({
                    url: "/vieworder/" + orderid,
                    type: "get",
                    success: function (res) {
                        $("#vieworderdetail").html(res);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                })
            }
        </script>
    @endsection