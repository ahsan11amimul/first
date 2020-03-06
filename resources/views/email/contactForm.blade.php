<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Form</title>
</head>
<body>
    <div class="container">
        <div class="row">  
            <div class="col-md-6 justify-content-center">
            <h5>Dear Admin, Thanks you again!!</h5>
            <p>New Message from {{$contact->name}}</p>
            <p> Email: {{$contact->email}}</p>
            <p> Message: {{$contact->message}}</p>
            Thanks!!
            </div>
        </div>
    </div>
</body>
</html>