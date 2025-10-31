// index.blade.php to js
function favourite_product_data_save(rs, productid) {

    var element = $(rs)[0].style.color;

    if (element != "red") {
        $.ajax({
            url: "/favourite/" + productid
            , type: "get"
            , success: function(res) {
                if (res.url) {
                    window.location.href = res.url;
                } else {
                    $(rs)[0].style.color = "red";
                    toastify().success('Add to Wishlist !!!', {
                        position: 'center'
                    , });
                }

            }
            , error: function(e) {
                console.log(e);
            }
        })
    } else {
        $.ajax({
            url: "/removewishlist/" + productid
            , type: "get"
            , success: function(res) {
                if (res.url) {
                    window.location.href = res.url;
                } else {
                    $(rs)[0].style.color = "#c2c2c2";
                    toastify().error('Remove in Wishlist', {
                        position: 'center'
                    , });
                }
            }
            , error: function(e) {
                console.log(e);

            }
        })
    }
}

function cartcount() {
    $.ajax({
        url: "/CartCount"
        , type: "get"
        , success: function(res) {
            if (res['cartcount'] != 0) {
                $(".badge").text(res['cartcount']);
            }
        }
        , error: function(e) {
            console.log(e);
        }
    })
}
cartcount();

// productshow.blade.php
 $(document).ready(function() {
    
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) { 
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top').click(function() {
            $('body,html').animate({
                scrollTop: 0
            }, 0);
            return false; 
        });
    });