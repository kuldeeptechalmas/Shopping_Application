<form id="view-product-from" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" id="vpid" hidden>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name </label>
        <input type="text" class="form-control" value="{{$product_data->name}}" id="vpname" name="name" aria-describedby="emailHelp">
    </div>
    <div style="color:red;" id="vepname" hidden></div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea type="text" style="resize: none;" rows="5" class="form-control" id="vpdescription"
            name="description">{{$product_data->description}}</textarea>
    </div>
    <div style="color:red;" id="vepdescription" hidden></div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Sub-Catagory</label>
            <select class="form-select" id="vpcatagory" name="catagory">
                <option value="">Select</option>
                @if (isset($subcatagory))
                    @foreach ($subcatagory as $item)
                        <option value="{{$item->id}}" {{$product_data->sub_category_id==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            <div style="color:red;" hidden id="vepcatagory"></div>
        </div>
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Price</label>
        <input type="text" class="form-control" id="vpprice" value="{{$product_data->price}}" name="price">
    </div>
    <div style="color:red;" id="vepprice" hidden></div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Stock</label>
        <input type="text" class="form-control" id="vpstock" value="{{$product_data->stock}}" oninput="statuscheck_viewproduct()" name="stock">
    </div>
    <div style="color:red;" id="vepstock" hidden></div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            {{-- <input type="file" id="file-input" multiple> --}}
            {{-- <div id="preview-container"></div> --}}
            <input type="file" name="file[]" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
        </div>
        <div id="showimage" style="margin-top: 21px;"></div>
    </div>
    <div style="color:red;" id="vepimage" hidden></div>

    <div class="mb-3">   
        <label for="exampleInputPassword1" class="form-label">Status</label>
        <select class="form-select" id="vpstatus" name="status">
            <option value="">Select</option>
            <option value="in stock" {{$product_data->status=='in stock'?'selected':''}}>in stock</option>
            <option value="out of stock" {{$product_data->status=='out of stock'?'selected':''}}>out of stock</option>
        </select>
    </div>
    <div style="color:red;" id="vepstatus" hidden></div>
</form>