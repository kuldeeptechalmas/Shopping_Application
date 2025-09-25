@extends('Admin.index')

@section('content')
    <form class="mx-1 mx-md-4" method="post" action="/adminviewupdate">
        @csrf
        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Your Name</label>
                <input type="text" id="vname" value="{{$usereditdata->name}}" name='name' class="form-control" />

                <div style="color:red;" id="enames" hidden></div>

            </div>
        </div>
        <input type="text" name="id" value="{{$usereditdata->id}}" hidden id="">
        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Phone No</label>
                <input type="text" id="vphone" value="{{$usereditdata->phone}}" name="phone" class="form-control" />

                <div style="color:red;" id="ephone" hidden></div>

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Gender</label>
                <input type="radio" id="gender1" value="male" name="gender" {{$usereditdata->gender == 'male'
        ? 'checked' : '' }}>Male</input>
                <input type="radio" id="gender2" value="female" name="gender" {{$usereditdata->gender == 'female'
        ? 'checked' : '' }}>Female</input>

                <div style="color:red;" id="egender" hidden></div>

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Address</label>
                <input type="text" id="vaddress" value="{{$usereditdata->address}}" name="address" class="form-control" />
                <div style="color:red;" id="eaddress" hidden></div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Country</label>

                <select class="form-select" id="vcountry" value="{{$usereditdata->country}}" name="country">
                    @if (isset($country))
                        @foreach ($country as $item)
                            <option value="{{$item["id"]}}" {{$item["id"] == $usereditdata->country ? "selected" : ''}}>
                                {{$item["name"]}}
                            </option>
                        @endforeach
                    @endif
                </select>
                <div style="color:red;" hidden id="ecountry"></div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="state">State</label>
                <select class="form-select" id="vstate" name="state">

                </select>
                <div style="color:red;" hidden id="estate"></div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">City</label>
                <select placeholder="Select" class="form-select" id="vcity" value="{{$usereditdata->city}}" name="city">
                </select>
                <div style="color:red;" hidden id="ecity"></div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Pincode</label>
                <input type="text" id="vpincode" value="{{$usereditdata->pincode}}" name="pincode" class="form-control" />
                <div style="color:red;" id="epincode" hidden></div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example3c">Your Email</label>
                <input type="text" id="vemail" value="{{$usereditdata->email}}" name="email" class="form-control" />
                <div style="color:red;" hidden id="eemails"></div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" usereditdata-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <script>

        var oldstate = "{{$usereditdata->state}}";

        $.ajax({
            type: "get",
            url: "/getstate",
            usereditdata: {
                usereditdata: "{{$usereditdata->country}}",
            },
            success: function (res) {

                $("#vstate").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function (indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                    $("#vstate").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                });
            },
            error: function (e) {
                console.log(e);

            },
        })

        var oldcity = "{{$usereditdata->city}}";
        $.ajax({
            type: "get",
            url: "/getcity",
            usereditdata: {
                usereditdata: "{{$usereditdata->state}}",
            },
            success: function (res) {

                $("#vcity").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function (indexInArray, valueOfElement) {
                    var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                    $("#vcity").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                });

            },
            error: function (e) {
                console.log(e);

            },
        })
    </script>

@endsection