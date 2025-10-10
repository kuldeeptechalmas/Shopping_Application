<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>
<style>
    .pagination {
        margin-bottom: 0px;
        margin-right: 120px;
    }

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
    }

    .btn:first-child:active {
        color: var(--cui-btn-active-color);
        background-color: var(--cui-btn-active-bg);
        border-color: var(--cui-btn-active-border-color);
    }

</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <div class="d-flex justify-content-end">
                    <div class="pe-5">
                        <form class="d-flex" method="POST">
                            @csrf
                            <input class="form-control me-2" name="searchText" id="searchproductid" value="{{ isset($searchText)?$searchText:'' }}" type="search" placeholder="Search" aria-label="Search">
                            <input type="text" name="catagoryid" value="{{isset($catagoryid) ? $catagoryid : ''}}" hidden id="">
                            <input type="text" name="action" value="searchOrder" hidden>
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
                <form class="d-flex">
                    <div class="hover-trigger position-relative">
                        <h3><i class="fa-solid fa-circle-user" style="margin-left: 21%;"></i></h3>
                        {{session('shopkeeperid')}}
                        <div class="show-on-hover position-absolute" style="right: 0px; width: 222px; background: white;border-radius: 15px;">
                            <div class="shadow p-3 bg-body rounded">


                                <div style="padding: 10px; border-bottom: 1px solid #555;">
                                    <a style="text-decoration: none;  color: #000;" href="/shopkeeperprofile">
                                        Profile
                                    </a>
                                </div>
                                <div style="padding: 10px; border-bottom: 1px solid #555;">
                                    <a style="text-decoration: none;  color: #000;" href="/shopkeeperchangepassword/{{session('shopkeeperemail')}}">
                                        Change Password
                                    </a>
                                </div>
                                <div style="padding: 10px; border-bottom: 1px solid #555;">
                                    <a style="text-decoration: none;  color: #000;" href="/ShopkeeperOrderList">
                                        Order History
                                    </a>
                                </div>

                                <a style="text-decoration: none;  color: #000;" href="/logout">
                                    <div style="padding: 10px;color:red;">
                                        Logout
                                    </div>
                                </a>
                            </div>
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
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">

                    <a class="nav-link" id="showProductdiv">
                        <i class="nav-icon cil-speedometer"></i>
                        Products
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
            </ul>
            <div class="sidebar-footer">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100 bg-light">

            <div class="body flex-grow-1 px-3" style="margin-left: 21%;">

                <div class="container-lg" id="usertable">

                </div>
                <div class="container-lg" id="producttablediv" style="margin-top: 136px;">
                    @yield('content')

                    @if (isset($showallrecord))
                    @if (isset($data))

                    @if ($data->isNotEmpty())

                    <div class="row">
                        @foreach ($data as $item)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 card" style="width: 18rem; margin: 10px;">
                            <a href="/ProductDetailsShow/{{$item->id}}">
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
                                <a href="/productview/{{ $item->id }}">
                                    <button type="button" class="btn btn-primary">
                                        Edit
                                    </button>
                                </a>

                                <button type="button" class="btn btn-danger text-white" style="" onclick="deleteproductdata('{{$item->id}}','{{$item->name}}')" data-bs-toggle="modal" data-bs-target="#productdeletemodel">
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
                    <div style="display: flex;justify-content: center;margin-top: 116px;">
                        <div>
                            <div style="width: 100px; height: auto; display: flex;justify-content: center;">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;justify-content: center;text-align: center;">
                        <div>

                            <h5>Sorry, no results found <br /></h5>
                            Edit search or go back to Product Page <br /><br />
                            <a href="/shopkeeperdashboard">
                                <button class="btn btn-primary" style="width: 192px;">Go To Product</button>
                            </a>
                        </div>
                    </div>
                    @endif
                    @else
                    <div style="display: flex;justify-content: center;margin-top: 116px;">
                        <div>
                            <div style="width: 100px; height: auto; display: flex;justify-content: center;">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/not_found_result_image.WEBP') }}" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div style="display: flex;justify-content: center;text-align: center;">
                        <div>

                            <h5>Sorry, no results found <br /></h5>
                            Edit search or go back to Product Page <br /><br />
                            <a href="/shopkeeperdashboard">
                                <button class="btn btn-primary" style="width: 192px;">Go To Product</button>
                            </a>
                        </div>
                    </div>
                    @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--Product Delete Modal -->
    <div class="modal fade" id="productdeletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Product Delete Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deleteproduct" method="post">
                    @csrf
                    <div class="modal-body">
                        Are You Sore This Record Delete
                        <label id="deletenameproduct" style="font-weight: bold"></label>
                        <input id="deleteid" name="id" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @stack('shopkeeper_script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        // pagination to prodcut
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href');
            console.log(page);
            window.location.href = page;

        });

        // delete product
        // done
        function deleteproductdata(id, name) {
            document.getElementById("deletenameproduct").textContent = name;
            document.getElementById("deleteid").value = id;
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

        $("#showProductdiv").on("click", function() {
            if (localStorage.getItem('categoryShowStore') == 'Show') {
                localStorage.clear();

                $("#product1").attr("hidden", true);
                $("#hideProduct").attr("hidden", true);
                $("#showProduct").removeAttr("hidden");
            } else {

                localStorage.setItem('categoryShowStore', 'Show');

                $("#product1").removeAttr("hidden");
                $("#hideProduct").removeAttr("hidden");
                $("#showProduct").attr("hidden", true);
            }

        })

        $(document).ready(function() {

            // show categoryShowStore
            if (localStorage.getItem('categoryShowStore') == 'Show') {

                console.log(localStorage.getItem('categoryShowStore'));
                $("#product1").removeAttr("hidden");
                $("#hideProduct").removeAttr("hidden");
                $("#showProduct").attr("hidden", true);
            }


            $("#file-input").on("change", function() {
                var files = $(this)[0].files;
                $("#preview-container").empty();
                if (files.length > 0) {
                    for (var i = 0; i < files.length; i++) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>Delete</button></div>").appendTo("#preview-container");
                        };
                        reader.readAsDataURL(files[i]);
                    }
                }
            });
            $("#preview-container").on("click", ".delete", function() {
                $(this).parent(".preview").remove();
                $("#file-input").val("");
            });
        });

        (function() {

            'use strict';

            $('.input-file').each(function() {
                var $input = $(this)
                    , $label = $input.next('.js-labelFile')
                    , labelVal = $label.html();

                $input.on('change', function(element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\').pop();
                    console.log(fileName);

                    fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html("labelVal");
                });
            });

        })();

    </script>
</body>
</html>
