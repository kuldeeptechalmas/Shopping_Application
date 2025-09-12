<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="">
                <div style="width: 100px; height: auto; margin-left:131px">
                    <img style="width: 100%; height: 100%; object-fit: cover;"
                        src="{{ asset('storage/UploadeFile/logo.png') }}" alt="Image">
                </div>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex" role="search" style="width: 300px;">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                </form>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <div
                        style="margin-left: 47px;width: 108px;height: 37px;border-radius: 3px;text-align: center;background-color: #2874f0;">

                        <li class="nav-item" style="margin-top: 5px;">
                            <a aria-current="page" href="/login" style="color: white;text-decoration: none;">
                                Login
                            </a>
                        </li>

                    </div>

                    <div class="row" style="width: 250px;">
                        <div class="col-2"></div>
                        <div class="col-10"><a href="/addtocartget" style="text-decoration: none ;color: #000;">
                            <img style="height: 30px; width: 30px; object-fit: contain;"
                                src="{{ asset('storage/UploadeFile/pic36.png') }}" alt="Image">
                            <span class="ms-2">Cart</span>
                        </a></div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>