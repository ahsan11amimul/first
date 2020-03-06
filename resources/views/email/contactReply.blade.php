<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback from admin</title>
</head>
<body>
    <div class="container">
        <div class="row">  
            <div class="col-md-6 justify-content-center">
            <h5>Dear {{$data['name']}}, Thanks you again!!</h5>
            <p>New Message from Admin</p>
           
            <p> Message: {{$data['message']}}</p>
            Thanks!!
            </div>
        </div>
    </div>
</body>
</html>