@extends('Admin.index')

@section('css_content')
<style>
    .pagination {
        margin-bottom: 0px;
        margin-right: 120px;
    }

</style>
@endsection

@section('content')
@if ($data->isNotEmpty())
<h1>Show Product</h1>
<div class="row">
    @foreach ($data as $item)
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
        <a href="/AdminProductDetail/{{$item->id}}">
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
            <a href="/AdminInProductUpdate/{{ $item->id }}">
                <button type="button" class="btn btn-primary">
                    Edit
                </button>
            </a>
            <button type="button" class="btn btn-danger" onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#AdminProductDeleteModal">
                Delete
            </button>
        </div>
    </div>
    @endforeach
</div>
<div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">

    <div class="paginationDiv" id="usertableid" style="margin-bottom: 30px;">
        <div class="card row" style="margin-left: 0px;width: 96%;height: 58px;justify-content:center;">
            <div class="col-2">
                Page {{ $data->currentPage() }} of {{ $data->lastPage() }} in {{ $data->count() }} Records
            </div>
            <div class="col-10" style="display: flex;justify-content: center;">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@else
<h1 style="color: red;display: flex;justify-content: center;align-items: center;margin-top: 172px;">Not Found Product</h1>
@endif

<!--Product Delete Modal -->
<div class="modal fade" id="AdminProductDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Product Delete Modal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('product.manage')}}" method="post">
                @csrf
                <div class="modal-body">
                    Are You Sore This Record Delete
                    <label id="deletenameproduct" style="font-weight: bold"></label>
                    <input id="deleteproductid" name="id" name="id" hidden>
                    <input type="text" name="action" value="remove" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push("script_content")
<script>
    function deleteproductdata(id, name) {
        document.getElementById("deletenameproduct").textContent = name;
        document.getElementById("deleteproductid").value = id;
    }

</script>
@endpush
