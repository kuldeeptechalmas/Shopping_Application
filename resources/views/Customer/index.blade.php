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
                                <input  type="text" id="name" value="{{old('name')}}" name='name'
                                    class="form-control" />

                                <div style="color:red;" id="ename" hidden></div>

                            </div>
                        </div>

                        <input type="text" name="rols" id="roles" hidden>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Phone No</label>
                                <input  type="text" id="phone" value="{{old('phone')}}" name="phone"
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
                                <input  type="text" id="address" value="{{old('address')}}" name="address"
                                    class="form-control" />
                                <div style="color:red;" id="eaddress" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">City</label>
                                <input  type="text" id="city" value="{{old('city')}}" name="city"
                                    class="form-control" />
                                <div style="color:red;" id="ecity" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">State</label>
                                <input  type="text" id="state" value="{{old('state')}}" name="state"
                                    class="form-control" />
                                <div style="color:red;" id="estate" hidden></div>
                            </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Country</label>
                                {{-- <input   type="text" id="country" value="{{old('country')}}" name="country"
                                    class="form-control" /> --}}

                                <select class="form-select" aria-label="Default select example"   id="country" value="{{old('country')}}" name="country">
                                    <option selected>Select</option>
                                    @if (isset($contrylist))
                                        @foreach ($contrylist as $item)
                                        <option value={{$item['name']}}>{{$item['name']}}</option>   
                                        @endforeach
                                    @endif
                                    
                                </select>

                                <div style="color:red;" id="ecountry" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example1c">Pincode</label>
                                <input   type="text" id="pincode" value="{{old('pincode')}}" name="pincode"
                                    class="form-control" />
                                <div style="color:red;" id="epincode" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label class="form-label" for="form3Example3c">Your Email</label>
                                <input   type="text" id="email" value="{{old('email')}}" name="email"
                                    class="form-control" />
                                <div style="color:red;" id="eemail" hidden></div>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                                <label class="form-label" for="form3Example4c">Password</label>
                                <input   type="password" id="password" name="password" class="form-control" />
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
                                <input   type="password" id="conpassword" name="conformpassword"
                                    class="form-control" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>


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

        function getuserprofiledata()
        {

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

            $.ajax({
                type: 'GET',
                url: "/customeruser",
                data: { customeremail: "{{session('customeremail')}}" },
                success: function (res) {
                    document.getElementById('name').value = res['name'];
                    document.getElementById('phone').value = res['phone'];
                    document.getElementById('email').value = res['email'];
                    document.getElementById('pincode').value = res['pincode'];
                    document.getElementById('country').value = res['country'];
                    document.getElementById('state').value = res['state'];
                    document.getElementById('city').value = res['city'];
                    document.getElementById('address').value = res['address'];
                    document.getElementById('password').value = res['password'];
                    document.getElementById('conpassword').value = res['password'];
                    if (res['gender'] == "male") {
                        document.getElementById('gender1').checked = true;
                    }
                    else {
                        document.getElementById('gender2').checked = true;
                    }

                    document.getElementById('id').value = res['id'];
                },
                error: function (e) {
                    console.error("Error:", e);
                }
            });
        }
    </script>

</body>

</html>