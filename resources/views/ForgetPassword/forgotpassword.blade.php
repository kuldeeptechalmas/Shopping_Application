@extends('ForgetPassword.emailvarify')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <form method="post" action="/forgetpasswords">
        @csrf
        <h1>Forgot Password</h1>
        <div class="d-flex flex-row align-items-center mb-4">
            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                <label class="form-label" for="form3Example4c">New Password </label>
                <input type="password" id="newpassword" name="newpassword" class="form-control"
                    value="{{old('newpassword')}}" />
                <i class="fa-solid fa-eye" id="newpasswordshow" style="position:absolute;top: 62%;right: 5%;"
                    onclick="newpasswordshow()"></i>
                <i class="fa-solid fa-eye-slash" hidden id="newpasswordhidden" style="position:absolute;top: 62%;right: 5%;"
                    onclick="newpasswordhidden()"></i>
            </div>
        </div>
        @error('newpassword')
            <div class="text-danger">{{$message}}</div><br>
        @enderror

        <div class="d-flex flex-row align-items-center mb-4">
            <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                <label class="form-label" for="form3Example4c">Conform Password </label>
                <input type="password" id="confpassword" name="confpassword" class="form-control"
                    value="{{old('confpassword')}}" />
                <i class="fa-solid fa-eye" id="confpasswordshow" style="position:absolute;top: 62%;right: 5%;"
                    onclick="confpasswordshow()"></i>
                <i class="fa-solid fa-eye-slash" hidden id="confpasswordhidden"
                    style="position:absolute;top: 62%;right: 5%;" onclick="confpasswordhidden()"></i>
            </div>
        </div>
        @error('confpassword')
            <div class="text-danger">{{$message}}</div><br>
        @enderror

        <div data-mdb-input-init class="form-outline mb-4" style="text-align: center;">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Change Password
            </button>
        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        // new password 
        function newpasswordshow() {
            $("#newpasswordhidden").removeAttr("hidden");
            $("#newpasswordshow").attr("hidden", true);
            document.getElementById('newpassword').type = 'text';
        }

        function newpasswordhidden() {
            $("#newpasswordshow").removeAttr("hidden");
            $("#newpasswordhidden").attr('hidden', true);
            document.getElementById('newpassword').type = 'password';
        }
        // conf password 
        function confpasswordshow() {
            $("#confpasswordhidden").removeAttr("hidden");
            $("#confpasswordshow").attr("hidden", true);
            document.getElementById('confpassword').type = 'text';
        }

        function confpasswordhidden() {
            $("#confpasswordshow").removeAttr("hidden");
            $("#confpasswordhidden").attr('hidden', true);
            document.getElementById('confpassword').type = 'password';
        }
    </script>
@endsection