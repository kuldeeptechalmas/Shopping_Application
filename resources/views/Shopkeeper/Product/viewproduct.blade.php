@extends('Shopkeeper.index')

@section('content')

@toastifyCss
@if ($product_data->admin_id != 0)
{{ toastify() -> warning('Admin Update Product Details !') }}
@endif
@toastifyJs

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<h1 style="text-align: center">Product Edit</h1>
<form id="view-product-from" action="{{ route('product_add_update') }}" method="POST" enctype="multipart/form-data" style="padding: 20px 160px;">
    @csrf
    <input type="text" name="id" value="{{$product_data->id}}" id="vpid" hidden>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name </label>
        <input type="text" class="form-control" value="{{ old('name', $product_data->name ?? '') }}" id="vpname" name="name" aria-describedby="emailHelp">
    </div>
    @error('name')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea type="text" style="resize: none;" rows="5" class="form-control" id="vpdescription" name="description">{{ old('description', $product_data->description ?? '') }}</textarea>
    </div>
    @error('description')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Sub-Catagory ({{ $product_data->category->category_name }})</label>
            <select class="form-select" id="vpcatagory" name="catagory">
                <option value="">Select</option>
                @if (isset($subcatagory))
                @foreach ($subcatagory as $item)
                <option value="{{ $item->id }}" {{$product_data->sub_category_id == old('catagory', $item->id ?? '') ? 'selected' : ''}}>
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
        <input type="text" class="form-control" value="{{ old('price', $product_data->price ?? '') }}" id="vpprice" name="price">
    </div>
    @error('price')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Stock</label>
        <input type="text" class="form-control" id="vpstock" value="{{ old('stock', $product_data->stock ?? '') }}" oninput="statuscheck_viewproduct()" name="stock">
    </div>
    @error('stock')

    <div style="color:red;">{{$message}}</div>
    @enderror
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            <input type="file" name="file[]" value="{{ old('file', $product_data->file ?? '') }}" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
        </div>

        <div id="showimage" style="margin-top: 21px;">
            <div class="row">
                @foreach ($product_data->images as $item)
                <div class="col-md-3" style="margin: 17px;">
                    <img style="width: 100%; height: 100%; object-fit: cover;position: relative;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" alt="Image">
                    <a href="/RemoveImage/{{ $item->id }}" style="color: red;">
                        <i class="fa-solid fa-circle-xmark" style="position: absolute"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    @error('file.*')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Status</label>
        <select class="form-select" id="vpstatus" name="status">
            <option value="">Select</option>
            <option value="in stock" {{old('status', $product_data->status ?? '') == 'in stock' ? 'selected' : ''}}>in stock</option>
            <option value="out of stock" {{old('status', $product_data->status ?? '') == 'out of stock' ? 'selected' : ''}}>out of stock
            </option>
        </select>
    </div>
    @error('status')

    <div style="color:red;">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Dicsount</label>
        <input type="text" class="form-control" value="{{ old('discount', $product_data->discount ?? '') }}" id="discount" value="{{$product_data->discount}}" name="discount">
    </div>

    <div class="modal-footer">
        <div style="padding-right: 20px">
            <a href="/shopkeeperdashboard">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
            </a>
        </div>
        <button type="submit" class="btn btn-primary">Save Chang</button>
    </div>
</form>
@endsection
@push("shopkeeper_script")

<script>
    function statuscheck_viewproduct() {
        if (document.getElementById('pstock').value == "0") {
            document.getElementById('pstatus').value = "out of stock";
        } else {
            if (document.getElementById('pstock').value > 0) {
                document.getElementById('pstatus').value = "in stock";
            } else {
                document.getElementById('pstatus').value = "";
            }
        }

        if (document.getElementById('vpstock').value == "0") {
            document.getElementById('vpstatus').value = "out of stock";
        } else {
            if (document.getElementById('vpstock').value > 0) {
                document.getElementById('vpstatus').value = "in stock";
            } else {
                document.getElementById('vpstatus').value = "";
            }
        }
    }

    // status change 
    // done
    function statuscheck_viewproduct() {
        if (document.getElementById('vpstock').value == "0") {
            document.getElementById('vpstatus').value = "out of stock";
        } else {
            if (document.getElementById('vpstock').value > 0) {
                document.getElementById('vpstatus').value = "in stock";
            } else {
                document.getElementById('vpstatus').value = "";
            }
        }

    }

</script>
@endpush
