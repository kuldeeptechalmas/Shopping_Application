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
                                <input readonly type="text" id="name" value="{{old('name')}}" name='name'
                                    class="form-control" />
                                @error('name')
                                    <div style="color:red;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input readonly type="text" id="email" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                @error('email')
                                    <div style="color:red;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4c">Password</label>
                                <input readonly type="password" id="password" name="password" class="form-control" />
                                <i class="fa-solid fa-eye" id="passwordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
                            </div>
                        </div>
                        <input type="text" name="id" id="id" hidden>
                        @error('password')
                            <span style="color:red;">{{$message}}</span>
                        @enderror

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4cd">Repeat your
                                    password</label>
                                <input readonly type="password" id="conpassword" name="conformpassword"
                                    class="form-control" />
                                <i class="fa-solid fa-eye" id="conformpasswordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordhidden()"></i>
                            </div>
                        </div>
                        @error('conformpassword')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <form action="/adminlogout" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <button type="button" class="btn btn-info" onclick="datashow()">Can Change</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="update()">Save Change</button>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        function update() {
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
                        console.error("Error:", e);
                    }
                });
            });
        }

        function datashow() {
            $("#name").removeAttr('readonly');
            $("#phone").removeAttr('readonly');
            $("#address").removeAttr('readonly');
            $("#city").removeAttr('readonly');
            $("#state").removeAttr('readonly');
            $("#country").removeAttr('readonly');
            $("#pincode").removeAttr('readonly');
            $("#email").removeAttr('readonly');
            $("#password").removeAttr('readonly');
            $("#conpassword").removeAttr('readonly');

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

        $(document).ready(function () {

            $.ajax({
                type: 'GET',
                url: "/adminruser",
                data: { adminname: "{{session('adminname')}}" },
                success: function (res) {
                    console.log("Response:", res);
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
        });

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