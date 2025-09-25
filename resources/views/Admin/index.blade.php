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

    @yield('css_content')
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
                    li
                </ul>
                <div style="margin-right: 62px;">
                    <form class="d-flex">
                        <input class="form-control me-2" oninput="searchproduct()" id="searchproductid" type="search"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" onclick="searchproduct()" type="button">Search</button>
                    </form>
                </div>
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
                    <a href="/AdminInUser">
                        <img style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a href="/AdminInUser" id="usersnavbarid" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Users
                    </a>
                    <a href="/AdminInProduct" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Products
                    </a>
                    <a href="/AdminInOrder" class="nav-link">
                        <i class="nav-icon cil-speedometer"></i> Order
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

    <!--Customer And Shopkeeper View Modal -->
    <div class="modal fade" id="viewmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> View Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userviewid">

                </div>
            </div>
        </div>
    </div>

    <!--customer and shopkeeper Delete Modal -->
    <div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/deleterecord">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Modal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are You Sore This Record Delete
                        {{-- <label id="deletename" style="font-weight: bold"></label> --}}
                        <input type="text" name="email" id="deletename" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
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
                                <div style="color:red;" hidden id="epcatagory">
                                </div>
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
                <div class="modal-body" style="margin-right: 10%;margin-left: 9%;" id="viewmodelform">
                    {{-- body other page "viewproduct.blade.php" --}}
                </div>
            </div>
        </div>
    </div>

    <!--Product Delete Modal -->
    <div class="modal fade" id="productdeletemodel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('delete_product_admin') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Product Delete Modal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are You Sore This Record Delete
                        <input type="text" name="deleteid" id="deleteid" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @yield('script_content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        // delete customer and shopkeeper
        // done
        function deletedataname(name) {
            document.getElementById("deletename").value = name;
        }

        // delete product
        // done
        function deleteproductdata(id, name) {
            document.getElementById("deleteid").value = id;
        }

        // view product
        // done
        function viewproduct_productshow(productid) {
            $.ajax({
                type: "get",
                url: "/productviewadmin/" + productid,
                success: function (res) {
                    $("#viewmodelform").html(res);
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }

        // status change 
        // done
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
        $("#pstatus").on("change", function () {
            if (document.getElementById('pstatus').value == "out of stock") {
                document.getElementById('pstock').value = 0;
            }
        })

        // searching product data
        // done use ajax
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
                    $("#datatable").html(res);
                },
                error: function (e) {

                },
            });
        }

        // contry change
        // done
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
        // done
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

        // password 
        // done
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
        // done
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

        // pagination data all
        // done
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href');
            const tables = page.split("?")[0];
            const tablename = tables.split('/')[3];
            const search = document.getElementById("searchproductid").value;

            $.ajax({
                url: page,
                type: 'GET',
                data: {
                    searchText: search,
                },
                success: function (res) {
                    if (tablename == "getproductall") {
                        $("#datatable").html(res);
                    }

                    if (tablename == "getuserofall") {
                        $("#datatable").html(res);
                    }

                    if (tablename == "searchproduct") {
                        $("#datatable").html(res);
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        });


        // customer and shopkeeper view data
        // done
        function customerAndshopkeeperview(id) {

            $.ajax({
                type: "get",
                url: "/productuseradmin/" + id,
                success: function (res) {
                    $("#userviewid").html(res);
                },
                error: function (e) {
                    console.log(e);
                }
            })
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

        // baki
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

    </script>
</body>

</html>