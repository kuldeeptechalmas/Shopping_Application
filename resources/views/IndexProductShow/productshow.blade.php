@extends('index')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .likes {
            position: absolute;
            right: 10px;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }
    </style>
    @toastifyCss
    <div id="product">

    </div>

    @toastifyJs
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function showproduct() {

            $.ajax({
                url: "/mainproductget",
                type: "get",
                success: function (res) {
                    $("#product").html(res);
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
        showproduct();

        function favourite_product_data_save(rs, productid) {

            var element = $(rs)[0].style.color;
            console.log(element);

            if (element != "red") {

                $.ajax({
                    url: "/favourite/" + productid,
                    type: "get",
                    success: function (res) {
                        if (res.url) {
                            window.location.href = res.url;
                        }
                        else {
                            toastify().success('Add To Favourite List', {
                                position: 'center',
                            });
                            showproduct();
                        }
                    },
                    error: function (e) {
                        console.log(e);

                    }
                })
            }
            else {
                $.ajax({
                    url: "/removewishlist/" + productid,
                    type: "get",
                    success: function (res) {
                        if (res.url) {
                            window.location.href = res.url;
                        }
                        else {
                            toastify().error('Remove in Wishlist', {
                                position: 'center',
                            });
                            showproduct();
                        }
                    },
                    error: function (e) {
                        console.log(e);

                    }
                })
            }

        }
    </script>
@endsection