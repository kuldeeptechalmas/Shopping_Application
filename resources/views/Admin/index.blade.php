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
                        <h1><i class="fa-solid fa-circle-user" data-bs-toggle="modal" data-bs-target="#adminmodel"></i>
                        </h1>
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
                <div class="container-lg" id="customertable">

                </div>

                <div id="shopkeepertable" class="mt-3" style="display:none;">

                </div>
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
                                <input readonly type="text" id="name" value="{{old('name')}}" name='name'
                                    class="form-control" />

                                <div style="color:red;" hidden id="ename"></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input readonly type="text" id="email" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                <div style="color:red;" hidden id="eemail"></div>
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
                        <div style="color:red;" hidden id="epassword"></div>

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
                        <div style="color:red;" hidden id="econfpassword"></div>
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

    <!-- View Modal -->
    <div class="modal fade" id="viewmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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

                                <div style="color:red;" id="ename" hidden></div>

                            </div>
                        </div>

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
                                <label class="form-label" for="form3Example1c">City</label>
                                <input type="text" id="vcity" value="{{old('city')}}" name="city"
                                    class="form-control" />
                                <div style="color:red;" id="ecity" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">State</label>
                                <input type="text" id="vstate" value="{{old('state')}}" name="state"
                                    class="form-control" />
                                <div style="color:red;" id="estate" hidden></div>
                            </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Country</label>
                                <input type="text" id="vcountry" value="{{old('country')}}" name="country"
                                    class="form-control" />
                                <div style="color:red;" id="ecountry" hidden></div>
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
                                <div style="color:red;" id="eemail" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4c">Password</label>
                                <input type="password" id="vpassword" name="password" class="form-control" />
                                <i class="fa-solid fa-eye" id="passwordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
                            </div>
                        </div>
                        <input type="text" name="id" id="id" hidden>
                        <div style="color:red;" id="epassword" hidden></div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4cd">Repeat your
                                    password</label>
                                <input type="password" id="vconpassword" name="conformpassword" class="form-control" />
                                <i class="fa-solid fa-eye" id="conformpasswordshow"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordshow()"></i>
                                <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden"
                                    style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordhidden()"></i>
                            </div>
                        </div>
                        <div style="color:red;" id="econpassword" hidden></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

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
                        $.ajax({
                            type: "GET",
                            url: "admingetcustome",
                            success: function (res) {

                                $("#customertable").html(res);

                            },
                            error: function (e) {
                                console.log(e);

                            },
                        })

                        $.ajax({
                            type: "GET",
                            url: "admingetshopkeeper",
                            success: function (res) {
                                $("#shopkeepertable").html(res);

                            },
                            error: function (e) {
                                console.log(e);

                            },
                        })
                    }

                },
                error: function (e) {
                    console.log(e);
                },
            });
        }

        function viewdataname(name, phone, gender, address, city, state, country, pincode, email, password) {
            document.getElementById("vname").value = name;
            document.getElementById("vphone").value = phone;
            document.getElementById("vaddress").value = address;
            document.getElementById("vcity").value = city;
            document.getElementById("vstate").value = state;
            document.getElementById("vcountry").value = country;
            document.getElementById("vpincode").value = pincode;
            document.getElementById("vemail").value = email;
            document.getElementById("vpassword").value = password;
            document.getElementById("vconpassword").value = password;
            if (gender == "male") {
                document.getElementById('gender1').checked = true;
            }
            else {
                document.getElementById('gender2').checked = true;
            }
        }

        function deletedataname(name) {
            document.getElementById("deletename").textContent = name;
        }

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

        function datashow() {
            $("#name").removeAttr('readonly');
            $("#email").removeAttr('readonly');
            $("#password").removeAttr('readonly');
            $("#conpassword").removeAttr('readonly');

        }

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

        $(document).ready(function () {

            function admincustomer() {
                $.ajax({
                    type: "GET",
                    url: "admingetcustome",
                    success: function (res) {

                        $("#customertable").html(res);

                    },
                    error: function (e) {
                        console.log(e);

                    },
                })
            }

            function adminshopkeeper() {
                $.ajax({
                    type: "GET",
                    url: "admingetshopkeeper",
                    success: function (res) {
                        $("#shopkeepertable").html(res);

                    },
                    error: function (e) {
                        console.log(e);

                    },
                })
            }

            admincustomer();
            adminshopkeeper();

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

            $('#showCustomer').on('click', function () {
                $('#customertable').toggle();
                $('#shopkeepertable').css('display', 'none');

            });

            $('#showShopkeeper').on('click', function () {
                $('#shopkeepertable').toggle();
                $('#customertable').css('display', 'none');
            });
        });

    </script>
</body>

</html>