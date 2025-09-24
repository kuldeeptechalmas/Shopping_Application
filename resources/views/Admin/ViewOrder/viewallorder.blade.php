@extends('Admin.index')

@section('content')

    <div id="dataOutput" class="mt-3" style="">
        <h1>Show Order</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Order Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>

                @if (isset($data))
                    @foreach ($data as $item)
                        <tr>
                            <th scope="col">{{$item->product->name}}</th>
                            <th scope="col">
                                ₹{{round($item->product->price - ($item->product->price * $item->product->discount / 100))}}</th>
                            <th scope="col">{{$item->name}}</th>
                            <th scope="col">{{$item->email}}</th>
                            <th scope="col">{{$item->phone}}</th>
                            <th scope="col">{{$item->status}}</th>
                            <th scope="col"><button type="button" class="btn btn-primary" 
                                onclick="vieworderspcific('{{$item->id}}')" data-bs-toggle="modal"
                                    data-bs-target="#orderview">
                                    View
                                </button></th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{-- <div class="paginationDiv" style="margin-right: 73%;" id="usertableid">
            {{ $data->links('pagination::bootstrap-5') }}
        </div> --}}

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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script_content')
    <script>
        function vieworderspcific(orderid){
            console.log(orderid);

            $.ajax({
                url:"/vieworder/"+orderid,
                type:"get",
                success:function(res){
                    $("#vieworderdetail").html(res);
                    console.log(res);
                },
                error:function(e){
                    console.log(e);
                    
                }
            })
            
        }
    </script>
@endsection