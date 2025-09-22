<style>
    .img-thumbs {
        margin: 1.5rem 0;
        padding: 0.75rem;
    }

    .img-thumbs-hidden {
        display: none;
    }

    .wrapper-thumb {
        position: relative;
        display: inline-block;
        margin: 1rem 0;
        justify-content: space-around;
    }

    .img-preview-thumb {
        background: #fff;
        border: 1px solid none;
        border-radius: 0.25rem;
        box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
        margin-right: 1rem;
        max-width: 140px;
        padding: 0.25rem;
    }

    .remove-btn {
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: .7rem;
        top: -5px;
        right: 10px;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
    }

    .remove-btn:hover {
        box-shadow: 0px 0px 3px grey;
        transition: all .3s ease-in-out;
    }
</style>
<form id="view-product-from" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{$product_data->id}}" id="vpid" hidden>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name </label>
        <input type="text" class="form-control" value="{{$product_data->name}}" id="vpname" name="name"
            aria-describedby="emailHelp">
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
                        <option value="{{$item->id}}" {{$product_data->sub_category_id == $item->id ? 'selected' : ''}}>
                            {{$item->name}}
                        </option>
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
        <input type="text" class="form-control" id="vpstock" value="{{$product_data->stock}}"
            oninput="statuscheck_viewproduct()" name="stock">
    </div>
    <div style="color:red;" id="vepstock" hidden></div>
    {{-- {{$product_data->image}} --}}
    {{-- {{$product_data->images}} --}}
    <div class="mb-3">
        {{-- <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            <input type="file" name="file[]" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
        </div>
        <div id="showimage" style="margin-top: 21px;">
            <div class="row">
                @foreach ($product_data->images as $item)
                <div class="col-md-4">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" alt="Image">
                </div>
                @endforeach
            </div>

        </div> --}}
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data" id="form-upload">
                    <div class="form-group">
                        <label for="">Choose Images</label>
                        {{-- <input type="file" class="form-control" name="images[]" multiple id="upload-img" /> --}}
                        <input type="file" name="file[]" multiple id="upload-img" class="form-control">
                    </div>
                    <div class="img-thumbs img-thumbs-hidden" id="img-preview"></div>
                </form>
            </div>
        </div>
        <div id="showimage" style="margin-top: 21px;">
            <div class="row">
                @foreach ($product_data->images as $item)
                <div class="col-md-4">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/' . $item->image_name) }}" alt="Image">
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <div style="color:red;" id="vepimage" hidden></div>


    {{-- <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <div class="form-group">
            <input type="file" name="file[]" multiple id="file" class="input-file">
            <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName" id="vpimagename">Choose a file : </span>
            </label>
        </div>
        <div id="showimage" style="margin-top: 21px;"></div>
    </div>
    <div style="color:red;" id="vepimage" hidden></div> --}}

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Status</label>
        <select class="form-select" id="vpstatus" name="status">
            <option value="">Select</option>
            <option value="in stock" {{$product_data->status == 'in stock' ? 'selected' : ''}}>in stock</option>
            <option value="out of stock" {{$product_data->status == 'out of stock' ? 'selected' : ''}}>out of stock
            </option>
        </select>
    </div>
    <div style="color:red;" id="vepstatus" hidden></div>
</form>

<script>
    var imgUpload = document.getElementById('upload-img')
        , imgPreview = document.getElementById('img-preview')
        , imgUploadForm = document.getElementById('form-upload')
        , totalFiles
        , previewTitle
        , previewTitleText
        , img;

    imgUpload.addEventListener('change', previewImgs, true);

    function previewImgs(event) {
        totalFiles = imgUpload.files.length;

        if (!!totalFiles) {
            imgPreview.classList.remove('img-thumbs-hidden');
        }

        for (var i = 0; i < totalFiles; i++) {
            wrapper = document.createElement('div');
            wrapper.classList.add('wrapper-thumb');
            removeBtn = document.createElement("span");
            nodeRemove = document.createTextNode('x');
            removeBtn.classList.add('remove-btn');
            removeBtn.appendChild(nodeRemove);
            img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.classList.add('img-preview-thumb');
            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            imgPreview.appendChild(wrapper);

            $('.remove-btn').click(function () {
                $(this).parent('.wrapper-thumb').remove();
            });
        }
    }
</script>