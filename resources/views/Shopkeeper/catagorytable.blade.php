<table class="table table" style="margin-top: 30px;">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Sub Category Name</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
        @if (isset($data))
            @foreach ($data as $item)
                <tr>
                    <th scope="col">{{$item->category_name}}</th>
                    <th scope="col">@foreach ($subcat as $subitem)
                        @if ($subitem->catagroy_id == $item->id)
                        <button type="button" class="btn btn-light position-relative pe-4">
                            {{$subitem->name}}
                            <i class="fa-solid fa-xmark position-absolute" onclick="removesubcatagory('{{$subitem->id}}','{{$subitem->name}}')" data-bs-toggle="modal" data-bs-target="#deletesubcatagory"aria-current="page" style="top: 4px; right: 4px; font-size: 10px; color: red;"></i>
                        </button>
                        @endif
                        @endforeach
                    </th>
                    <th scope="col"><button type="button" onclick="viewcatagory('{{$item->category_name}}','{{$item->id}}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewcatagory">
                            View
                        </button>
                    <button type="button" class="btn btn-danger" onclick="deletecatagory('{{$item->id}}','{{$item->category_name}}')" data-bs-toggle="modal" data-bs-target="#deletecatagory">
                            Delete
                        </button>
                    </th>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>