<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>
<style>
    .modal-backdrop.show {
        opacity: 0.1 !important;
    }

    .btn-tertiary {
        color: #555;
        padding: 0;
        line-height: 40px;
        width: 300px;
        margin: auto;
        display: block;
        border: 2px solid #555;

        &:hover,
        &:focus {
            color: lighten(#555, 20%);
            border-color: lighten(#555, 20%);
        }
    }

    /* input file style */

    .input-file {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;

        +.js-labelFile {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 10px;
            cursor: pointer;

            .icon:before {
                //font-awesome
                content: "\f093";
            }

            &.has-file {
                .icon:before {
                    //font-awesome
                    content: "\f00c";
                    color: #5AAC7B;
                }
            }
        }
    }

    .preview {
        display: inline-block;
        margin: 10px;
    }

    .preview img {
        width: 100px;
        height: 100px;
        margin-right: 10px;
    }

    /* profile */
    .hover-trigger {
        position: relative;
    }

    .show-on-hover {
        display: none;
        position: absolute;
        top: 100%;
    }

    .hover-trigger:hover .show-on-hover {
        display: block;
        z-index: 9;
    }

    .btn:focus,
    .btn:active:focus,
    .btn.active:focus {
        box-shadow: none !important;
        /* color: var(--bs-btn-color);
        background-color: var(--bs-btn-bg);
        border-color: var(--bs-btn-bg);
        color: var(--cui-btn-active-color);
        background-color: var(--cui-btn-active-bg);
        border-color: var(--cui-btn-active-border-color); */
    }

    .btn:first-child:active {
        color: var(--cui-btn-active-color);
        background-color: var(--cui-btn-active-bg);
        border-color: var(--cui-btn-active-border-color);
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div style="margin-right: 60px;">
                    <form class="d-flex">
                        <input class="form-control me-2" oninput="searchproduct()" id="searchproductid" type="search"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" onclick="searchproduct()" type="button">Search</button>
                    </form>
                </div>
                <form class="d-flex">
                    <div class="hover-trigger position-relative">
                        <h3><i class="fa-solid fa-circle-user" style="margin-left: 21%;"></i></h3>
                        {{session('shopkeeperid')}}
                        <div class="show-on-hover position-absolute"
                            style="right: 0px; width: 170px; background: white;border-radius: 15px;">

                            <div style="padding: 10px; border-bottom: 1px solid #555;">
                                <a style="text-decoration: none;  color: #000;"
                                    href="/shopkeeperprofile/{{session('shopkeeperemail')}}">
                                    Profile
                                </a>
                            </div>
                            <div style="padding: 10px; border-bottom: 1px solid #555;">
                                <a style="text-decoration: none;  color: #000;"
                                    href="/shopkeeperchangepassword/{{session('shopkeeperemail')}}">
                                    Change Password
                                </a>
                            </div>

                            <a style="text-decoration: none;  color: #000;" href="/logout">
                                <div style="padding: 10px;color:red;">
                                    Logout
                                </div>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="c-app">
        <div class="sidebar sidebar-white sidebar-fixed" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <a href="/shopkeeperdashboard">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                        </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">

                    <a class="nav-link" id="showProductdiv">
                        <i class="nav-icon cil-speedometer"></i> Products
                        <i class="fa-solid fa-chevron-down" id="showProduct" style="margin-left: 41%;"></i>
                        <i class="fa-solid fa-chevron-up" id="hideProduct" style="margin-left: 41%;" hidden></i>
                    </a>
                    <div id="product1" hidden>
                        @if (isset($catagory))
                            @foreach ($catagory as $item)
                                <a href="/productaddshop/{{$item->category_name}}" class="nav-link" style="margin-left: 40px;">
                                    <i class="nav-icon cil-speedometer"></i>
                                    {{$item->category_name}}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catagorypage">
                        <i class="nav-icon cil-speedometer"></i> Catagory Add
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100 bg-light">

            <div class="body flex-grow-1 px-3" style="margin-left: 21%;">

                <div class="container-lg" id="usertable">

                </div>
                <div class="container-lg" id="producttablediv" style="margin-top: 30px;">

                    @yield('content')
                    @if (isset($showallrecord))
                        <div id="producttable">

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Update User Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-left: 57%;margin-top: 14%;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">User detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <form action="/logout" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="update()">Save Change</button>


                </div>
            </div>
        </div>
    </div> --}}

    <!--Add Product Modal -->
    <div class="modal fade" id="addproductmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;">
                    <form id="product-from" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="id" hidden>
                        @if (isset($catagoryid))
                            <input type="text" name="catagoryid" value="{{$catagoryid}}" hidden>
                        @endif
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name </label>
                            <input type="text" class="form-control" id="pname" name="name" aria-describedby="emailHelp">
                        </div>
                        <div style="color:red;" id="epname" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" class="form-control" id="pdescription" name="description">
                        </div>
                        <div style="color:red;" id="epdescription" hidden></div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Sub-Catagory</label>
                                <select class="form-select" id="pcatagory" name="catagory">
                                    <option value="">Select</option>
                                    @if (isset($subcatagory))
                                        @foreach ($subcatagory as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div style="color:red;" hidden id="epcatagory"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Price</label>
                            <input type="text" class="form-control" id="pprice" name="price">
                        </div>
                        <div style="color:red;" id="epprice" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Stock</label>
                            <input type="text" class="form-control" oninput="statuscheck_viewproduct()" id="pstock"
                                name="stock">
                        </div>
                        <div style="color:red;" id="epstock" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" multiple id="pimage" name="image[]">
                        </div>
                        <div style="color:red;" id="epimage" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <select class="form-select" id="pstatus" name="status">
                                <option value="">Select</option>
                                <option value="in stock">in stock</option>
                                <option value="out of stock">out of stock</option>
                            </select>
                            {{-- <input type="text" class="form-control" id="status" name="status"> --}}
                        </div>
                        <div style="color:red;" id="epstatus" hidden></div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addproduct()">save</button>
                </div>
            </div>
        </div>
    </div>

    <!--View Product Modal -->
    <div class="modal fade" id="viewproductmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;" id="viewmodelform">
                    {{-- body other page "viewproduct.blade.php" --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="viewsave" class="btn btn-primary">save change</button>
                </div>
            </div>
        </div>
    </div>

    <!--Product Delete Modal -->
    <div class="modal fade" id="productdeletemodel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Product Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sore This Record Delete
                    <label id="deletenameproduct" style="font-weight: bold"></label>
                    <label id="deleteid" hidden></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteReacordProduct()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>

        // pagination to prodcut
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href');
            const tables = page.split("?")[0];
            const tablename = tables.split('/')[3];
            console.log(tablename);
            const search = document.getElementById("searchproductid").value;
            console.log(search);

            $.ajax({
                url: page,
                type: 'GET',
                data: {
                    searchText: search,
                    catagoryid: "{{isset($catagoryid) ? $catagoryid : ''}}"
                },
                success: function (res) {
                    
                    
                    $("#producttable").html(res);
                },
                error: function (e) {
                    console.log(e);
                },
            });
        });

        // searching
        function searchproduct() {
            const data = document.getElementById("searchproductid").value;
            $.ajax({
                type: "get",
                url: '/searchproduct',
                data: {
                    searchText: data,
                    catagoryid: "{{isset($catagoryid) ? $catagoryid : ''}}",

                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    console.log(res);
                    
                    $("#producttable").html(res);
                },
                error: function (e) {

                },
            });
        }

        $("#showProductdiv").on("click", function () {
            $("#product1").removeAttr("hidden");
            $("#hideProduct").removeAttr("hidden");
            $("#showProduct").attr("hidden", true);

        })
        $("#hideProduct").on("click", function () {
            console.log("hide");

            // $("#product1").attr("hidden", true);
            $("#showProduct").removeAttr("hidden");
            $("#hideProduct").attr("hidden", true);
        })

        // delete product
        function deleteproductdata(id, name) {
            document.getElementById("deletenameproduct").textContent = name;
            document.getElementById("deleteid").textContent = id;
        }

        function deleteReacordProduct() {
            const did = document.getElementById("deleteid").textContent;
            console.log(did);

            $.ajax({
                type: "delete",
                url: '/deleteproduct',
                data: {
                    id: did,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $('#productdeletemodel').modal("hide");
                    showproduct();
                },
                error: function (e) {
                },
            });
        }


        // view product 
        // done
        function viewproduct_productshow(productid) {
            $.ajax({
                type: "get",
                url: "/productview/" + productid,
                success: function (res) {
                    $("#viewmodelform").html(res);
                },
                error: function (e) {
                    console.log(e);
                }
            })

        }

        $('#viewproductmodel').on('hidden.bs.modal', function (e) {
            $("#vepname").attr("hidden", true);
            $("#vepdescription").attr("hidden", true);
            $("#vepprice").attr("hidden", true);
            $("#vepstock").attr("hidden", true);
            $("#vepimage").attr("hidden", true);
            $("#vepstatus").attr("hidden", true)
            $("#vepcatagory").attr("hidden", true)
        });

        $('#viewsave').on("click", function (e) {
            e.preventDefault();
            $("#vepname").attr("hidden", true);
            $("#vepdescription").attr("hidden", true);
            $("#vepprice").attr("hidden", true);
            $("#vepstock").attr("hidden", true);
            $("#vepimage").attr("hidden", true);
            $("#vepstatus").attr("hidden", true)
            var formData = new FormData(document.getElementById("view-product-from"));
            console.log(formData);

            $.ajax({
                type: "post",
                url: '/editproduct',
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $('#viewproductmodel').modal("hide");
                    showproduct();
                },
                error: function (e) {

                    const data = e['responseJSON']["errors"];
                    console.log(data);

                    if (data['name']) {
                        $("#vepname").text(data['name'][0]).removeAttr("hidden");
                    }
                    if (data['description']) {
                        $("#vepdescription").text(data['description'][0]).removeAttr("hidden");
                    }
                    if (data['image']) {
                        $("#vepimage").text(data['image'][0]).removeAttr("hidden");
                    }
                    if (data['price']) {
                        $("#vepprice").text(data['price'][0]).removeAttr("hidden");
                    }
                    if (data['status']) {
                        $("#vepstatus").text(data['status'][0]).removeAttr("hidden");
                    }
                    if (data['stock']) {
                        $("#vepstock").text(data['stock'][0]).removeAttr("hidden");
                    }
                    if (data['catagory']) {
                        $("#vepcountry").text(data['catagory'][0]).removeAttr("hidden");
                    }
                },
            });
        });

        // upload function

        $(document).ready(function () {
            $("#file-input").on("change", function () {
                var files = $(this)[0].files;
                $("#preview-container").empty();
                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>Delete</button></div>").appendTo("#preview-container");
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
            $("#preview-container").on("click", ".delete", function () {
                $(this).parent(".preview").remove();
                $("#file-input").val("");
            });
        });

        (function () {

            'use strict';

            $('.input-file').each(function () {
                var $input = $(this),
                    $label = $input.next('.js-labelFile'),
                    labelVal = $label.html();

                $input.on('change', function (element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\').pop();
                    console.log(fileName);

                    fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html("labelVal");
                });
            });

        })();

        $(document).ready(function () {
            showproduct();
        });

        function statuscheck_viewproduct() {
            if (document.getElementById('pstock').value == "0") {
                document.getElementById('pstatus').value = "out of stock";
            }
            else {
                if (document.getElementById('pstock').value > 0) {
                    document.getElementById('pstatus').value = "in stock";
                }
                else {
                    document.getElementById('pstatus').value = "";
                }
            }

            if (document.getElementById('vpstock').value == "0") {
                document.getElementById('vpstatus').value = "out of stock";
            }
            else {
                if (document.getElementById('vpstock').value > 0) {
                    document.getElementById('vpstatus').value = "in stock";
                }
                else {
                    document.getElementById('vpstatus').value = "";
                }
            }
        }

        function showproduct() {

            $.ajax({
                type: "GET",
                url: "/getproductshopkeeper",
                data: {
                    catagoryid: "{{isset($catagoryid) ? $catagoryid : ''}}"
                },
                success: function (res) {
                    $("#producttable").html(res);
                },
                error: function (e) {
                    console.log(e);
                },
            })
        }

        $('#addproductmodel').on('hidden.bs.modal', function (e) {

            document.getElementById('pname').value = "",
                document.getElementById('pdescription').value = "",
                document.getElementById('pprice').value = "",
                document.getElementById('pstock').value = "",
                document.getElementById('pimage').value = "",
                document.getElementById('pstatus').value = "",
                document.getElementById('pcatagory').value = "",

                $("#epname").attr("hidden", true);
            $("#epdescription").attr("hidden", true);
            $("#epprice").attr("hidden", true);
            $("#epstock").attr("hidden", true);
            $("#epimage").attr("hidden", true);
            $("#epstatus").attr("hidden", true)
            $("#epcatagory").attr("hidden", true)
        });

        $("#pstatus").on("change", function () {
            if (document.getElementById('pstatus').value == "out of stock") {
                document.getElementById('pstock').value = 0;
            }
        })

        function addproduct() {

            $("#epname").attr("hidden", true);
            $("#epdescription").attr("hidden", true);
            $("#epprice").attr("hidden", true);
            $("#epstock").attr("hidden", true);
            $("#epimage").attr("hidden", true);
            $("#epstatus").attr("hidden", true)
            $("#epstatus").attr("hidden", true)
            $("#epcatagory").attr("hidden", true)

            const form = document.getElementById("product-from");
            const formData = new FormData(form);

            $.ajax({
                url: '/productadd',
                type: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    console.log(response);

                    $('#addproductmodel').modal("hide");
                    showproduct();
                },
                error: function (e) {
                    console.log(e['responseJSON']["errors"]);

                    const data = e['responseJSON']["errors"];
                    console.log(e);

                    if (data['name']) {
                        $("#epname").text(data['name'][0]).removeAttr("hidden");
                    }
                    if (data['description']) {
                        $("#epdescription").text(data['description'][0]).removeAttr("hidden");
                    }
                    if (data['image']) {
                        $("#epimage").text(data['image'][0]).removeAttr("hidden");
                    }
                    if (data['price']) {
                        $("#epprice").text(data['price'][0]).removeAttr("hidden");
                    }
                    if (data['status']) {
                        $("#epstatus").text(data['status'][0]).removeAttr("hidden");
                    }
                    if (data['stock']) {
                        $("#epstock").text(data['stock'][0]).removeAttr("hidden");
                    }
                    if (data['catagory']) {
                        $("#epcatagory").text(data['catagory'][0]).removeAttr("hidden");
                    }
                }
            });
        }

        // user update profile
        function update() {
            $("#ename").attr("hidden", true);
            $("#estate").attr("hidden", true);
            $("#epincode").attr("hidden", true);
            $("#ephone").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#eemail").attr("hidden", true);
            $("#ecountry").attr("hidden", true);
            $("#econpassword").attr("hidden", true);
            $("#ecity").attr("hidden", true);
            $("#egender").attr("hidden", true);
            $("#eaddress").attr("hidden", true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: "/shopkeeperupdate",
                data: {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    gender: $('input[name="gender"]:checked').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    country: $('#country').val(),
                    pincode: $('#pincode').val(),
                    password: $('#password').val(),
                    conformpassword: $('#conpassword').val()
                },
                success: function (res) {
                    window.location.href = res.redirect_url;
                },
                error: function (e) {
                    const data = e['responseJSON']['errors'];
                    console.log(data['name']);
                    console.log(data);

                    if (data['name']) {
                        $("#ename").text(data['name'][0]).removeAttr("hidden");
                    }
                    if (data['gender']) {
                        $("#egender").text(data['gender'][0]).removeAttr("hidden");
                    }
                    if (data['address']) {
                        $("#eaddress").text(data['address'][0]).removeAttr("hidden");
                    }
                    if (data['city']) {
                        $("#ecity").text(data['city'][0]).removeAttr("hidden");
                    }
                    if (data['conformpassword']) {
                        $("#econpassword").text(data['conformpassword'][0]).removeAttr("hidden");
                    }
                    if (data['country']) {
                        $("#ecountry").text(data['country'][0]).removeAttr("hidden");
                    }
                    if (data['email']) {
                        $("#eemail").text(data['email'][0]).removeAttr("hidden");
                    }
                    if (data['password']) {
                        $("#epassword").text(data['password'][0]).removeAttr("hidden");
                    }
                    if (data['phone']) {
                        $("#ephone").text(data['phone'][0]).removeAttr("hidden");
                    }
                    if (data['pincode']) {
                        $("#epincode").text(data['pincode'][0]).removeAttr("hidden");
                    }
                    if (data['state']) {
                        $("#estate").text(data['state'][0]).removeAttr("hidden");
                    }
                }
            });
        }

        // password 
        function passwordshow() {
            $("#passwordhidden").removeAttr("hidden");
            $("#passwordshow").attr("hidden", true);
            document.getElementById('password').type = 'text';
        }

        function passwordhidden() {
            $("#passwordshow").removeAttr("hidden");
            $("#passwordhidden").attr('hidden', true);
            document.getElementById('password').type = 'password';
        }

        // config password
        function conformpasswordshow() {
            $("#conformpasswordhidden").removeAttr("hidden");
            $("#conformpasswordshow").attr("hidden", true);
            document.getElementById('conpassword').type = 'text';
        }

        function conformpasswordhidden() {
            $("#conformpasswordshow").removeAttr("hidden");
            $("#conformpasswordhidden").attr('hidden', true);
            document.getElementById('conpassword').type = 'password';
        }

        $("#country").on("change", function () {
            const selectElement = $('#state');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getstate",
                data: {
                    data: $('#country').val(),
                },
                success: function (res) {
                    var oldstate = "{{old('state')}}";
                    console.log(oldstate);
                    $("#state").append(`<option value="">Select</option>`);
                    $.each(res["statelist"], function (indexInArray, valueOfElement) {
                        var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                        console.log(selectstate);

                        $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);
                },
            })
        });

        $("#state").on("change", function () {
            const selectElement = $('#city');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getcity",
                data: {
                    data: $('#state').val(),
                },
                success: function (res) {
                    console.log(res);
                    $("#city").append(`<option value="">Select</option>`);
                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                        $("#city").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);
                },
            })
        });
    </script>
</body>

</html>