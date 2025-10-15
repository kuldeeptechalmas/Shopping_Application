$(document).ready(function() {
        var oldcountry = "{{$shopkeeper_profile->country}}";
        if (oldcountry) {
            var oldstate = "{{$shopkeeper_profile->state}}";
            const selectElement = $('#upstate');
            selectElement.empty();
            $.ajax({
                type: "get"
                , url: "/getstate"
                , data: {
                    data: $('#upcountry').val()
                , }
                , success: function(res) {
                    $("#upstate").append(`<option value="">Select</option>`);
                    $.each(res["statelist"], function(indexInArray, valueOfElement) {
                        var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                        $("#upstate").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                    });
                }
                , error: function(e) {
                    console.log(e);
                }
            , })
            if (oldstate) {
                var oldcity = "{{$shopkeeper_profile->city}}";
                const selectElement = $('#upcity');
                selectElement.empty();
                $.ajax({
                    type: "get"
                    , url: "/getcity"
                    , data: {
                        data: oldstate
                    , }
                    , success: function(res) {
                        $("#upcity").append(`<option value="">Select</option>`);
                        $.each(res["citylist"], function(indexInArray, valueOfElement) {
                            var selectcity = (oldcity == valueOfElement["id"]) ? "selected" : "";
                            $("#upcity").append(`<option value="${valueOfElement["id"]}" ${selectcity}>${valueOfElement["name"]}</option>`);

                        });
                    }
                    , error: function(e) {
                        console.log(e);
                    }
                , })
            }
        }
    })

    function getprofileuser(email) {
        $.ajax({
            url: "/viewprofile/" + email
            , type: "get"
            , success: function(res) {

                $("#userprofilebody").html(res);

            }
            , error: function(e) {
                console.log(e);

            }
        })

    }

    function update() {
        $("#ename").attr("hidden", true);
        $("#estate").attr("hidden", true);
        $("#epincode").attr("hidden", true);
        $("#ephone").attr("hidden", true);
        $("#epassword").attr("hidden", true);
        $("#eemail").attr("hidden", true);
        $("#ecountry").attr("hidden", true);
        $("#econpassword").attr("hidden", true);
        $("#ecity").attr("hidden", true);
        $("#egender").attr("hidden", true);
        $("#eaddress").attr("hidden", true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post'
            , url: "/shopkeeperupdate"
            , data: {
                id: $('#id').val()
                , name: $('#name').val()
                , phone: $('#phone').val()
                , email: $('#email').val()
                , address: $('#address').val()
                , gender: $('input[name="gender"]:checked').val()
                , city: $('#city').val()
                , state: $('#state').val()
                , country: $('#country').val()
                , pincode: $('#pincode').val()
                , password: $('#password').val()
                , conformpassword: $('#conpassword').val()
            }
            , success: function(res) {
                window.location.href = res['redirect_url'];
                $("#profilemodel").modal("hide");
            }
            , error: function(e) {
                const data = e['responseJSON']['errors'];
                console.log(data);

                if (data['name']) {
                    $("#ename").text(data['name'][0]).removeAttr("hidden");
                }
                if (data['gender']) {
                    $("#egender").text(data['gender'][0]).removeAttr("hidden");
                }
                if (data['address']) {
                    $("#eaddress").text(data['address'][0]).removeAttr("hidden");
                }
                if (data['city']) {
                    $("#ecity").text(data['city'][0]).removeAttr("hidden");
                }
                if (data['conformpassword']) {
                    $("#econpassword").text(data['conformpassword'][0]).removeAttr("hidden");
                }
                if (data['country']) {
                    $("#ecountry").text(data['country'][0]).removeAttr("hidden");
                }
                if (data['email']) {
                    $("#eemail").text(data['email'][0]).removeAttr("hidden");
                }
                if (data['password']) {
                    $("#epassword").text(data['password'][0]).removeAttr("hidden");
                }
                if (data['phone']) {
                    $("#ephone").text(data['phone'][0]).removeAttr("hidden");
                }
                if (data['pincode']) {
                    $("#epincode").text(data['pincode'][0]).removeAttr("hidden");
                }
                if (data['state']) {
                    $("#estate").text(data['state'][0]).removeAttr("hidden");
                }
            }
        });
    }
