<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
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

        .dropdown_search_main {
            position: relative;
        }

        .dropdown_search_content {
            visibility: hidden;
            background-color: #ffffff;
            position: absolute;
            width: 97%;
            padding: 10px 7px;
            top: 97%;
            margin-top: 10px;
            border-radius: 0 0 5px 5px;
            box-shadow: 1px 1px 1px rgb(0 0 0 / 16%);
        }

        .dropdown_search:focus~.dropdown_search_content {
            visibility: visible;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="">
                <div style="width: 100px; height: auto; margin-left:131px">
                    <a href="/MyShop">
                        <img style="width: 100%; height: 100%; object-fit: cover;"
                            src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                    </a>
                </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex dropdown_search_main" role="search" style="width: 300px;">
                    <input class="form-control dropdown_search me-2" type="search" id="search_id"
                        oninput="search_product_navbar()" placeholder="Search" aria-label="Search" />
                    <div class="dropdown_search_content">
                        Data Hear<br>
                        demo <br>
                        demo1<br>
                    </div>
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (empty(Session::get("customerid")))
                        <div
                            style="margin-left: 47px;width: 108px;margin-top: 19px;height: 37px;border-radius: 3px;text-align: center;background-color: #2874f0;">

                            <li class="nav-item" style="margin-top: 5px;">
                                <a aria-current="page" href="/login" style="color: white;text-decoration: none;">
                                    Login
                                </a>
                            </li>
                        </div>
                    @endif

                    <div class="row" style="width: 250px;margin-top: 19px;">
                        <div class="col-2"></div>
                        <div class="col-10"><a href="/addtocartget" style="text-decoration: none ;color: #000;">
                                <img style="height: 30px; width: 30px; object-fit: contain;"
                                    src="{{ asset('storage/UploadeFile/pic36.png') }}" alt="Image">
                                <span class="ms-2">Cart</span>
                            </a></div>
                    </div>
                    @if (Session::get("customerid"))

                        <div style="margin-left: 229px;">
                            <div class="hover-trigger position-relative">
                                <h1><i class="fa-solid fa-circle-user" style="margin-left: 11px;"></i></h1>
                                {{session('customerid')}}
                                <div class="show-on-hover position-absolute"
                                    style="right: 0px; width: 222px; background: white;border-radius: 15px;">
                                    <div class="shadow p-3 bg-body rounded">


                                        <div style="padding: 10px; border-bottom: 1px solid #555;">
                                            <a style="text-decoration: none;  color: #000;"
                                                href="/customerprofile/{{session('customeremail')}}">
                                                Profile
                                            </a>
                                        </div>
                                        <div style="padding: 10px; border-bottom: 1px solid #555;">
                                            <a style="text-decoration: none;  color: #000;"
                                                href="/customerchangepassword/{{session('customeremail')}}">
                                                Change Password
                                            </a>
                                        </div>
                                        <div style="padding: 10px; border-bottom: 1px solid #555;">
                                            <a style="text-decoration: none;  color: #000;" href="/order">
                                                Order
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
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield(section: 'content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function search_product_navbar() {
            console.log($("#search_id").val());


            // $.ajax({
            //     type: "get",
            //     url: "/search",
            //     data: {
            //         search_data: $("#search_id").val()
            //     },
            //     success: function (res) {
            //         console.log(res);

            //     },
            //     error: function (e) {

            //     }
            // });
        }
    </script>
</body>

</html>