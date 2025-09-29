@extends('Admin.index')

@section('content')

    {{-- <div id="datatable">

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        // Product data are get all
        function showuserdataget() {
            $.ajax({
                type: "GET",
                url: "/getuserofall",
                success: function (res) {

                    $("#datatable").html(res);

                },
                error: function (e) {
                    console.log(e);
                },
            })
        }
        showuserdataget();
    </script> --}}
    <div id="dataOutput" class="mt-3" style="">
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

                @if (isset($data))
                    @foreach ($data as $item)
                        <tr>
                            <th scope="col">{{$item->name}}</th>
                            <th scope="col">{{$item->address}}</th>
                            <th scope="col">{{$item->phone}}</th>
                            <th scope="col">{{$item->email}}</th>
                            <th scope="col">{{$item->rols}}</th>
                            <th scope="col">
                                <button type="button" class="btn btn-primary" onclick="customerAndshopkeeperview('{{$item->id}}')"
                                    data-bs-toggle="modal" data-bs-target="#viewmodel">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    onclick="deletedataname('{{$item->email}}')" data-bs-target="#deletemodel">
                                    Delete
                                </button>

                            </th>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="paginationDiv" style="margin-right: 73%;" id="usertableid">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
@endsection