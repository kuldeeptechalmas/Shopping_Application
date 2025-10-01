@extends('Admin.index')

@section('content')
@if ($data->isNotEmpty())
<div id="dataOutput" class="mt-3">
    <h1>Show Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>


            @foreach ($data as $item)
            <tr>
                <th scope="col">{{$item->name}}</th>
                <th scope="col">{{$item->address}}</th>
                <th scope="col">{{$item->phone}}</th>
                <th scope="col">{{$item->email}}</th>
                <th scope="col">{{$item->rols}}</th>
                <th scope="col">
                    <div class="row">
                        <div class="col-4">
                            <form action="{{route('admindashboard')}}" method="post">
                                @csrf
                                <input type="text" name="action" hidden value="editGet">
                                <input type="text" name="id" hidden value="{{$item->id}}">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </form>
                        </div>
                        <div class="col-8">
                            <form action="{{route('admindashboard')}}" method="post">
                                @csrf
                                <input type="text" name="action" hidden value="remove">
                                <input type="text" name="id" hidden value="{{$item->id}}">
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginationDiv" style="margin-right: 73%;" id="usertableid">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

    @else
    <h1 style="color: red;display: flex;justify-content: center;align-items: center;margin-top: 172px;">Not Found User</h1>
    @endif

    @endsection

    @push("script_content")


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // Search data-bs-target
        function searchproduct() {
            console.log($("#searchproductid").val());
            $.ajax({
                type: "get"
                , url: "/SearchData/" + $("#searchproductid").val() + "/User"
                , success: function(res) {
                    console.log(res);

                }
                , error: function(e) {
                    console.log(e);
                }
            });
        }

    </script>
    @endpush
