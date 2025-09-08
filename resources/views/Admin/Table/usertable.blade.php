<div id="dataOutput" class="mt-3" style="">
    <h1 style="margin-top: -27px;">Show Users</h1>
    <table class="table table-striped" >
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
                            <button type="button" class="btn btn-primary" onclick="viewdataname('{{$item->id}}','{{$item->name}}',
                                            '{{$item->phone}}','{{$item->gender}}','{{$item->address}}','{{$item->city}}',
                                            '{{$item->state}}','{{$item->country}}','{{$item->pincode}}','{{$item->email}}'
                                            ,'{{$item->password}}')" data-bs-toggle="modal" data-bs-target="#viewmodel">
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" onclick="deletedataname('{{$item->email}}')" data-bs-target="#deletemodel">
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