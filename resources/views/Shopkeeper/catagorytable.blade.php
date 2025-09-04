<table class="table table" style="margin-top: 30px;">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Sub Category Name</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
        @if (isset($data))
            @foreach ($data as $item)
                <tr>
                    <th scope="col">{{$item->id}}</th>
                    <th scope="col">{{$item->category_name}}</th>
                    <th scope="col">@foreach ($subcat as $subitem)
                        @if ($subitem->catagroy_id == $item->id)
                        <button type="button" class="btn btn-light">
                            {{$subitem->name}}
                        </button>
                        @endif
                        @endforeach
                    </th>
                    <th scope="col"><button type="button" onclick="viewcatagory('{{$item->category_name}}','{{$item->id}}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewcatagory">
                            View
                        </button></th>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>