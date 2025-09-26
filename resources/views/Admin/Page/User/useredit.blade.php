@extends('Admin.index')

@section('content')

    <div class="d-flex justify-content-center" style="height: 62px;text-align: center;margin-top: 16px;">
        <h3
            style="width: 192px;border: solid;border-radius: 27px;align-items: center;display: flex;justify-content: center;">
            Edit User</h3>
    </div>
    <form class="mx-1 mx-md-4" method="post" action="{{ route("admindashboard") }}" style="padding: 10px 169px;">
        @csrf

        <input type="text" name="action" hidden value="editUserData">

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Your Name</label>
                <input type="text" id="vname" value="{{$usereditdata->name}}" name='name' class="form-control" />

                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['name'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['name'][0] }}</div>

                    @endif
                @endif

            </div>
        </div>
        <input type="text" name="id" value="{{$usereditdata->id}}" hidden id="">
        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Phone No</label>
                <input type="text" id="vphone" value="{{$usereditdata->phone}}" name="phone" class="form-control" />
                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['phone'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['phone'][0] }}</div>

                    @endif
                @endif

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Gender</label>
                <input type="radio" id="gender1" value="male" name="gender" {{$usereditdata->gender == 'male'
        ? 'checked' : '' }}>Male</input>
                <input type="radio" id="gender2" value="female" name="gender" {{$usereditdata->gender == 'female'
        ? 'checked' : '' }}>Female</input>

                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['gender'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['gender'][0] }}</div>

                    @endif
                @endif

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Address</label>
                <input type="text" id="vaddress" value="{{$usereditdata->address}}" name="address" class="form-control" />

                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['address'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['address'][0] }}</div>

                    @endif
                @endif
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

                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['country'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['country'][0] }}</div>

                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="state">State</label>
                <select class="form-select" id="vstate" name="state">

                </select>

                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['state'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['state'][0] }}</div>

                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">City</label>
                <select placeholder="Select" class="form-select" id="vcity" value="{{$usereditdata->city}}" name="city">
                </select>
                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['city'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['city'][0] }}</div>

                    @endif
                @endif
            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example1c">Pincode</label>
                <input type="text" id="vpincode" value="{{$usereditdata->pincode}}" name="pincode" class="form-control" />
                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['pincode'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['pincode'][0] }}</div>

                    @endif
                @endif

            </div>
        </div>

        <div class="d-flex flex-row align-items-center mb-4">
            <div usereditdata-mdb-input-init class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example3c">Your Email</label>
                <input type="text" id="vemail" value="{{$usereditdata->email}}" name="email" class="form-control" />
                @if (isset($validator))
                    @if (isset($validator->errors()->messages()['email'][0]))
                        <div class="alert alert-danger">{{ $validator->errors()->messages()['email'][0] }}</div>

                    @endif
                @endif
            </div>
        </div>

        <div class="modal-footer" style="padding: 11px 20px 55px 10px;">
            <div style="margin-right: 32px;">
                <a href="/AdminInUser">
                    <button type="button" class="btn btn-secondary" usereditdata-bs-dismiss="modal">Back</button>
                </a>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>


@endsection

@push("script_content")

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        // get state and city use Ajax
        var oldstate = "{{$usereditdata->state}}";

        $.ajax({
            type: "get",
            url: "/getstate",
            data: {
                data: "{{ $usereditdata->country }}",
            },
            success: function (res) {
                console.log(res);

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
            data: {
                data: "{{$usereditdata->state}}",
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
@endpush