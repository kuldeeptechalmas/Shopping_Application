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
    <title>Login</title>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom" style="margin-top: 7%;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <h2 id="rolesname">Sign in </h2> 
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0"></p>
                        </div>

                        <input type="text" name="rols" id="roles" hidden>

                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input type="email" name="email" id="form3Example3" value="{{old('email')}}"
                                class="form-control form-control-lg" placeholder="Enter a valid email address" />
                        </div>

                        @error('email')
                            <div style="color:red;">{{$message}}</div><br>
                        @enderror

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-3" style="position: relative;">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" name="password" id="password" value="{{old('password')}}"
                                class="form-control form-control-lg" placeholder="Enter password" />
                            <i class="fa-solid fa-eye" id="passwordshow" style="position:absolute;top: 62%;right: 5%;"
                                onclick="passwordshow()"></i>
                            <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                                style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
                        </div>

                        @error('password')
                            <div style="color:red;">{{$message}}</div><br>
                        @enderror

                        @if (session("passworderror"))
                            <div style="color:red;">{{session("passworderror")}}</div><br>
                        @endif

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="form-check mb-0">
                                <label class="form-check-label" for="form2Example3" style="color: red">
                                    @if (session('notfound'))
                                        {{session('notfound')}}
                                    @endif
                                </label>
                            </div>
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a
                                    href="/CustomerRegistration" class="link-danger">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <script>
        document.getElementById("roles").value=sessionStorage.getItem("role");
        document.getElementById("rolesname").textContent=document.getElementById("rolesname").textContent+sessionStorage.getItem("role");
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
    </script>
</body>

</html>