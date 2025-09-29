<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

                /* .icon:before {
                    //font-awesome
                    content: "\f093";
                }

                &.has-file {
                    .icon:before {
                        //font-awesome
                        content: "\f00c";
                        color: #5AAC7B;
                    }
                } */
            }
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

    </style>

    @yield('css_content')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <div style="margin-right: 62px;">
                    <form class="d-flex">
                        <input class="form-control me-2" oninput="searchproduct()" id="searchproductid" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" onclick="searchproduct()" type="button">Search</button>
                    </form>
                </div>
                <form class="d-flex">

                    {{-- <div>
                        <h1><i class="fa-solid fa-circle-user" onclick="getadminprofile()" data-bs-toggle="modal"
                                data-bs-target="#adminmodel"></i>
                        </h1>
                        {{session('adminname')}}
            </div> --}}

            <div>
                <div class="hover-trigger position-relative">
                    <h1><i class="fa-solid fa-circle-user" style="margin-left: 11px;"></i></h1>
                    {{session('customerid')}}
                    <div class="show-on-hover position-absolute" style="right: 0px; width: 222px; background: white;border-radius: 15px;">
                        <div class="shadow p-3 bg-body rounded">


                            <div style="padding: 10px; border-bottom: 1px solid #555;">
                                <a style="text-decoration: none;  color: #000;" href="/AdminProfile">
                                    Profile
                                </a>
                            </div>


                            <a style="text-decoration: none;  color: #000;" href="{{ route('admin.Logout') }}">
                                <div style="padding: 10px;color:red;">
                                    Logout
                                </div>
                            </a>
                        </div>
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
                    <a href="/AdminInUser">
                        <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    @stack("script_content")

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
                    document.getElementById('vpstatus').value = "";
                }
            }

        }
        $("#pstatus").on("change", function() {
            if (document.getElementById('pstatus').value == "out of stock") {
                document.getElementById('pstock').value = 0;
            }
        });



        // delete customer and shopkeeper
        // done
        // function deletedataname(name) {
        //     document.getElementById("deletename").value = name;
        // }


        // view product
        // done
        // function viewproduct_productshow(productid) {
        //     $.ajax({
        //         type: "get"
        //         , url: "/productviewadmin/" + productid
        //         , success: function(res) {
        //             $("#viewmodelform").html(res);
        //         }
        //         , error: function(e) {
        //             console.log(e);
        //         }
        //     })
        // }



        // searching product data
        // done use ajax
        // function searchproduct() {
        //     const data = document.getElementById("searchproductid").value;
        //     $.ajax({
        //         type: "get"
        //         , url: '/searchproduct'
        //         , data: {
        //             searchText: data
        //         , }
        //         , headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //         , success: function(res) {
        //             $("#datatable").html(res);
        //         }
        //         , error: function(e) {

        //         }
        //     , });
        // }

        // contry change
        // done
        // $("#vcountry").on("change", function() {
        //     const selectElement = $('#vstate');
        //     selectElement.empty();
        //     const selectElement1 = $('#vcity');
        //     selectElement1.empty();
        //     $.ajax({
        //         type: "get"
        //         , url: "/getstate"
        //         , data: {
        //             data: $('#vcountry').val()
        //         , }
        //         , success: function(res) {
        //             var oldstate = "{{old('state')}}";
        //             console.log(oldstate);
        //             $("#vstate").append(`<option value="">Select</option>`);
        //             $("#vcity").append(`<option value="">Select</option>`);
        //             $.each(res["statelist"], function(indexInArray, valueOfElement) {
        //                 var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
        //                 console.log(selectstate);

        //                 $("#vstate").append(`<option value="${valueOfElement[" id"]}" ${selectstate}>${valueOfElement["name"]}</option>`);
        //             });
        //         }
        //         , error: function(e) {
        //             console.log(e);

        //         }
        //     , })
        // });

        // state change
        // done
        // $("#vstate").on("change", function() {
        //     const selectElement = $('#vcity');
        //     selectElement.empty();
        //     $.ajax({
        //         type: "get"
        //         , url: "/getcity"
        //         , data: {
        //             data: $('#vstate').val()
        //         , }
        //         , success: function(res) {
        //             $("#vcity").append(`<option value="">Select</option>`);
        //             $.each(res["citylist"], function(indexInArray, valueOfElement) {
        //                 $("#vcity").append(`<option value="${valueOfElement[" id"]}">${valueOfElement["name"]}</option>`);

        //             });

        //         }
        //         , error: function(e) {
        //             console.log(e);

        //         }
        //     , })
        // });





        // pagination data all
        // done
        // $(document).on('click', '.pagination a', function(e) {
        //     e.preventDefault();
        //     var page = $(this).attr('href');
        //     const tables = page.split("?")[0];
        //     const tablename = tables.split('/')[3];
        //     const search = document.getElementById("searchproductid").value;

        //     $.ajax({
        //         url: page
        //         , type: 'GET'
        //         , data: {
        //             searchText: search
        //         , }
        //         , success: function(res) {
        //             if (tablename == "getproductall") {
        //                 $("#datatable").html(res);
        //             }

        //             if (tablename == "getuserofall") {
        //                 $("#datatable").html(res);
        //             }

        //             if (tablename == "searchproduct") {
        //                 $("#datatable").html(res);
        //             }
        //         }
        //         , error: function(e) {
        //             console.log(e);
        //         }
        //     , });
        // });


        // customer and shopkeeper view data
        // done
        // function customerAndshopkeeperview(id) {

        //     $.ajax({
        //         type: "get"
        //         , url: "/productuseradmin/" + id
        //         , success: function(res) {
        //             $("#userviewid").html(res);
        //         }
        //         , error: function(e) {
        //             console.log(e);
        //         }
        //     })
        // }

        // update admin data
        // function update() {
        //     $("#ename").attr("hidden", true);
        //     $("#eemail").attr("hidden", true);
        //     $("#epassword").attr("hidden", true);
        //     $("#econfpassword").attr("hidden", true);
        //     $(document).ready(function() {
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         $.ajax({
        //             type: 'post'
        //             , url: "/adminupdate"
        //             , data: {
        //                 id: $('#id').val()
        //                 , name: $('#name').val()
        //                 , email: $('#email').val()
        //                 , password: $('#password').val()
        //                 , conformpassword: $('#conpassword').val()
        //             }
        //             , success: function(res) {
        //                 window.location.href = res.redirect_url;
        //             }
        //             , error: function(e) {
        //                 const data = e['responseJSON']['errors'];

        //                 if (data['name']) {
        //                     $("#ename").text(data['name'][0]).removeAttr("hidden");
        //                 }
        //                 if (data['conformpassword']) {
        //                     $("#econfpassword").text(data['conformpassword'][0]).removeAttr("hidden");
        //                 }
        //                 if (data['email']) {
        //                     $("#eemail").text(data['email'][0]).removeAttr("hidden");
        //                 }
        //                 if (data['password']) {
        //                     $("#epassword").text(data['password'][0]).removeAttr("hidden");
        //                 }
        //             }
        //         });
        //     });
        // }

        // getadminprofile();

        // admin profile
        // function getadminprofile() {
        //     $("#ename").attr("hidden", true);
        //     $("#eemail").attr("hidden", true);
        //     $("#epassword").attr("hidden", true);
        //     $("#econfpassword").attr("hidden", true);
        //     $.ajax({
        //         type: 'GET'
        //         , url: "/adminruser"
        //         , data: {
        //             adminname: "{{session('adminname')}}"
        //         }
        //         , success: function(res) {
        //             document.getElementById('name').value = res[0]['name'];
        //             document.getElementById('email').value = res[0]['email'];
        //             document.getElementById('password').value = res[0]['password'];
        //             document.getElementById('conpassword').value = res[0]['password'];
        //             document.getElementById('id').value = res[0]['id'];
        //         }
        //         , error: function(e) {
        //             console.error("Error:", e);
        //         }
        //     });
        // }

        // baki
        // (function() {

        //     'use strict';

        //     $('.input-file').each(function() {
        //         var $input = $(this)
        //             , $label = $input.next('.js-labelFile')
        //             , labelVal = $label.html();

        //         $input.on('change', function(element) {
        //             var fileName = '';
        //             if (element.target.value) fileName = element.target.value.split('\\').pop();
        //             fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
        //         });
        //     });

        // })();

    </script>
</body>

</html>
