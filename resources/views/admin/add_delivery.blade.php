@extends('admin.layouts.master')
@section('title')
  Admin
@endsection
@section('content')


{{--mainnav--}}
@include('admin.partials.nav')
{{-- end main nav--}}
@include('admin.partials.modal')
{{--endmodal--}}
{{--main content--}}
<div class="container-fluid">

<div class="row">
{{-- sidebar --}}
@include('admin.partials.sidebar')
{{--end sidebar--}}
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
<div class="row">
<div class="container mb-2">
  <div class="row justify-content-left">
   <div class="col-md-6">
     <div class="card p-2  text-white"style="background-color:hsl(32, 63%, 16%);">
       <div class="card-header text-center text-white">{{ __('Add Delivery Boy') }}</div>
        <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
          <form action="{{url('admin/add_delivery/'.$id)}}" method="POST" onsubmit="return validation()">
            @csrf
            <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user fa-lg text-info"></i></span>
            </div>
          <input type="text" class="form-control" placeholder="Fullname" name="name" id="name"value="{{old('name')}}">
         
          </div>
          <span class="text-white text-weight-bold my-2" id="name_error"></span>
          <span class="text-white text-weight-bold my-2">{{$errors->first('name')}}</span>
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope fa-lg text-info"></i></span>
            </div>
          <input type="email" class="form-control" placeholder="Email" name="email" id="email"value="{{old('email')}}">
             
          </div>
           <span class="text-white text-weight-bold my-2" id="email_error"></span>
          <span class="text-white text-weight-bold my-2">{{$errors->first('email')}}</span>
           <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password" id="password"value="{{old('password')}}">
            
          </div>
          <span class="text-white text-weight-bold my-2" id="password_error"></span>
          <span class="text-white text-weight-bold my-2">{{$errors->first('password')}}</span>
           <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-mobile fa-lg text-info"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"value="{{old('phone')}}">
            
          </div>
           <span class="text-white text-weight-bold my-2" id="phone_error"></span>
           <span class="text-white text-weight-bold my-2">{{$errors->first('phone')}}</span>
          <div class="input-group from-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-home "></i></span>
                </div>
              <textarea class="form-control"placeholder="address" name="address" id="address" value="{{old('address')}}"></textarea>
          </div>
           <span class="text-white text-weight-bold my-2" id="address_error"></span>
           <span class="text-whites text-weight-bold my-2">{{$errors->first('address')}}</span>
           
          <button type="submit" class="btn btn-outline-warning w-100">Confirm</button>
       </form>         
        </div>
       </div>
     </div>
    </div>
 </div>
                   
 </div>
</div>    
{{--end maincontent--}}


{{--footer--}}
@include('admin.partials.footer')
<script>
  function validation()
  {
    let name=document.getElementById('name').value;
    let email=document.getElementById('email').value;
    let password=document.getElementById('password').value; 
    let phone=document.getElementById('phone').value;
    let address=document.getElementById('address').value; 
      
    let password_check=/^(?=.*[0-9])(?=.*[A-Za-z])[A-Za-z .,@$&*0-9]{8,16}$/;
    let name_check=/^[A-Za-z .:]{3,60}$/;
    let email_check=/[a-z0-9.-_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
    let phone_check=/01[3-9]{1}[0-9]{2}[0-9]{6}$/;
    let address_check=/[a-zA-Z-: 0-9,.]/
   
    if(name_check.test(name))
    {
      document.getElementById('name_error').innerHTML='';
    }else{
       document.getElementById('name_error').innerHTML='Invalid Name!!!';
       return false;
    }
    if(email_check.test(email))
    {
      document.getElementById('email_error').innerHTML='';
    }else{
       document.getElementById('email_error').innerHTML='Invalid Email!!!';
       return false;
    }
     if(password_check.test(password))
    {
      document.getElementById('password_error').innerHTML='';
    }else{
       document.getElementById('password_error').innerHTML='At least 8 characters Contain number';
       return false;
    }
    if(phone_check.test(phone))
    {
      document.getElementById('phone_error').innerHTML='';
    }else{
       document.getElementById('phone_error').innerHTML='Invalid Format input correct mobile no:!!!';
       return false;
    }
    if(address_check.test(address))
    {
      document.getElementById('address_error').innerHTML='';
    }else{
       document.getElementById('address_error').innerHTML='Invalid address!!!';
       return false;
    }
    return true;


  }
</script>
    
  
@endsection






