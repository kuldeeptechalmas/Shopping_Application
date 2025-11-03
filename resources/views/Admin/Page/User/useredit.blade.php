@extends('Admin.index')

@section('content')

<div class="d-flex justify-content-center" style="height: 62px;text-align: center;margin-top: 16px;">
    <h3 style="width: 192px;border: solid;border-radius: 27px;align-items: center;display: flex;justify-content: center;">
        Edit User</h3>
</div>
@if (isset($save))
@toastifyCss
{{ toastify() -> success('Save Successfully !') }}
@toastifyJs
@endif
<form class="mx-1 mx-md-4" method="post" action="/AdminInUserUpdate/{{ $usereditdata->id }}" style="padding: 10px 169px;">
    @csrf

    <input type="text" name="action" hidden value="editUserData">

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Your Name</label>
            <input type="text" id="vname" value="{{old('name',$usereditdata->name)}}" name='name' class="form-control" />

            @error('name')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <input type="text" name="id" value="{{$usereditdata->id}}" hidden id="">

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
            <select class="form-select" name="countrycode" id="countrycode" style="width: 15%;position: absolute;top: 32px;">
                @foreach ($countrycode as $item)
                <option value="{{ $item['countryCode'] }}" {{old("countrycode",$usereditdata->countrycode) == $item['countryCode'] ? 'selected' : ''}}>{{ $item['Iso'] }}({{ $item['name'] }})</option>
                @endforeach
            </select>
            <label class="form-label" for="form3Example1c">Phone No</label>
            <input type="text" id="phone" value="{{old("phone",$usereditdata->phone)}}" style="padding-left:95px;" name="phone" class="form-control" />

            @error('phone')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
    </div>
    {{-- <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Phone No</label>
            <input type="text" id="vphone" value="{{old('phone',$usereditdata->phone)}}" name="phone" class="form-control" />
    @error('phone')

    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </div>
    </div> --}}

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Gender</label>
            <input type="radio" id="gender1" value="male" name="gender" {{old('gender',$usereditdata->gender) == 'male'
        ? 'checked' : '' }}>Male</input>
            <input type="radio" id="gender2" value="female" name="gender" {{old('gender',$usereditdata->gender) == 'female'
        ? 'checked' : '' }}>Female</input>

            @error('gender')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Address</label>
            <input type="text" id="vaddress" value="{{old('address',$usereditdata->address)}}" name="address" class="form-control" />

            @error('address')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Country</label>

            <select class="form-select" id="vcountry" value="{{old('country',$usereditdata->country)}}" name="country">
                <option value="">Select</option>
                @if (isset($country))
                @foreach ($country as $item)
                <option value="{{$item["id"]}}" {{old("country",$item["id"])== $usereditdata->country ? "selected" : ''}}>
                    {{$item["name"]}}
                </option>
                @endforeach
                @endif
            </select>

            @error('country')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="state">State</label>
            <select class="form-select" id="vstate" name="state">

            </select>

            @error('state')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">City</label>
            <select placeholder="Select" class="form-select" id="vcity" value="{{old('city',$usereditdata->city)}}" name="city">
            </select>
            @error('city')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Pincode</label>
            <input type="text" id="vpincode" value="{{old('pincode',$usereditdata->pincode)}}" name="pincode" class="form-control" />
            @error('pincode')

            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example3c">Your Email</label>
            <input type="text" id="vemail" readonly value="{{$usereditdata->email}}" name="email" class="form-control" />

        </div>
    </div>

    <div class="modal-footer" style="padding: 11px 20px 55px 10px;">
        <div style="margin-right: 32px;">
            <a href="/AdminInUser">
                <button type="button" class="btn btn-secondary" usereditdata-bs-dismiss="modal">Back</button>
            </a>
        </div>
        <button type="submit" class="btn btn-primary">Save chang</button>
    </div>
</form>


@endsection

@push("script_content")

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // get state and city use Ajax
        var oldstate = "{{old('state',$usereditdata->state)}}";
        console.log(oldstate);

        $.ajax({
            type: "get"
            , url: "/getstate"
            , data: {
                data: "{{ $usereditdata->country }}"
            , }
            , success: function(res) {

                $("#vstate").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function(indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                    $("#vstate").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                });
            }
            , error: function(e) {
                console.log(e);

            }
        , })

        var oldcity = "{{old('city',$usereditdata->city)}}";

        $.ajax({
            type: "get"
            , url: "/getcity"
            , data: {
                data: "{{$usereditdata->state}}"
            , }
            , success: function(res) {

                $("#vcity").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function(indexInArray, valueOfElement) {
                    var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                    $("#vcity").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                });

            }
            , error: function(e) {
                console.log(e);

            }
        , })
    });

    $("#vcountry").on("change", function() {
        var oldstate = "{{$usereditdata->state}}";

        const selectElement = $('#vstate');
        selectElement.empty();

        $.ajax({
            type: "get"
            , url: "/getstate"
            , data: {
                data: document.getElementById("vcountry").value
            , }
            , success: function(res) {
                console.log(res);

                $("#vstate").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function(indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                    $("#vstate").append(`<option value="${valueOfElement["id"]}" >${valueOfElement["name"]}</option>`);
                });
            }
            , error: function(e) {
                console.log(e);

            }
        , })


    });


    $("#vstate").on("change", function() {

        var oldcity = "{{$usereditdata->city}}";
        const selectElement = $('#vcity');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getcity"
            , data: {
                data: document.getElementById("vstate").value
            , }
            , success: function(res) {

                $("#vcity").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function(indexInArray, valueOfElement) {
                    var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                    $("#vcity").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                });

            }
            , error: function(e) {
                console.log(e);

            }
        , })
    });

</script>
@endpush
