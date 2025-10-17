function showpaymentdetail1() {
        $("#detail1").removeAttr("hidden");
        $("#detail2").attr("hidden", true);
        $("#detail3").attr("hidden", true);
    }

    function showpaymentdetail2() {
        $("#detail2").removeAttr("hidden");
        $("#detail1").attr("hidden", true);
        $("#detail3").attr("hidden", true);
    }

    function showpaymentdetail3() {
        $("#detail3").removeAttr("hidden");
        $("#detail2").attr("hidden", true);
        $("#detail1").attr("hidden", true);
    }

    $("#country").on("change", function() {
        console.log("boom");

        const selectElement = $('#state');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getstate"
            , data: {
                data: $('#country').val()
            , }
            , success: function(res) {

                var oldstate = "{{old('state')}}";
                console.log(oldstate);
                $("#state").append(`<option value="">Select</option>`);
                $.each(res["statelist"], function(indexInArray, valueOfElement) {
                    var selectstate = (oldstate == valueOfElement["id"]) ? "selected" : "";
                    console.log(selectstate);

                    $("#state").append(`<option value="${valueOfElement["id"]}" ${selectstate} >${valueOfElement["name"]}</option>`);
                });
            }
            , error: function(e) {
                console.log(e);

            }
        , });


    });

    $("#state").on("change", function() {
        const selectElement = $('#city');
        selectElement.empty();
        $.ajax({
            type: "get"
            , url: "/getcity"
            , data: {
                data: $('#state').val()
            , }
            , success: function(res) {
                $("#city").append(`<option value="">Select</option>`);
                $.each(res["citylist"], function(indexInArray, valueOfElement) {
                    $("#city").append(`<option value="${valueOfElement["id"]}">${valueOfElement["name"]}</option>`);

                });

            }
            , error: function(e) {
                console.log(e);

            }
        , });
    });