@extends('index')

@section('content')
@if (isset($successupdate))
<div class="alert alert-success" role="alert">
    Password Successfully Change
</div>
@endif
<form method="post" style="padding: 10px 368px;">
    @csrf
    <h3 style="margin-bottom: 15px;">Change Password</h3>
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">

            <label class="form-label" for="form3Example4c">Old Password </label>
            <input type="password" id="oldpassword" name="oldpassword" class="form-control" value="{{old('oldpassword')}}" />
            <i class="fa-solid fa-eye" id="oldpasswordshow" style="position:absolute;top: 62%;right: 5%;" onclick="oldpasswordshow()"></i>
            <i class="fa-solid fa-eye-slash" hidden id="oldpasswordhidden" style="position:absolute;top: 62%;right: 5%;" onclick="oldpasswordhidden()"></i>

        </div>
    </div>
    @if (session("passworderror"))
    <div class="text-danger">{{session("passworderror")}}</div><br>
    @endif
    @error('oldpassword')
    <div class="text-danger">{{$message}}</div><br>
    @enderror

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
            <label class="form-label" for="form3Example4c">New Password </label>
            <input type="password" id="newpassword" name="newpassword" class="form-control" value="{{old('newpassword')}}" />
            <i class="fa-solid fa-eye" id="newpasswordshow" style="position:absolute;top: 62%;right: 5%;" onclick="newpasswordshow()"></i>
            <i class="fa-solid fa-eye-slash" hidden id="newpasswordhidden" style="position:absolute;top: 62%;right: 5%;" onclick="newpasswordhidden()"></i>
        </div>
    </div>
    @error('newpassword')
    <div class="text-danger">{{$message}}</div><br>
    @enderror

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
            <label class="form-label" for="form3Example4c">Conform Password </label>
            <input type="password" id="confpassword" name="confpassword" class="form-control" value="{{old('confpassword')}}" />
            <i class="fa-solid fa-eye" id="confpasswordshow" style="position:absolute;top: 62%;right: 5%;" onclick="confpasswordshow()"></i>
            <i class="fa-solid fa-eye-slash" hidden id="confpasswordhidden" style="position:absolute;top: 62%;right: 5%;" onclick="confpasswordhidden()"></i>
        </div>
    </div>
    @error('confpassword')
    <div class="text-danger">{{$message}}</div><br>
    @enderror

    <input type="submit" class="btn btn-primary" value="Change Password">
</form>


<script>
    // old password 
    function oldpasswordshow() {
        $("#oldpasswordhidden").removeAttr("hidden");
        $("#oldpasswordshow").attr("hidden", true);
        document.getElementById('oldpassword').type = 'text';
    }

    function oldpasswordhidden() {
        $("#oldpasswordshow").removeAttr("hidden");
        $("#oldpasswordhidden").attr('hidden', true);
        document.getElementById('oldpassword').type = 'password';
    }

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
