@extends('Admin.index')

@section('content')
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

                @if (isset($data))
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
                @endif
            </tbody>
        </table>
        <div class="paginationDiv" style="margin-right: 73%;" id="usertableid">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
@endsection