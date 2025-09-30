@extends('Admin.index')

@section('content')
@if (isset($data))
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
            <form action="{{ route('product.manage') }}" method="post">
                @csrf
                <input type="text" name="action" value="editProductData" hidden>
                <input type="text" name="id" value="{{ $item->id }}" hidden>
                <button type="submit" class="btn btn-primary">
                    Edit
                </button>
            </form>
            <form action="{{ route('product.manage') }}" method="post">
                @csrf
                <input type="text" name="action" value="remove" hidden>
                <input type="text" name="id" value="{{ $item->id }}" hidden>
                <button type="submit" class="btn btn-danger text-white" style="" onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
<div class="paginationDiv" style="margin-right: 73%;">
    {{ $data->links('pagination::bootstrap-5') }}
</div>
@endif
@endsection

@push("script_content")
<script>
    function deleteproductdata(id, name) {
        document.getElementById("deleteid").value = id;
    }

</script>
@endpush
