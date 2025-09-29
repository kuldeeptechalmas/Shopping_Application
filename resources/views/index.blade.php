<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* favourite heart css */
        .likes {
            position: absolute;
            right: 10px;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
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

        .dropdown_search_main {
            position: relative;
        }

        .dropdown_search_content {
            /* visibility: hidden; */
            background-color: #ffffff;
            position: absolute;
            width: 97%;
            padding: 10px 7px;
            top: 97%;
            margin-top: 10px;
            border-radius: 0 0 5px 5px;
            box-shadow: 1px 1px 1px rgb(0 0 0 / 16%);
            max-height: 146px;
            z-index: 99;
            overflow: hidden;
            text-overflow: ellipsis
        }

    </style>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-light ">
        <div class="container">
            <div style="width: 100px; height: auto;">
                <a href="/MyShop">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                </a>
            </div>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <form class="d-flex dropdown_search_main" action="/search" method="post" role="search" style="width: 300px;">
                    @csrf
                    <input class="form-control dropdown_search me-2" type="search" id="search_id" placeholder="Search" aria-label="Search" name="search_data" value="{{isset($inputdata) ? $inputdata : ''}}" />
                    <button type="submit" class="btn btn-primary" name="submit">Search</button>
                    <div class="dropdown_search_content" style="text-decoration: none; color: #000;" id="searchdataname" hidden>

                    </div>
                </form>
                <ul class="navbar-nav mb-lg-0 d-flex align-items-center justify-content-between" style="width: 230px; ">
                    @if (empty(Session::get("customerid")))
                    <li class="nav-item">
                        <a aria-current="page" href="{{ route('login') }}" style="color: white;text-decoration: none;">
                            <div style="align-items: center;justify-content: center;display: flex;width: 108px;margin-top: 5px;height: 37px;border-radius: 3px;text-align: center;background-color: #2874f0;">

                                Login
                            </div>
                        </a>
                    </li>
                    @endif

                    <a href="/addtocartget" style="text-decoration: none ;color: #000;">
                        <img style="height: 30px; width: 30px; object-fit: contain;" src="{{ asset('storage/UploadeFile/pic36.png') }}" alt="Image">
                        <span class="ms-2">Cart</span>
                    </a>
                    @if (Session::get("customerid"))

                    <div>
                        <div class="hover-trigger position-relative">
                            <h1><i class="fa-solid fa-circle-user" style="margin-left: 11px;"></i></h1>
                            {{session('customerid')}}
                            <div class="show-on-hover position-absolute" style="right: 0px; width: 222px; background: white;border-radius: 15px;">
                                <div class="shadow p-3 bg-body rounded">


                                    <div style="padding: 10px; border-bottom: 1px solid #555;">
                                        <a style="text-decoration: none;  color: #000;" href="/customerprofile/{{session('customeremail')}}">
                                            Profile
                                        </a>
                                    </div>
                                    <div style="padding: 10px; border-bottom: 1px solid #555;">
                                        <a style="text-decoration: none;  color: #000;" href="/customerchangepassword/{{session('customeremail')}}">
                                            Change Password
                                        </a>
                                    </div>
                                    <div style="padding: 10px; border-bottom: 1px solid #555;">
                                        <a style="text-decoration: none;  color: #000;" href="/order">
                                            My Order
                                        </a>
                                    </div>
                                    <div style="padding: 10px; border-bottom: 1px solid #555;">
                                        <a style="text-decoration: none;  color: #000;" href="/wishlist">
                                            Wishlist
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function favourite_product_data_save(rs, productid) {

            var element = $(rs)[0].style.color;


            if (element != "red") {

                $.ajax({
                    url: "/favourite/" + productid
                    , type: "get"
                    , success: function(res) {
                        if (res.url) {
                            window.location.href = res.url;
                        } else {
                            $(rs)[0].style.color = "red";
                            toastify().success('Add to Wishlist !!!', {
                                position: 'center'
                            , });
                        }

                    }
                    , error: function(e) {
                        console.log(e);
                    }
                })
            } else {
                $.ajax({
                    url: "/removewishlist/" + productid
                    , type: "get"
                    , success: function(res) {
                        if (res.url) {
                            window.location.href = res.url;
                        } else {
                            $(rs)[0].style.color = "#c2c2c2";
                            toastify().error('Remove in Wishlist', {
                                position: 'center'
                            , });
                        }
                    }
                    , error: function(e) {
                        console.log(e);

                    }
                })
            }
        }

    </script>
</body>

</html>
