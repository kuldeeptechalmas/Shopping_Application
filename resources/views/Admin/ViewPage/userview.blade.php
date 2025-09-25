<form class="mx-1 mx-md-4" method="post" action="/adminviewupdate">
    @csrf
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Your Name</label>
            <input type="text" id="vname" value="{{$data->name}}" name='name' class="form-control" />

            <div style="color:red;" id="enames" hidden></div>

        </div>
    </div>
    <input type="text" name="id" value="{{$data->id}}" hidden id="">
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Phone No</label>
            <input type="text" id="vphone" value="{{$data->phone}}" name="phone" class="form-control" />

            <div style="color:red;" id="ephone" hidden></div>

        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Gender</label>
            <input type="radio" id="gender1" value="male" name="gender" {{$data->gender == 'male'
    ? 'checked' : '' }}>Male</input>
            <input type="radio" id="gender2" value="female" name="gender" {{$data->gender == 'female'
    ? 'checked' : '' }}>Female</input>

            <div style="color:red;" id="egender" hidden></div>

        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Address</label>
            <input type="text" id="vaddress" value="{{$data->address}}" name="address" class="form-control" />
            <div style="color:red;" id="eaddress" hidden></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Country</label>

            <select class="form-select" id="vcountry" value="{{$data->country}}" name="country">
                @if (isset($country))
                    @foreach ($country as $item)
                        <option value="{{$item["id"]}}" {{$item["id"] == $data->country ? "selected" : ''}}>{{$item["name"]}}
                        </option>
                    @endforeach
                @endif
            </select>
            <div style="color:red;" hidden id="ecountry"></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="state">State</label>
            <select class="form-select" id="vstate" name="state">

            </select>
            <div style="color:red;" hidden id="estate"></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">City</label>
            <select placeholder="Select" class="form-select" id="vcity" value="{{$data->city}}" name="city">
            </select>
            <div style="color:red;" hidden id="ecity"></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Pincode</label>
            <input type="text" id="vpincode" value="{{$data->pincode}}" name="pincode" class="form-control" />
            <div style="color:red;" id="epincode" hidden></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example3c">Your Email</label>
            <input type="text" id="vemail" value="{{$data->email}}" name="email" class="form-control" />
            <div style="color:red;" hidden id="eemails"></div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>

<script>

    var oldstate = "{{$data->state}}";

    $.ajax({
        type: "get",
        url: "/getstate",
        data: {
            data: "{{$data->country}}",
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

    var oldcity = "{{$data->city}}";
    $.ajax({
        type: "get",
        url: "/getcity",
        data: {
            data: "{{$data->state}}",
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