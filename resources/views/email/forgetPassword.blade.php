<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
</head>
<body>
    <div class="container">
        <div class="row">  
            <div class="col-md-6 justify-content-center">
            <h5>Dear {{$user->name}}</h5>
                <p>Here you can Create a new Password</p>
            <a href="{{url('create_password/'.$user->id)}}">
                {{url('create_password/'.$user->id)}}</a>
            <br>
            Thanks!!
            </div>
        </div>
    </div>
</body>
</html>