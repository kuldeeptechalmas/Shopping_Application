<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
  <div class="modal-dialog" >
    <div class="modal-content" style="margin-top:30%">
      <div class="modal-body">
            <h3 style="text-align: center">Welcome to Shopping<br></h3>
            <p style="text-align: center">You are <br>
                <a href="/registration">
                    <button type="button" class="btn btn-primary" onclick="customer('Shopkeeper')">To Sell Product</button><br>
                </a>
                or  <br>
                <a href="/registration">
            <button type="button" class="btn btn-primary" onclick="customer('Customer')">To Buy Product</button><br>
            </a>
            </p>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    function customer(roleName =null)
    {

        sessionStorage.setItem("role", roleName);
        
    }
</script>
</body>
</html>