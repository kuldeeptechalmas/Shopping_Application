@extends('Admin.index')

@section('content')

<div id="datatable">
hello user
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    
    // Product data are get all
        function showuserdataget() {
            $.ajax({
                type: "GET",
                url: "/getuserofall",
                success: function (res) {
                    
                    $("#datatable").html(res);

                },
                error: function (e) {
                    console.log(e);
                },
            })
        }
        showuserdataget();
</script>
@endsection