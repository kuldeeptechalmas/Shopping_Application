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
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/css/coreui.min.css" rel="stylesheet">
    <title>Admin</title>
    <script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.4.1/dist/js/coreui.bundle.min.js"></script>
    <title>Welcome</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
                        <h1><i class="fa-solid fa-circle-user" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></h1>
                                {{session('adminname')}}
                    </div>

                </form>
            </div>
        </div>
    </nav>

    <div class="c-app">
        <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Shopping_Application</div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" onclick="" id="showCustomer">
                        <i class="nav-icon cil-speedometer"></i> Customer
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="showShopkeeper">
                        <i class="nav-icon cil-speedometer"></i> Shopkeeper
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
            </div>
        </div>

        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            <div class="body flex-grow-1 px-3" style="margin-left: 21%;">
                <div class="container-lg">

                    <div id="CustomerOutput" class="mt-3" style="">
                        <h1>Show Customer</h1>
                        <table class="table table-striped" style="margin-top: 5%;">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if (isset($customer))
                                    @foreach ($customer as $item)
                                        <tr>
                                            <th scope="col">{{$item->name}}</th>
                                            <th scope="col">{{$item->address}}</th>
                                            <th scope="col">{{$item->phone}}</th>
                                            <th scope="col">{{$item->email}}</th>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    <div id="ShopkeeperOutput" class="mt-3" style="display:none;">
                        <h1>Show Shopkeeper</h1>
                        <table class="table table-striped" style="margin-top: 5%;">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if (isset($shopkeeper))
                                    @foreach ($shopkeeper as $item)
                                        <tr>
                                            <th scope="col">{{$item->name}}</th>
                                            <th scope="col">{{$item->address}}</th>
                                            <th scope="col">{{$item->phone}}</th>
                                            <th scope="col">{{$item->email}}</th>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">User detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (session('adminname'))
                        {{session('adminname')}}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/adminlogout" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#showCustomer').on('click', function () {
                $('#CustomerOutput').toggle();
                $('#ShopkeeperOutput').css('display', 'none');

            });
        });

        $(document).ready(function () {
            $('#showShopkeeper').on('click', function () {
                $('#ShopkeeperOutput').toggle();
                $('#CustomerOutput').css('display', 'none');
            });
        });
    </script>
</body>

</html>