@extends('Admin.index')

@section('content')
<h1 style="text-align: center">Admin Profile</h1>
<form class="mx-1 mx-md-4" method="post" action="{{ route('admin.Profile.Manage') }}" style="padding: 10px 168px;">
    @csrf
    <input type="text" name="action" value="editadmin" hidden id="">
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Your Name</label>
            <input type="text" value="{{$admin_profile->name}}" name='name' class="form-control" />

            <div style="color:red;" hidden id="ename"></div>

        </div>
    </div>

    <input type="text" name="id" value="{{ $admin_profile->id }}" hidden id="">

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example3c">Your Email</label>
            <input type="text" readonly value="{{$admin_profile->email}}" name="email" class="form-control" />
            <div style="color:red;" hidden id="eemail"></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
            <label class="form-label" for="form3Example4c">Password</label>
            <input type="password" name="password" id="password" value="{{$admin_profile->password}}" class="form-control" />
            <i class="fa-solid fa-eye" id="passwordshow" style="position:absolute;top: 62%;right: 5%;" onclick="passwordshow()"></i>
            <i class="fa-solid fa-eye-slash" hidden id="passwordhidden" style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
        </div>
    </div>

    <div style="color:red;" hidden id="epassword"></div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
            <label class="form-label" for="form3Example4cd">Repeat your
                password</label>
            <input type="password" name="conformpassword" id="conpassword" value="{{$admin_profile->password}}" class="form-control" />
            <i class="fa-solid fa-eye" id="conformpasswordshow" style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordshow()"></i>
            <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden" style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordhidden()"></i>
        </div>
    </div>

    <div style="color:red;" hidden id="econfpassword"></div>

    <div class="modal-footer" style="padding: 10px 20px 29px;">
        <a href="{{ route('admindashboard') }}">
            <button type="button" class="btn btn-secondary" style="margin-right: 32px;">back</button>
        </a>

        <input type="text" name="action" value="editOrderData" hidden>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
@endsection

@push('script_content')
<script>
    // password
    // done
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
    // done
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
@endpush
