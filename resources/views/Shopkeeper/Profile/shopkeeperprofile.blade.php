@extends('Shopkeeper.index')

@section('content')

    <form class="mx-1 mx-md-4" method="post" action="/registration">
        @csrf
        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Your Name</label>
                        <input type="text" id="name" value="{{$shopkeeper_profile->name}}" name='name'
                            class="form-control" />

                        <div style="color:red;" id="ename" hidden></div>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Phone No</label>
                        <input type="text" id="phone" value="{{$shopkeeper_profile->phone}}" name="phone"
                            class="form-control" />

                        <div style="color:red;" id="ephone" hidden></div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Gender :</label><br> <input type="radio" id="gender1"
                            value="male" name="gender" {{$shopkeeper_profile->gender == 'male' ? 'checked' : '' }} />Male
                        <input type="radio" id="gender2" value="female" name="gender"
                            {{$shopkeeper_profile->gender == 'female' ? 'checked' : '' }} />Female
                        <div style="color:red;" id="egender" hidden></div>

                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Address : </label>
                        <input type="text" id="address" value="{{$shopkeeper_profile->address}}" name="address"
                            class="form-control" />
                        <div style="color:red;" id="eaddress" hidden></div>
                    </div>
                </div>
            </div>
        </div>

        <input type="text" name="rols" id="roles" hidden>

        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Country</label>
                        <select class="form-select" id="country" value="{{old('country')}}" name="country">
                            <option>Select</option>
                            @if (isset($contrylist))
                                @foreach ($contrylist as $item)
                                    <option value={{$item['id']}} {{$shopkeeper_profile->country == $item['id'] ? 'selected' : ''}}>
                                        {{$item['name']}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('country')
                            <div style="color:red;">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="state">State</label>
                        <select class="form-select" id="state" value="{{$shopkeeper_profile->state}}" name="state">
                            <option>Select</option>
                        </select>
                        @error('state')
                            <div style="color:red;">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">City</label>
                        <select placeholder="Select" class="form-select" id="city" value="{{$shopkeeper_profile->city}}"
                            name="city">
                            <option>Select</option>
                        </select>
                        @error('city')
                            <div style="color:red;">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example1c">Pincode</label>
                        <input type="text" id="pincode" value="{{$shopkeeper_profile->pincode}}" name="pincode"
                            class="form-control" />
                        <div style="color:red;" id="epincode" hidden></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="form3Example3c">Your Email</label>
                        <input type="text" id="email" value="{{$shopkeeper_profile->email}}" name="email"
                            class="form-control" />
                        <div style="color:red;" id="eemail" hidden></div>
                    </div>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>

        <div class="row justify-content-evenly">
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                        <label class="form-label" for="form3Example4c">Password</label>
                        <input type="password" id="password" name="password" value="{{$shopkeeper_profile->password}}"
                            class="form-control" />
                        <i class="fa-solid fa-eye" id="passwordshow" style="position:absolute;top: 62%;right: 5%;"
                            onclick="passwordshow()"></i>
                        <i class="fa-solid fa-eye-slash" hidden id="passwordhidden"
                            style="position:absolute;top: 62%;right: 5%;" onclick="passwordhidden()"></i>
                    </div>
                </div>
                <input type="text" name="id" id="id" hidden>
                <div style="color:red;" id="epassword" hidden></div>
            </div>
            <div class="col-4">
                <div class="d-flex flex-row align-items-center mb-4">
                    <div data-mdb-input-init class="form-outline flex-fill mb-0" style="position: relative;">
                        <label class="form-label" for="form3Example4cd">Repeat your
                            password</label>
                        <input type="password" id="conpassword" value="{{$shopkeeper_profile->password}}"
                            name="conformpassword" class="form-control" />
                        <i class="fa-solid fa-eye" id="conformpasswordshow" style="position:absolute;top: 62%;right: 5%;"
                            onclick="conformpasswordshow()"></i>
                        <i class="fa-solid fa-eye-slash" hidden id="conformpasswordhidden"
                            style="position:absolute;top: 62%;right: 5%;" onclick="conformpasswordhidden()"></i>
                    </div>
                </div>
                <div style="color:red;" id="econpassword" hidden></div>
            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            var oldcountry = "{{$shopkeeper_profile->country}}";
            if (oldcountry) {
                var oldstate = "{{$shopkeeper_profile->state}}";
                const selectElement = $('#state');
                selectElement.empty();
                $.ajax({
                    type: "get",
                    url: "/getstate",
                    data: {
                        data: $('#country').val(),
                    },
                    success: function (res) {
                        $("#state").append(`<option value="">Select</option>`);
                        $.each(res["statelist"], function (indexInArray, valueOfElement) {
                            var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                            $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                        });
                    },
                    error: function (e) {
                        console.log(e);
                    },
                })
                if (oldstate) {
                    var oldcity = "{{$shopkeeper_profile->city}}";
                    const selectElement = $('#city');
                    selectElement.empty();
                    $.ajax({
                        type: "get",
                        url: "/getcity",
                        data: {
                            data: oldstate,
                        },
                        success: function (res) {
                            $("#city").append(`<option value="">Select</option>`);
                            $.each(res["citylist"], function (indexInArray, valueOfElement) {
                                var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                                $("#city").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                            });
                        },
                        error: function (e) {
                            console.log(e);
                        },
                    })
                }
            }
        })

    </script>
@endsection