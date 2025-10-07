@extends('Shopkeeper.index')

@section('content')
<h1 style="text-align: center">Product Add</h1>
<form id="view-product-from" action="{{ route('product_add_update') }}" method="POST" enctype="multipart/form-data" style="padding: 20px 160px;">
    @csrf

    @if (isset($catagoryiddata))
    <input type="text" name="catagoryid" value="{{$catagoryiddata->id}}" hidden>
    @endif
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name </label>
        <input type="text" class="form-control" value="{{ old('name') }}" id="vpname" name="name" aria-describedby="emailHelp">
    </div>
    @error('name')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea type="text" style="resize: none;" rows="5" class="form-control" id="vpdescription" name="description">{{ old('description') }}</textarea>
    </div>
    @error('description')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Sub-Catagory of <label class="fw-bold">{{ $catagoryiddata->category_name }}</label></label>
            <select class="form-select" id="vpcatagory" name="catagory">
                <option value="">Select</option>
                @if (isset($subcatagory))
                @foreach ($subcatagory as $item)
                <option {{ old('catagory') ? 'selected' : ''}} value="{{ $item->id }}">
                    {{$item->name}}
                </option>
                @endforeach
                @endif
            </select>
            @error('catagory')

            <div style="color:red;">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Price</label>
        <input type="text" class="form-control" value="{{ old('price') }}" id="vpprice" name="price">
    </div>
    @error('price')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Stock</label>
        <input type="text" class="form-control" id="vpstock" value="{{ old('stock') }}" oninput="statuscheck_viewproduct()" name="stock">
    </div>
    @error('stock')

    <div style="color:red;">{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            <input type="file" name="file[]" value="{{ old('file') }}" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
        </div>
    </div>
    @error('file.0')

    <div style="color:red;">{{$message}}</div>
    @enderror
    @error('file')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Status</label>
        <select class="form-select" id="vpstatus" name="status">
            <option value="">Select</option>
            <option value="in stock" {{old('status') == 'in stock' ? 'selected' : ''}}>in stock</option>
            <option value="out of stock" {{old('status') == 'out of stock' ? 'selected' : ''}}>out of stock
            </option>
        </select>
    </div>
    @error('status')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Dicsount</label>
        <input type="text" class="form-control" value="{{ old('discount') }}" id="discount" name="discount">
    </div>
    @error('discount')

    <div style="color:red;">{{$message}}</div>
    @enderror
    <div class="modal-footer">
        <div style="padding-right: 20px">
            <a href="/productaddshop/{{ $catagoryiddata->category_name }}">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </a>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
@endsection

@push("shopkeeper_script")

<script>
    // status change
    // done
    function statuscheck_viewproduct() {
        if (document.getElementById('vpstock').value == "0") {
            document.getElementById('vpstatus').value = "out of stock";
        } else {
            if (document.getElementById('vpstock').value > 0) {
                document.getElementById('vpstatus').value = "in stock";
            } else {
                if (document.getElementById('vpstock').value < 0) {
                    document.getElementById('vpstatus').value = "out of stock";
                } else {
                    document.getElementById('vpstatus').value = "";
                }
            }
        }

    }
    $("#pstatus").on("change", function() {
        if (document.getElementById('pstatus').value == "out of stock") {
            document.getElementById('pstock').value = 0;
        }
    });

</script>
@endpush
