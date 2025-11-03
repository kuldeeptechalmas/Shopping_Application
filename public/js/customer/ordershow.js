$(document).ready(function() {
        $(".star").click(function() {
            var rating = $(this).data("value");
            var product_id = $(this).data("pid");

            var productstars = $("i[data-pid='" + product_id + "']");

            productstars.removeClass("active");
            productstars.each(function() {
                if ($(this).data("value") <= rating) {
                    $(this).addClass("active");
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post"
                , url: "/OrderRating"
                , data: {
                    product_id: product_id
                    , rate: rating
                }
                , success: function(res) {
                    document.getElementById("ratingsStar").textContent=res['rateConversion'];
                    document.getElementById("ratingsUser").textContent=res['totalPeopel']+" Ratings";
                    
                }
                , error: function(e) {
                    console.log(e);
                }
            });
        });
    });


    function deleteorder(orderId) {
        $('#orderId').val(orderId);
    }