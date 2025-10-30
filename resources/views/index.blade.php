<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/customer/mainIndex.css') }}">
</head>

<div id="back-to-top">
    <i class="fa-solid fa-angle-up mx-2"></i> Back To Top
</div>

<body style="background-color: #f1f3f6;">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #fff;">
        <div class="container">
            <div style="width: 100px; height: auto;">
                <a href="/MyShop">
                    <img style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/UploadeFile/logo1.png') }}" alt="Image">
                </a>
            </div>
            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <form class="d-flex dropdown_search_main" method="post" role="search" style="width: 387px;">
                    @csrf
                    <input type="text" name="action" value="Search" hidden id="">
                    <input class="form-control search_navbar dropdown_search me-2" type="search" id="search_id" placeholder="Search" aria-label="Search" name="search_data" value="{{isset($inputdata) ? $inputdata : ''}}" />
                    <button type="submit" style="background: transparent; border: none; position: absolute; top: 50%; left: 20px; transform: translate(-50%, -50%);" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
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

                    <a href="/addtocartget" class="main-cart" style="text-decoration: none ;color: #000;">
                        <div class="cart-icon-container">
                            <i class="fa fa-shopping-cart" style="font-size:24px"></i>
                            <span class="badge" id="cart-item-count"></span>
                        </div>
                        <span class="ms-2">Cart</span>
                    </a>
                    @if (Session::get("customerid"))

                    <div>
                        <div class="hover-trigger position-relative" style="display: flex;flex-direction: column;text-align: center;">
                            <h1><i class="fa-solid fa-circle-user"></i></h1>
                            {{session('customerid')}}
                            <div class="show-on-hover position-absolute" style="right: 0px; width: 222px; background: white;border-radius: 15px;">

                                <div class="shadow p-3 bg-body" style="text-align: left;border-radius: 1.25rem;">

                                    <a class="profile-item" style="text-decoration: none;  color: #000;display: flex;align-items: center;" href="/CustomerProfile">
                                        <div style="width: 17px;height: 17px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;margin-top: -8px;" src="{{ asset('storage/UploadeFile/user.png') }}" alt="Image">
                                        </div>
                                        <div style="padding: 10px;">
                                            Profile
                                        </div>
                                    </a>
                                    <a class="profile-item" style="text-decoration: none;  color: #000;display: flex;align-items: center;" href="/customerchangepassword/{{session('customeremail')}}">
                                        <div style="width: 29px;height: 17px;margin-left: -6px;margin-right: -7px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;margin-top: -8px;" src="{{ asset('storage/UploadeFile/changepassword-icon.png') }}" alt="Image">
                                        </div>
                                        <div style="padding: 10px;">
                                            Change Password
                                        </div>
                                    </a>
                                    <a class="profile-item" style="text-decoration: none;  color: #000;display: flex;align-items: center;" href="/order">
                                        <div style="width: 20px;height: 16px;margin-left: -1px;margin-right: -1px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;margin-top: -8px;" src="{{ asset('storage/UploadeFile/logistics.png') }}" alt="Image">
                                        </div>
                                        <div class="profile-item" style="padding: 10px;">
                                            My Order
                                        </div>
                                    </a>
                                    <a class="profile-item" style="text-decoration: none;  color: #000;display: flex;align-items: center;" href="/wishlist">
                                        <div style="width: 17px;height: 17px;margin-left: 1px;margin-right: -1px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;margin-top: -8px;" src="{{ asset('storage/UploadeFile/heart.png') }}" alt="Image">
                                        </div>
                                        <div style="padding: 10px;">
                                            Wishlist
                                        </div>
                                    </a>

                                    <a class="profile-item" style="text-decoration: none;  color: #000;display: flex;align-items: center;" href="/logout">

                                        <div style="width: 19px;height: 17px;margin-left: 1px;margin-right: -1px;">
                                            <img style="width: 100%; height: 100%; object-fit: cover;margin-top: -8px;" src="{{ asset('storage/UploadeFile/power-off.png') }}" alt="Image">
                                        </div>
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
    <div style="margin-top: 96px;"></div>
    @yield( 'content')

    @stack('index_Main_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/customer/mainindex.js') }}"></script>
</body>
</html>
