@extends("Main.ForgetPassword.mainforgotpassword")

@section('content')
<form method="post" action="{{ route('forget.Password') }}">
    @csrf
    <h1 style="color: hsl(217.5deg 40.82% 19.22%)">Forgot Password</h1>
    <br>
    <br>

    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="form3Example3">Email address</label>
        <input type="text" name="email" value="{{old('email')}}" id="form3Example3" class="form-control" />
    </div>


    @if (session("emailerror"))
    <div style="color: red;">{{session("emailerror")}}</div><br>
    @endif
    @error('email')
    <div style="color: red;">{{$message}}</div><br>
    @enderror

    <!-- Submit button -->
    <div data-mdb-input-init class="form-outline mb-4" style="text-align: center;">
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
            Verify Email
        </button>
    </div>

</form>
@endsection
