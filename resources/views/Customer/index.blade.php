<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>
</head>
<style>
    .modal-backdrop.show {
        opacity: 0.1 !important;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <div>
                        <h1><i class="fa-solid fa-circle-user" onclick="getuserprofiledata()" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i></h1>{{session('customerid')}}
                    </div>

                </form>
            </div>
        </div>
    </nav>


    <h1 style="margin-left: 36%;margin-top: 15%;">Welcome to Customer</h1>

    <!-- Update Profile Modal -->
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
                                <input type="text" id="name" value="{{old('name')}}" name='name' class="form-control" />

                                <div style="color:red;" id="ename" hidden></div>

                            </div>
                        </div>

                        <input type="text" name="rols" id="roles" hidden>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Phone No</label>
                                <input type="text" id="phone" value="{{old('phone')}}" name="phone"
                                    class="form-control" />

                                <div style="color:red;" id="ephone" hidden></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Gender</label>
                                <input type="radio" id="gender1" value="male" name="gender" {{old('gender') == 'male'
    ? 'checked' : '' }} />Male
                                <input type="radio" id="gender2" value="female" name="gender" {{old('gender') == 'female'
    ? 'checked' : '' }} />Female

                                <div style="color:red;" id="egender" hidden></div>

                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Address</label>
                                <input type="text" id="address" value="{{old('address')}}" name="address"
                                    class="form-control" />
                                <div style="color:red;" id="eaddress" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Country</label>
                                <select class="form-select" id="country" value="{{old('country')}}" name="country">
                                    <option>Select</option>
                                    @if (isset($contrylist))
                                        @foreach ($contrylist as $item)
                                            <option value={{$item['id']}} {{old('country') == $item['id'] ? 'selected' : ''}}>
                                                {{$item['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('country')
                                    <div style="color:red;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="state">State</label>
                                <select class="form-select" id="state" value="{{old('state')}}" name="state">
                                </select>
                                @error('state')
                                    <div style="color:red;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">City</label>
                                <select placeholder="Select" class="form-select" id="city" value="{{old('city')}}"
                                    name="city">
                                </select>
                                @error('city')
                                    <div style="color:red;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Pincode</label>
                                <input type="text" id="pincode" value="{{old('pincode')}}" name="pincode"
                                    class="form-control" />
                                <div style="color:red;" id="epincode" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input type="text" id="email" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                <div style="color:red;" id="eemail" hidden></div>
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
                        <input type="text" name="id" id="id" hidden>
                        <div style="color:red;" id="epassword" hidden></div>

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
                        <div style="color:red;" id="econpassword" hidden></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <form action="/logout" method="get">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="update()">Save Change</button>


                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- jQuery (Select2 requires jQuery) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function () {

        });

        $("#country").on("change", function () {
            const selectElement = $('#state');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getstate",
                data: {
                    data: $('#country').val(),
                },
                success: function (res) {
                    var oldstate = "{{old('state')}}";
                    console.log(oldstate);
                    $("#state").append(`<option value="">Select</option>`);
                    $.each(res["statelist"], function (indexInArray, valueOfElement) {
                        var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                        console.log(selectstate);

                        $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);

                },
            })
        });

        $("#state").on("change", function () {
            const selectElement = $('#city');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getcity",
                data: {
                    data: $('#state').val(),
                },
                success: function (res) {
                    console.log(res);
                    $("#city").append(`<option value="">Select</option>`);
                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                        $("#city").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);

                    });

                },
                error: function (e) {
                    console.log(e);

                },
            })
        });

        function update() {
            $("#ename").attr("hidden", true);
            $("#estate").attr("hidden", true);
            $("#epincode").attr("hidden", true);
            $("#ephone").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#eemail").attr("hidden", true);
            $("#ecountry").attr("hidden", true);
            $("#econpassword").attr("hidden", true);
            $("#ecity").attr("hidden", true);
            $("#egender").attr("hidden", true);
            $("#eaddress").attr("hidden", true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: "/customerupdate",
                data: {
                    id: $('#id').val(),
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    gender: $('input[name="gender"]:checked').val(),
                    city: $('#city').val(),
                    state: $('#state').val(),
                    country: $('#country').val(),
                    pincode: $('#pincode').val(),
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
                    if (data['gender']) {
                        $("#egender").text(data['gender'][0]).removeAttr("hidden");
                    }
                    if (data['address']) {
                        $("#eaddress").text(data['address'][0]).removeAttr("hidden");
                    }
                    if (data['city']) {
                        $("#ecity").text(data['city'][0]).removeAttr("hidden");
                    }
                    if (data['conformpassword']) {
                        $("#econpassword").text(data['conformpassword'][0]).removeAttr("hidden");
                    }
                    if (data['country']) {
                        $("#ecountry").text(data['country'][0]).removeAttr("hidden");
                    }
                    if (data['email']) {
                        $("#eemail").text(data['email'][0]).removeAttr("hidden");
                    }
                    if (data['password']) {
                        $("#epassword").text(data['password'][0]).removeAttr("hidden");
                    }
                    if (data['phone']) {
                        $("#ephone").text(data['phone'][0]).removeAttr("hidden");
                    }
                    if (data['pincode']) {
                        $("#epincode").text(data['pincode'][0]).removeAttr("hidden");
                    }
                    if (data['state']) {
                        $("#estate").text(data['state'][0]).removeAttr("hidden");
                    }
                }
            });
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

        function getuserprofiledata() {

            $("#ename").attr("hidden", true);
            $("#epincode").attr("hidden", true);
            $("#ephone").attr("hidden", true);
            $("#epassword").attr("hidden", true);
            $("#eemail").attr("hidden", true);
            $("#econpassword").attr("hidden", true);
            $("#egender").attr("hidden", true);
            $("#eaddress").attr("hidden", true);

            $("#ecountry").attr("hidden", true);
            $("#estate").attr("hidden", true);
            $("#ecity").attr("hidden", true);

            $.ajax({
                type: 'GET',
                url: "/customeruser",
                data: { customeremail: "{{session('customeremail')}}" },
                success: function (res) {

                    if (res['gender'] == "male") {
                        document.getElementById('gender1').checked = true;
                    }
                    else {
                        document.getElementById('gender2').checked = true;
                    }
                    document.getElementById('name').value = res['name'];
                    document.getElementById('phone').value = res['phone'];
                    document.getElementById('email').value = res['email'];
                    document.getElementById('pincode').value = res['pincode'];
                    document.getElementById('address').value = res['address'];
                    document.getElementById('password').value = res['password'];
                    document.getElementById('conpassword').value = res['password'];
                    document.getElementById('country').value = res['country'];
                    document.getElementById('id').value = res['id'];

                    var oldcountry = res['country'];

                    if (oldcountry) {
                        var oldstate = res['state'];
                        const selectElement = $('#state');
                        selectElement.empty();
                        $.ajax({
                            type: "get",
                            url: "/getstate",
                            data: {
                                data: $('#country').val(),
                            },
                            success: function (res) {
                                $("#state").append(`<option value="">Select</option>`);
                                $.each(res["statelist"], function (indexInArray, valueOfElement) {
                                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                                    $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                                });
                            },
                            error: function (e) {
                                console.log(e);

                            },
                        })
                        if (oldstate) {
                            var oldcity = res['city'];
                            const selectElement = $('#city');
                            selectElement.empty();
                            $.ajax({
                                type: "get",
                                url: "/getcity",
                                data: {
                                    data: oldstate,
                                },
                                success: function (res) {
                                    $("#city").append(`<option value="">Select</option>`);
                                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                                        var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                                        $("#city").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                                    });

                                },
                                error: function (e) {
                                    console.log(e);

                                },
                            })
                        }
                    }

                },
                error: function (e) {
                    console.error("Error:", e);
                }
            });
        }
    </script>

</body>

</html>