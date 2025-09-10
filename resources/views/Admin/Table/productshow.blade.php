@extends('Admin.index')

@section('content')

<div id="productoutputoftable">
hello
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        showproductdataget();
    });
    
    // Product data are get all
        function showproductdataget() {
            $.ajax({
                type: "GET",
                url: "getuserofall",
                success: function (res) {
                    console.log(res);
                    
                    $("#productoutputoftable").html(res);
                },
                error: function (e) {
                    console.log(e);
                },
            })
        }
</script>
@endsection