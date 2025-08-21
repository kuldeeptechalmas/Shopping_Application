<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black" style="margin-left: 32%;">

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST">
                            @csrf
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in Admin</h3>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Email address</label>
                                <input type="email" id="form2Example18" value="{{old('email')}}" name="email" class="form-control form-control-lg" />
                            @error('email')
                                <div style="color: red;">{{$message}}</div>
                            @enderror
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label"  for="form2Example28">Password</label>
                                <input type="password" name="password" value="{{old('password')}}"  class="form-control form-control-lg" />
                            @error('password')
                                <div style="color: red;">{{$message}}</div>
                            @enderror
                            </div>

                            @if(session('error'))
                                <div style="color: red;">{{session('error')}}</div>
                            @endif

                            <div class="pt-1 mb-4">
                                <button style="width: 368px;margin-top: 6%;" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block"
                                    type="submit">Login</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>