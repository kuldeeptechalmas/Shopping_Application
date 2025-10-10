@if (isset($data))
<div class="row">
    @foreach ($data as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
        <a href="/ProductDetailsShow/{{$item->id}}">
            <div style="height: 300px; width: 100%;">
                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/' . $item->image) }}" alt="Image">
            </div>
        </a>
        <div class="card-body">
            <p class="card-text">{{$item->name}}</p>
            <p class="card-text" style="width: 100%;text-wrap-mode: nowrap;overflow: hidden;text-overflow: ellipsis;">
                {{$item->description}}
            </p>
        </div>

        <div class="d-flex justify-content-between ps-3 pe-3" style="margin-bottom: 15px;">
            <a href="/productview/{{ $item->id }}">
                <button type="button" class="btn btn-primary">
                    Edit
                </button>
            </a>

            <button type="button" class="btn btn-danger text-white" style="" onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#productdeletemodel">
                Delete
            </button>
        </div>
    </div>
    @endforeach
</div>
<div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">
    <div style="display: flex;justify-content: center;margin-bottom: 16px;">
        Page {{ $data->currentPage() }} of {{ $data->lastPage() }} in {{ $data->count() }} Records
    </div>
    <div style="display: flex;justify-content: center;">
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
</div>
@endif
