<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email verification</title>
</head>
<body>
    <div class="container">
        <div class="row">  
            <div class="col-md-6 justify-content-center">
            <h5>Dear {{$user->name}}</h5>
                <p>Your acount has been created please verify it.</p>
            <a href="{{url('verify_user/'.$user->email_verification_token)}}">
                {{url('verify_user/'.$user->email_verification_token)}}</a>
            <br>
            Thanks!!
            </div>
        </div>
    </div>
</body>
</html>