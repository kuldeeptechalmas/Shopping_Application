<form class="mx-1 mx-md-4" method="post">
    @csrf
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Your Name</label>
            <input type="text" id="name" value="{{$data->name}}" name='name' class="form-control" />
            <div style="color:red;" id="ename" hidden></div>
        </div>
    </div>
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Phone No</label>
            <input type="text" id="phone" value="{{$data->phone}}" name="phone" class="form-control" />

            <div style="color:red;" id="ephone" hidden></div>

        </div>
    </div>
    </div>
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Gender :</label><br> <input type="radio" id="gender1"
                value="male" name="gender" {{$data->gender == 'male' ? 'checked' : '' }} />Male
            <input type="radio" id="gender2" value="female" name="gender" {{$data->gender == 'female' ? 'checked' : '' }} />Female
            <div style="color:red;" id="egender" hidden></div>

        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Address : </label>
            <input type="text" id="address" value="{{$data->address}}" name="address" class="form-control" />
            <div style="color:red;" id="eaddress" hidden></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Country</label>
            <select class="form-select" id="country" value="{{old('country')}}" name="country">
                <option>Select</option>
                @if (isset($contrylist))
                    @foreach ($contrylist as $item)
                        <option value={{$item['id']}} {{$data->country == $item['id'] ? 'selected' : ''}}>
                            {{$item['name']}}</option>
                    @endforeach
                @endif
            </select>
            @error('country')
                <div style="color:red;">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="state">State</label>
            <select class="form-select" id="state" value="{{$data->state}}" name="state">
                <option>Select</option>
            </select>
            @error('state')
                <div style="color:red;">{{$message}}</div>
            @enderror
        </div>
    </div>

    <input type="text" name="id" id="id" hidden value="{{$data->id}}">

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">City</label>
            <select placeholder="Select" class="form-select" id="city" value="{{$data->city}}" name="city">
                <option>Select</option>
            </select>
            @error('city')
                <div style="color:red;">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example1c">Pincode</label>
            <input type="text" id="pincode" value="{{$data->pincode}}" name="pincode" class="form-control" />
            <div style="color:red;" id="epincode" hidden></div>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
        <div data-mdb-input-init class="form-outline flex-fill mb-0">
            <label class="form-label" for="form3Example3c">Your Email</label>
            <input type="text" id="email" value="{{$data->email}}" name="email" class="form-control" />
            <div style="color:red;" id="eemail" hidden></div>
        </div>
    </div>
</form>
<script>
    var oldcountry = "{{$data->country}}";
    if (oldcountry) {
        var oldstate = "{{$data->state}}";
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
            var oldcity = "{{$data->city}}";
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
</script>