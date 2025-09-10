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
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
    <title>Admin</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
    <title>Welcome</title>
    <style>
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex">

                    <div>
                        <h1><i class="fa-solid fa-circle-user" onclick="getadminprofile()" data-bs-toggle="modal"
                                data-bs-target="#adminmodel"></i>
                        </h1>
                        {{session('adminname')}}
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <div class="c-app">
        <div class="sidebar sidebar-white sidebar-fixed" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">
                    <a href="/admindashboard">
                        <img style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="showuserdataget()">
                        <i class="nav-icon cil-speedometer"></i> Users
                    </a>
                    <a href="/getproductall" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Products
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100 bg-light">

            <div class="body flex-grow-1 px-3" style="margin-left: 21%;">

@yield('content')
                {{-- <div class="container-lg" id="outputoftable">

                </div> --}}
                {{--
                <div class="container-lg" id="producttablediv">
                    <h1>Show Product</h1>
                    <button type="button" class="btn btn-primary" style="margin-left: 87%;margin-top: -5%;"
                        data-bs-toggle="modal" data-bs-target="#addproductmodel" aria-current="page">
                        Add Product
                    </button>
                    <form class="d-flex" style="margin-bottom: 23px;width: 52%;">
                        <input class="form-control me-2" oninput="searchproduct()" id="searchproductid" type="search"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" onclick="searchproduct()" type="button">Search</button>
                    </form>
                    <div class="container-lg" id="producttable">

                    </div>
                </div> --}}

            </div>
        </div>
    </div>

    </div>


    <!-- Admin Modal -->
    <div class="modal fade" id="adminmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-left: 57%;margin-top: 14%;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">User detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="mx-1 mx-md-4" method="post" action="/registration">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Your Name</label>
                                <input type="text" id="name" value="{{old('name')}}" name='name' class="form-control" />

                                <div style="color:red;" hidden id="ename"></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input type="text" id="email" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                <div style="color:red;" hidden id="eemail"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4c">Password</label>
                                <input type="password" id="password" name="password" class="form-control" />
                                <i class="fa-solid fa-eye" id="passwordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
                            </div>
                        </div>

                        <div style="color:red;" hidden id="epassword"></div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4cd">Repeat your
                                    password</label>
                                <input type="password" id="conpassword" name="conformpassword" class="form-control" />
                                <i class="fa-solid fa-eye" id="conformpasswordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordhidden()"></i>
                            </div>
                        </div>
                        <div style="color:red;" hidden id="econfpassword"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <form action="/adminlogout" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="update()">Save Change</button>


                </div>
            </div>
        </div>
    </div>

    <!--User View Modal -->
    <div class="modal fade" id="viewmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> View Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="mx-1 mx-md-4" method="post" action="/registration">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Your Name</label>
                                <input type="text" id="vname" value="{{old('vname')}}" name='vname'
                                    class="form-control" />

                                <div style="color:red;" id="enames" hidden></div>

                            </div>
                        </div>
                        <input type="text" name="id" id="vid" hidden>
                        <input type="text" name="rols" id="roles" hidden>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Phone No</label>
                                <input type="text" id="vphone" value="{{old('vphone')}}" name="vphone"
                                    class="form-control" />

                                <div style="color:red;" id="ephone" hidden></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Gender</label>
                                <input type="radio" id="gender1" value="male" name="gender" {{old('gender') == 'male'
    ? 'checked' : '' }}>Male</input>
                                <input type="radio" id="gender2" value="female" name="gender" {{old('gender') == 'female'
    ? 'checked' : '' }}>Female</input>

                                <div style="color:red;" id="egender" hidden></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Address</label>
                                <input type="text" id="vaddress" value="{{old('address')}}" name="address"
                                    class="form-control" />
                                <div style="color:red;" id="eaddress" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Country</label>
                                <select class="form-select" id="vcountry" value="{{old('country')}}" name="country">

                                </select>
                                <div style="color:red;" hidden id="ecountry"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="state">State</label>
                                <select class="form-select" id="vstate" value="{{old('state')}}" name="state">
                                </select>
                                <div style="color:red;" hidden id="estate"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">City</label>
                                <select placeholder="Select" class="form-select" id="vcity" value="{{old('city')}}"
                                    name="city">
                                </select>
                                <div style="color:red;" hidden id="ecity"></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Pincode</label>
                                <input type="text" id="vpincode" value="{{old('pincode')}}" name="pincode"
                                    class="form-control" />
                                <div style="color:red;" id="epincode" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input type="text" id="vemail" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                <div style="color:red;" hidden id="eemails"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="savechange()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!--User Delete Modal -->
    <div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sore This Record Delete
                    <label id="deletename" style="font-weight: bold"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteReacord()">Delete</button>
                </div>
            </div>
        </div>
    </div>

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
                                <label class="form-label" for="form3Example1c">Catagory</label>
                                <select class="form-select" id="pcatagory" name="catagory">
                                    <option value="">Select</option>
                                    @if (isset($catagory))
                                        @foreach ($catagory as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
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
                            <input type="text" class="form-control" id="pstock" oninput="statuscheck_addproduct()"
                                name="stock">
                        </div>
                        <div style="color:red;" id="epstock" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <input type="file" class="form-control" id="pimage" name="image">
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
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;">
                    <form id="view-product-from" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" id="vpid" hidden>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name </label>
                            <input type="text" class="form-control" id="vpname" name="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div style="color:red;" id="vepname" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="text" class="form-control" id="vpdescription" name="description">
                        </div>
                        <div style="color:red;" id="vepdescription" hidden></div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Catagory</label>
                                <select class="form-select" id="vpcatagory" name="catagory">
                                    <option value="">Select</option>
                                    @if (isset($catagory))
                                        @foreach ($catagory as $item)
                                            <option value="{{$item->id}}">{{$item->category_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div style="color:red;" hidden id="vepcountry"></div>
                            </div>
                        </div>

                        <input type="text" name="adminid" hidden value="{{session('adminname')}}" id="vpadminid">

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Price</label>
                            <input type="text" class="form-control" id="vpprice" name="price">
                        </div>
                        <div style="color:red;" id="vepprice" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Stock</label>
                            <input type="text" class="form-control" id="vpstock" oninput="statuscheck_viewproduct()"
                                name="stock">
                        </div>
                        <div style="color:red;" id="vepstock" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Image</label>
                            <div class="form-group">
                                <input type="file" name="file" id="file" class="input-file">
                                <label for="file" class="btn btn-tertiary js-labelFile" style="width:100%">
                                    <i class="icon fa fa-check"></i>
                                    <span class="js-fileName" id="vpimagename">Choose a file</span>
                                </label>
                            </div>
                        </div>
                        <div style="color:red;" id="vepimage" hidden></div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <select class="form-select" id="vpstatus" name="status">
                                <option value="">Select</option>
                                <option value="in stock">in stock</option>
                                <option value="out of stock">out of stock</option>
                            </select>
                        </div>
                        <div style="color:red;" id="vepstatus" hidden></div>

                    </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        (function () {

            'use strict';

            $('.input-file').each(function () {
                var $input = $(this),
                    $label = $input.next('.js-labelFile'),
                    labelVal = $label.html();

                $input.on('change', function (element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\').pop();
                    fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
                });
            });

        })();

        // User data are get all
        function showuserdataget() {
            $.ajax({
                type: "GET",
                url: "getuserofall",
                success: function (res) {
                    $("#outputoftable").html(res);
                },
                error: function (e) {
                    console.log(e);
                },
            })
        }
        // showuserdataget();

        // Product data are get all
        function showproductdataget() {
            $.ajax({
                type: "GET",
                url: "getproductall",
                success: function (res) {
                    // $("#outputoftable").html(res);
                    console.log(res);
                    
                },
                error: function (e) {
                    console.log(e);
                },
            })
        }

        // searching product data
        function searchproduct() {
            const data = document.getElementById("searchproductid").value;
            $.ajax({
                type: "get",
                url: '/searchproduct',
                data: {
                    searchText: data,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $("#producttable").html(res);
                },
                error: function (e) {

                },
            });
        }

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
                    producttable();
                },
                error: function (e) {

                },
            });
        }
        // view product
        function viewproductdata(id, name, description, price, stock, status, image, catagory) {
            document.getElementById("vpname").value = name;
            document.getElementById("vpdescription").value = description;
            document.getElementById("vpprice").value = price;
            document.getElementById("vpstock").value = stock;
            document.getElementById("vpstatus").value = status;
            document.getElementById('vpimagename').textContent = image;
            document.getElementById("vpid").value = id;
            document.getElementById("vpcatagory").value = catagory;
        }

        $('#viewproductmodel').on('hidden.bs.modal', function (e) {
            $("#vepname").attr("hidden", true);
            $("#vepdescription").attr("hidden", true);
            $("#vepprice").attr("hidden", true);
            $("#vepstock").attr("hidden", true);
            $("#vepimage").attr("hidden", true);
            $("#vepstatus").attr("hidden", true)
            $("#vepstatus").attr("hidden", true)
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
                    producttable();
                },
                error: function (e) {

                    const data = e["responseJSON"]["errors"];
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

        function statuscheck_viewproduct() {
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
        // add product
        $('#addproductmodel').on('hidden.bs.modal', function (e) {

            document.getElementById('pname').value = "",
                document.getElementById('pdescription').value = "",
                document.getElementById('pprice').value = "",
                document.getElementById('pstock').value = "",
                document.getElementById('pimage').value = "",
                document.getElementById('pstatus').value = "",

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

        function statuscheck_addproduct() {

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
        }

        function addproduct() {

            $("#epname").attr("hidden", true);
            $("#epdescription").attr("hidden", true);
            $("#epprice").attr("hidden", true);
            $("#epstock").attr("hidden", true);
            $("#epimage").attr("hidden", true);
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
                    $('#addproductmodel').modal("hide");
                    producttable();

                },
                error: function (e) {
                    const data = e['responseJSON']['errors'];
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
                },
                success: function (res) {
                    if (tablename == "getproductall") {
                        $("#producttable").html(res);
                    }

                    if (tablename == "getuserofall") {
                        $("#usertable").html(res);
                    }

                    if (tablename == "searchproduct") {
                        $("#producttable").html(res);
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        });

        // save change user function
        function savechange() {
            $("#enames").attr("hidden", true);
            $("#estate").attr("hidden", true);
            $("#epincode").attr("hidden", true);
            $("#ephone").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#eemails").attr("hidden", true);
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
                url: "/adminviewupdate",
                data: {
                    id: $('#vid').val(),
                    name: $('#vname').val(),
                    phone: $('#vphone').val(),
                    email: $('#vemail').val(),
                    address: $('#vaddress').val(),
                    gender: $('input[name="gender"]:checked').val(),
                    city: $('#vcity').val(),
                    state: $('#vstate').val(),
                    country: $('#vcountry').val(),
                    pincode: $('#vpincode').val(),
                },
                success: function (res) {
                    if (res.status == "success") {
                        $("#viewmodel").modal("hide")
                        usertable();
                    }
                },
                error: function (e) {
                    const data = e['responseJSON']['errors'];

                    if (data['name']) {
                        $("#enames").text(data['name'][0]).removeAttr("hidden");
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
                    if (data['country']) {
                        $("#ecountry").text(data['country'][0]).removeAttr("hidden");
                    }
                    if (data['email']) {
                        $("#eemails").text(data['email'][0]).removeAttr("hidden");
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

        // contry change
        $("#vcountry").on("change", function () {
            const selectElement = $('#vstate');
            selectElement.empty();
            const selectElement1 = $('#vcity');
            selectElement1.empty();
            $.ajax({
                type: "get",
                url: "/getstate",
                data: {
                    data: $('#vcountry').val(),
                },
                success: function (res) {
                    var oldstate = "{{old('state')}}";
                    console.log(oldstate);
                    $("#vstate").append(`<option value="">Select</option>`);
                    $("#vcity").append(`<option value="">Select</option>`);
                    $.each(res["statelist"], function (indexInArray, valueOfElement) {
                        var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                        console.log(selectstate);

                        $("#vstate").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);

                },
            })
        });
        // state change
        $("#vstate").on("change", function () {
            const selectElement = $('#vcity');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getcity",
                data: {
                    data: $('#vstate').val(),
                },
                success: function (res) {
                    console.log(res);
                    $("#vcity").append(`<option value="">Select</option>`);
                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                        $("#vcity").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);

                    });

                },
                error: function (e) {
                    console.log(e);

                },
            })
        });

        function deleteReacord() {
            $.ajax({
                type: "get",
                url: "/deleterecord",
                data: {
                    email: document.getElementById("deletename").textContent,
                },
                success: function (res) {
                    if (res.data == "delete") {
                        $("#deletemodel").modal("hide");
                        usertable();
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        }

        // view function
        function viewdataname(id, name, phone, gender, address, city, state, country, pincode, email, password) {
            // error clean
            $("#enames").attr("hidden", true);
            $("#estate").attr("hidden", true);
            $("#epincode").attr("hidden", true);
            $("#ephone").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#eemails").attr("hidden", true);
            $("#ecountry").attr("hidden", true);
            $("#econpassword").attr("hidden", true);
            $("#ecity").attr("hidden", true);
            $("#egender").attr("hidden", true);
            $("#eaddress").attr("hidden", true);

            //get data 
            document.getElementById("vid").value = id;
            document.getElementById("vname").value = name;
            document.getElementById("vphone").value = phone;
            document.getElementById("vaddress").value = address;
            document.getElementById("vpincode").value = pincode;
            document.getElementById("vemail").value = email;

            if (gender == "male") {
                document.getElementById('gender1').checked = true;
            }
            else {
                document.getElementById('gender2').checked = true;
            }

            var oldcountry = country;
            $.ajax({
                type: "get",
                url: "/getcountry",
                data: {
                    data: country,
                },
                success: function (res) {

                    $("#vcountry").append(`<option value="">Select</option>`);
                    $.each(res["countrylist"], function (indexInArray, valueOfElement) {
                        var selectstate = (oldcountry == valueOfElement["id"]) ? "selected" : "";
                        $("#vcountry").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);

                },
            })

            var oldstate = state;
            $.ajax({
                type: "get",
                url: "/getstate",
                data: {
                    data: country,
                },
                success: function (res) {

                    $("#vstate").append(`<option value="">Select</option>`);
                    $.each(res["statelist"], function (indexInArray, valueOfElement) {
                        var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                        $("#vstate").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);

                },
            })

            var oldcity = city;
            $.ajax({
                type: "get",
                url: "/getcity",
                data: {
                    data: state,
                },
                success: function (res) {
                    $("#vcity").append(`<option value="">Select</option>`);
                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                        var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                        $("#vcity").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                    });

                },
                error: function (e) {
                    console.log(e);

                },
            })

        }

        function deletedataname(name) {
            document.getElementById("deletename").textContent = name;
        }

        // update admin data
        function update() {
            $("#ename").attr("hidden", true);
            $("#eemail").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#econfpassword").attr("hidden", true);
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: "/adminupdate",
                    data: {
                        id: $('#id').val(),
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        conformpassword: $('#conpassword').val()
                    },
                    success: function (res) {
                        window.location.href = res.redirect_url;
                    },
                    error: function (e) {
                        const data = e['responseJSON']['errors'];

                        if (data['name']) {
                            $("#ename").text(data['name'][0]).removeAttr("hidden");
                        }
                        if (data['conformpassword']) {
                            $("#econfpassword").text(data['conformpassword'][0]).removeAttr("hidden");
                        }
                        if (data['email']) {
                            $("#eemail").text(data['email'][0]).removeAttr("hidden");
                        }
                        if (data['password']) {
                            $("#epassword").text(data['password'][0]).removeAttr("hidden");
                        }
                    }
                });
            });
        }

        // $('#showCustomer').on('click', function () {
        //     console.log("customer");
        //     $("#usertable").removeAttr("hidden");
        //     $("#producttablediv").attr("hidden", true);
        // });

        // $('#showProduct').on('click', function () {
        //     console.log("product");
        //     $("#producttablediv").removeAttr("hidden");
        //     $("#usertable").attr("hidden", true);

        // });

        // password 
        function passwordshow() {
            $("#passwordhidden").removeAttr("hidden");
            $("#passwordshow").attr("hidden", true);
            document.getElementById('password').type = 'text';
            document.getElementById('vpassword').type = 'text';
        }
        function passwordhidden() {
            $("#passwordshow").removeAttr("hidden");
            $("#passwordhidden").attr('hidden', true);
            document.getElementById('password').type = 'password';
            document.getElementById('vpassword').type = 'password';
        }

        // config password
        function conformpasswordshow() {
            $("#conformpasswordhidden").removeAttr("hidden");
            $("#conformpasswordshow").attr("hidden", true);
            document.getElementById('conpassword').type = 'text';
            document.getElementById('vconpassword').type = 'text';
        }
        function conformpasswordhidden() {
            $("#conformpasswordshow").removeAttr("hidden");
            $("#conformpasswordhidden").attr('hidden', true);
            document.getElementById('conpassword').type = 'password';
            document.getElementById('vconpassword').type = 'password';
        }

        getadminprofile();

        // admin profile
        function getadminprofile() {
            $("#ename").attr("hidden", true);
            $("#eemail").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#econfpassword").attr("hidden", true);
            $.ajax({
                type: 'GET',
                url: "/adminruser",
                data: { adminname: "{{session('adminname')}}" },
                success: function (res) {
                    document.getElementById('name').value = res[0]['name'];
                    document.getElementById('email').value = res[0]['email'];
                    document.getElementById('password').value = res[0]['password'];
                    document.getElementById('conpassword').value = res[0]['password'];
                    document.getElementById('id').value = res[0]['id'];
                },
                error: function (e) {
                    console.error("Error:", e);
                }
            });
        }

    </script>
</body>

</html>