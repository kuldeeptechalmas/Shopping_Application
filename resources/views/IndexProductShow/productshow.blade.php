@extends('index')

@section('content')
    <div id="product" style="margin-left: 30px">

    </div>

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
        </script>
@endsection