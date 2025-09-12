@if ($data->isNotEmpty())
    @foreach ($data as $item1)
    <h1>{{$item1->category_name}}</h1>
        <div class="row w-100">
            @foreach ($item1->productsdata as $item)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
                    <a href="/productdetailsunkown/{{$item->id}}">
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
                        <button type="button" onclick="viewproduct_productshow('{{$item->id}}')" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#viewproductmodel">
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
            <br>
        </div>
    @endforeach
@endif