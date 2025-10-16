 function DirectChangeInput(productId) {

        if ($("#quentity").val() == 0) {
            console.log("boom...");

            $("#quentity").val("");
        } else {

            if ($("#quentity").val() != "") {

                $.ajax({
                    type: "get"
                    , url: "/DirectChangeQuentity"
                    , data: {
                        product_id: productId
                        , queantity: $("#quentity").val()
                    , }
                    , success: function(res) {
                        console.log(res);

                        window.location.href = res.redirect_url;
                    }
                    , error: function(e) {
                        console.log(e);
                    }
                , });
            }
        }

    }

    function plus_quentity(e) {

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).next()[0].value
                , queantity: $(e).prev()[0].value
                , action: "plus"
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , });
    }

    function minus_quentity(e) {
        console.log($(e).prev()[0].value);

        $.ajax({
            type: "get"
            , url: "/addtocartqueantitychange"
            , data: {
                product_id: $(e).prev()[0].value
                , queantity: $(e).next()[0].value
                , action: "minus"
            , }
            , success: function(res) {
                window.location.href = res.redirect_url;
            }
            , error: function(e) {
                console.log(e);
            }
        , })
    }

    function Delete_AddToCart(cartId) {
        console.log(cartId);
        $('#cartId').val(cartId);
    }