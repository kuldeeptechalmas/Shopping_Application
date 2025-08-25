<table class="table table-striped" style="margin-top: 5%;">
    <h1>Show Shopkeeper</h1>
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>

        @if (isset($shopkeeper))
            @foreach ($shopkeeper as $item)
                <tr>
                    <th scope="col">{{$item->name}}</th>
                    <th scope="col">{{$item->address}}</th>
                    <th scope="col">{{$item->phone}}</th>
                    <th scope="col">{{$item->email}}</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary" onclick="viewdataname('{{$item->name}}',
                                    '{{$item->phone}}','{{$item->gender}}','{{$item->address}}','{{$item->city}}',
                                    '{{$item->state}}','{{$item->country}}','{{$item->pincode}}','{{$item->email}}'
                                    ,'{{$item->password}}')" data-bs-toggle="modal" data-bs-target="#viewmodel">
                            View
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