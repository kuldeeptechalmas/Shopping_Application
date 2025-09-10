{{-- <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">price</th>
            <th scope="col">stock</th>
            <th scope="col">catagory</th>
            <th scope="col">status</th>
            <th scope="col">image</th>
            <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody>

        @if (isset($data))
        @foreach ($data as $item)
        <tr>
            <th scope="col">{{$item->name}}</th>
            <th scope="col">{{$item->description}}</th>
            <th scope="col">{{$item->price}}</th>
            <th scope="col">{{$item->stock}}</th>
            <th scope="col">{{$item->category->category_name}}</th>
            <th scope="col">{{$item->status}}</th>
            <th scope="col">
                <div style="width: 100px; height: 100px; overflow: hidden;">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                </div>
            </th>

            <th scope="col">
                <button type="button" class="btn btn-primary"
                    onclick="viewproductdata('{{$item->id}}','{{$item->name}}','{{$item->description}}','{{$item->price}}',
                                            '{{$item->stock}}','{{$item->status}}','{{$item->image}}','{{$item->sub_category_id }}')" data-bs-toggle="modal"
                    data-bs-target="#viewproductmodel">
                    View
                </button>
                <button type="button" class="btn btn-danger"
                    onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal"
                    data-bs-target="#productdeletemodel">
                    Delete
                </button>

            </th>
        </tr>
        @endforeach
        @endif
    </tbody>
</table> --}}

@if (isset($data))
    {{-- <div class="row">
        @foreach ($data as $item)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
                <a href="/productdetails/{{$item->id}}">
                <div style="height: 300px; width: 100%;">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
                </div>
                </a>
                <div class="card-body">
                    <p class="card-text">{{$item->name}}</p>
                    <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                        {{$item->description}}
                    </p>
                </div>

                <div class="d-flex justify-content-between ps-3 pe-3" style="margin-bottom: 15px;">
                    <button type="button" onclick="viewproduct_productshow('{{$item->id}}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewproductmodel">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger text-white" style=""
                        onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal"
                        data-bs-target="#productdeletemodel">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div> --}}
    <style>
        .w-5.h-5{
            width: 20px;
        }

        .flex.justify-between.flex-1{
            display: none;
        }
    </style>
    <div class="paginationDiv" style="margin-right: 73%;">
        {{ $data->links()}}
    </div>
@else
    <div>Not Found Product Data</div>
@endif