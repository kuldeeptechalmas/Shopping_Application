@extends('Admin.index')

@section('content')

    <div id="datatable">

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function showproductdataget() {
            $.ajax({
                type: "GET",
                url: "/getproductall",
                success: function (res) {
                    $("#datatable").html(res);
                },
                error: function (e) {
                    console.log(e);
                },
            })
        }
        showproductdataget();


    </script>
@endsection