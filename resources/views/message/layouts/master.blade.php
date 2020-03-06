<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" href="{{asset('test-image/cart-icon.png')}}"/>
    <link rel="stylesheet" href="{{ asset('cdn/font-awesome/all.css')}}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('css/customer.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>
<body>
<style>
    ul{
        margin:0;
        padding:0;
    }
    li{
        list-style-type: none;
    }
    .user-wrapper, .message-wrapper{
        border: 1px solid #dddddd;
        overflow-y:auto;
    }
    .user-wrapper{
        height:550px;
    }
    .user{
        cursor:pointer;
        padding:5px 0;
        position:relative;
    }
    .user:hover{
        background: #eeeeee;
    }
    .user:last-child{
        margin-bottom:0;
    }
    .pending{
        position:relative;
        left:13px;
        top:5px;
        background:red;
        margin:0;
        border-radius:50%;
        width:25px;
        height:24px;
        line-height: 18px;
        padding-left:5px;
        color:#ffffff;
        font-size:16px;
    }
    .media-left{
        margin:0 10px;
    }
  
    .media-body p{
     padding:2px 0;
    }
    .message-wrapper{
      padding:10px;
      height:536px;
      background:#eeeeee;
    }
    .messages .message:last-child{
        margin-bottom:0;
    }
    .recieved,.sent{
        width: 45%;
        padding:3px 10px;
        border-radius:10px;
    }
    .recieved{
        background: #ffffff;
    }
    .sent{
        background:#3bebff;
        float:right;
        text-align:right;
    }
    .message p{
        margin:5px 0;
    }
    .date{
        color:#777777;
        font-size:12px;
    }
    .active{
        background: #eeeeee;
    }
    input[type=text]{
        width:100%;
        padding:12px 20px;
        margin:15px 0 0 0;
        display:inline-block;
        border-radius: 4px;
        box-sizing: border-box;
        outline:none;
        border:1px solid #eeeeee;
    }
    input[type=text]:focus{
        border:1px solid #aaaaaa;
    }

</style>
    
   @yield('content')

<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="{{asset('cdn/jquery.js')}}"></script>
<script>

 var my_id={{Auth::user()->id}};
$(document).ready(function () {
     $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
 let reciever_id=''; 
 
     Pusher.logToConsole = true;

    var pusher = new Pusher('b2d76d73c15d6a9fce1d', {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    var sender=data.message.from;
    var reciever=data.message.to;
      if(my_id==sender)
    {
       $('#'+reciever).click();
    }else if(my_id==reciever)
    {
       // alert(reciever);
        if(reciever_id==sender)
        {
            $('#'+sender).click();
        }else{
            var pending=parseInt($('#'+reciever).find('.pending').html());
            
            if(pending)
            {  
                pending=pending+1;
                $('#'+sender).find('.pending').html(pending);
            }else{
                $('#'+sender).append('<span class="pending">1</span>');
            }
        }
    }
   
    });
    $('.user').click(function () {
       $('.user').removeClass('active');
       $(this).addClass('active'); 
       $(this).find('.pending').remove();
       reciever_id = $(this).attr('id');
       $.ajax({
        type: "get",
        url: 'message/' + reciever_id,
        data: "",
        cache: false,
        success: function (data) {
        //alert(data);
        $('#messages').html(data);
        scroll();
       
      },
    });
  });
 
  $(document).on('keyup', '.input-text input', function (e) {
    let message=$(this).val();
   
     if(e.keyCode==13 && message!='' && reciever_id !=''){
         
      $(this).val('');
      $.ajax({
       type:'POST',
       url:'message_sent',
       data:{message:message,reciever_id:reciever_id},
       cache:false,
       success:function(data)
       {
  
       
       },
       error:function(err)
       {

       },
       complete:function()
       {
       scroll();
       }
      });
    }
  })
});
function scroll()
{
    $('.message-wrapper').animate({
   scrollTop:$('.message-wrapper').get(0).scrollHeight
    },50);
}

</script>

</body>
</html>