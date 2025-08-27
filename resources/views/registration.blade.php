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

    <!-- jQuery (Select2 requires jQuery) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4" id="rolesname">Sign up </p>

                                    <form class="mx-1 mx-md-4" method="post" action="/registration">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Your Name</label>
                                                <input type="text" id="form3Example1c" value="{{old('name')}}"
                                                    name='name' class="form-control" />
                                                @error('name')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="text" name="rols" id="roles" hidden>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Phone No</label>
                                                <input type="text" id="form3Example1c" value="{{old('phone')}}"
                                                    name="phone" class="form-control" />
                                                @error('phone')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Gender</label>
                                                <input type="radio" id="form3Example1c" value="male"
                                                    {{old('gender') == 'male' ? 'checked' : '' }} name="gender" />Male
                                                <input type="radio" id="form3Example1c" value="female"
                                                    {{old('gender') == 'female' ? 'checked' : '' }} name="gender" />Female
                                                @error('gender')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Country</label>
                                                <select onchange="findstate()" class="form-select" id="country"
                                                    value="{{old('country')}}" name="country">
                                                    <option></option>
                                                    @if (isset($contrylist))
                                                        @foreach ($contrylist as $item)
                                                            <option value={{$item['id']}} {{old('country') == $item['id'] ? 'selected' : ''}}>{{$item['name']}}</option>
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
                                                <select onchange="findcity()" class="form-select" id="state"
                                                    value="{{old('state')}}" name="state">
                                                </select>
                                                @error('state')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">City</label>
                                                <select placeholder="Select" class="form-select" id="city"
                                                    value="{{old('city')}}" name="city">
                                                </select>
                                                @error('city')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Address</label>
                                                <input type="text" id="form3Example1c" value="{{old('address')}}"
                                                    name="address" class="form-control" />
                                                @error('address')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Pincode</label>
                                                <input type="text" id="form3Example1c" value="{{old('pincode')}}"
                                                    name="pincode" class="form-control" />
                                                @error('pincode')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Your Email</label>
                                                <input type="text" id="form3Example3c" value="{{old('email')}}"
                                                    name="email" class="form-control" />
                                                @error('email')
                                                    <div style="color:red;">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0"
                                                style="position: relative;">
                                                <label class="form-label" for="form3Example4c">Password</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" />
                                                <i class="fa-solid fa-eye" id="passwordshow"
                                                    style="position:absolute;top: 62%;right: 5%;"
                                                    onclick="passwordshow()"></i>
                                                <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                                                    style="position:absolute;top: 62%;right: 5%;"
                                                    onclick="passwordhidden()"></i>
                                            </div>
                                        </div>

                                        @error('password')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div data-mdb-input-init class="form-outline flex-fill mb-0"
                                                style="position: relative;">
                                                <label class="form-label" for="form3Example4cd">Repeat your
                                                    password</label>
                                                <input type="password" id="conpassword" name="conformpassword"
                                                    class="form-control" />
                                                <i class="fa-solid fa-eye" id="conformpasswordshow"
                                                    style="position:absolute;top: 62%;right: 5%;"
                                                    onclick="conformpasswordshow()"></i>
                                                <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden"
                                                    style="position:absolute;top: 62%;right: 5%;"
                                                    onclick="conformpasswordhidden()"></i>
                                            </div>
                                        </div>
                                        @error('conformpassword')
                                            <span style="color:red;">{{$message}}</span>
                                        @enderror

                                        <div class="form-check d-flex justify-content-center mb-5">

                                            <label class="form-check-label" for="form2Example3">
                                                You have an account <a href="/login">Login In</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        document.getElementById("roles").value = sessionStorage.getItem("role");
        document.getElementById("rolesname").textContent = document.getElementById("rolesname").textContent + sessionStorage.getItem("role");

        $(document).ready(function () {
            $('#country').select2();
            $('#state').select2();
            $('#city').select2();
        });

        function findcity() {
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
                    $("#city").append(`<option value=""></option>`);
                    $.each(res["citylist"], function (indexInArray, valueOfElement) {
                        console.log(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);
                        $("#city").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);

                    });

                },
                error: function (e) {
                    console.log(e);

                },
            })
        }

        function findstate() {
            const selectElement = $('#state');
            selectElement.empty();
            $.ajax({
                type: "get",
                url: "/getstate",
                data: {
                    data: $('#country').val(),
                },
                success: function (res) {

                    $("#state").append(`<option value=""></option>`);
                    $.each(res["statelist"], function (indexInArray, valueOfElement) {
                        console.log(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);
                        $("#state").append(`<option value="${valueOfElement["id"]}">   ${valueOfElement["name"]}</option>`);
                    });
                },
                error: function (e) {
                    console.log(e);

                },
            })
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
    </script>
</body>

</html>