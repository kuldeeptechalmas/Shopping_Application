@extends('Admin.index')

@section('css_content')
<style>
    .pagination {
        margin-bottom: 0px;
        margin-right: 120px;
    }

</style>
@endsection

@section('content')

@if (isset($order))
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
                    @elseif ($item->status == "Processing" || $item->status == "Shipping")
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
                        @if ($item->status == "Delivered")
                        <button type="button" class="btn btn-danger" onclick="deleteorderdata('{{$item->id}}')" data-bs-toggle="modal" data-bs-target="#AdminOrderDeleteModal">
                            Delete
                        </button>
                        @endif
                    </form>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">

        <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">
            <div class="card row" style="margin-left: 0px;width: 96%;height: 58px;justify-content:center;">
                <div class="col-2">
                    Page {{ $order->currentPage() }} of {{ $order->lastPage() }} in {{ $order->count() }} Records
                </div>
                <div class="col-10" style="display: flex;justify-content: center;">
                    {{ $order->links('pagination::bootstrap-4') }}
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
            Edit search or go back to Orders Page <br /><br />
            <a href="/AdminInOrder">
                <button class="btn btn-primary" style="width: 192px;">Go To Orders</button>
            </a>
        </div>
    </div>
    @endif
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
            Edit search or go back to Orders Page <br /><br />
            <a href="/AdminInOrder">
                <button class="btn btn-primary" style="width: 192px;">Go To Orders</button>
            </a>
        </div>
    </div>
    @endif

    <!--Order Delete Modal -->
    <div class="modal fade" id="AdminOrderDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('order.Manage')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        Are You Sore This Record Delete
                        <input id="deleteorderid" name="id" name="id" hidden>
                        <input type="text" name="action" value="removeorder" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

    @push("script_content")


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function deleteorderdata(id) {
            console.log(id);
            document.getElementById("deleteorderid").value = id;
        }


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
