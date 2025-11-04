@extends('Admin.index')

@section('content')
<div class="d-flex justify-content-center" style="height: 62px;text-align: center;margin-top: 16px;">
    <h3 style="width: 225px;border: solid;border-radius: 27px;align-items: center;display: flex;justify-content: center;">
        Edit Product</h3>
</div>
@if (isset($save))
@toastifyCss
{{ toastify() -> success('Save Successfully !') }}
@toastifyJs
@endif
<form id="view-product-from" style="padding: 10px 169px;" action="/AdminInProductUpdate/{{ $productData->id }}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="text" name="id" value="{{$productData->id}}" id="vpid" hidden>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name </label>
        <input type="text" class="form-control" value="{{ old('name', $productData->name) }}" id="vpname" name="name" aria-describedby="emailHelp">
    </div>

    @error('name')

    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Brand Name </label>
        <input type="text" class="form-control" value="{{ old('brand', $productData->brand ?? '') }}" name="brand" aria-describedby="emailHelp">
    </div>
    @error('brand')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea type="text" style="resize: none;" rows="5" class="form-control" id="vpdescription" name="description">{{old("description",$productData->description)}}</textarea>
    </div>
    @error('description')

    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Sub-Catagory of <label class="fw-bolder">{{$productData->category->category_name }}</label></label>
            <select class="form-select" id="vpcatagory" name="catagory">
                <option value="">Select</option>
                @if (isset($subCategoryData))
                @foreach ($subCategoryData as $item)
                <option value="{{$item->id}}" {{old('catagory',$productData->sub_category_id)==$item->id?'selected':''}}>{{$item->name }}</option>
                @endforeach
                @endif
            </select>
            @error('catagory')

            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Price</label>
        <input type="text" class="form-control" id="vpprice" value="{{old("price",$productData->price)}}" name="price">
    </div>
    @error('price')

    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Main Stock</label>
        <input type="text" class="form-control" value="{{old("mainstock",$productData->main_stock)}}" name="mainstock">
    </div>
    @error('mainstock')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Stock</label>
        <input type="text" class="form-control" id="vpstock" value="{{old("stock",$productData->stock)}}" oninput="statuscheck_viewproduct()" name="stock">
    </div>
    @error('stock')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            <input type="file" name="file[]" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
            <div id="preview-container">
                <div class="row" style="margin: 21px 40px 22px 40px;">


                    @foreach ($productData->images as $item)

                    <div class="col-md-3" style="margin: 17px;">
                        <img style="width: 100%; height: 100%; object-fit: cover;position: relative;" src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" alt="Image">
                        <a href="/RemoveImage/{{ $item->id }}/{{ $productData->id }}" style="color: red;">
                            <i class="fa-solid fa-circle-xmark" style="position: absolute"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div id="showimage" style="margin-top: 21px;"></div>
    </div>

    @error('file.*')

    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Status</label>
        <select class="form-select" id="vpstatus" name="status">
            <option value="">Select</option>
            <option value="in stock" {{old("status",$productData->status) == 'in stock' ? 'selected' : ''}}>in stock</option>
            <option value="out of stock" {{old("status",$productData->status) == 'out of stock' ? 'selected' : ''}}>out of stock
            </option>
        </select>
    </div>
    @error('status')

    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="modal-footer" style="padding: 10px 20px 29px;">
        <a href="{{ route("product.manage") }}">
            <button type="button" class="btn btn-secondary" style="margin-right: 32px;" data-bs-dismiss="modal">Back</button>
        </a>

        @csrf
        <input type="text" name="action" hidden value="edit">
        <button type="submit" class="btn btn-primary">save chang</button>
    </div>
</form>
@endsection
