@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')

{{--topnav--}}

{{--end topnav--}}
{{--mainnav--}}
@include('customer.partials.nav')
{{-- end mainnav--}}
{{--sidebar--}}

@include('customer.partials.sidebar')



{{--end sidebar--}}
 
{{--main content--}}
<div id="main" class="container-fluid">
  
   
     
   

      
     
     @if (Session::has('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
     @endif
      @if (Session::has('error'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
     @endif
<div class="row">
  <div class="col-md-4 p-5">
         {{-- change profile--}}
     <h5>Profile Page for {{$user->name}}</h5>
      <form action="{{route('customer.settings',$user->id)}}" method="POST" onsubmit="return validation()" >
            @csrf
            <div class="input-group form-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user fa-lg text-info"></i></span>
                </div>
                <input type="text" class="form-control"  name="name" id="name"value="{{$user->name}}">
            
            </div>
            <span class="text-danger text-bold my-2" id="name_error"></span>
            <span class="text-danger text-bold my-2">{{$errors->first('name')}}</span>
            <div class="input-group form-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope fa-lg text-info"></i></span>
                </div>
                <input type="email" class="form-control" name="email" id="email"value="{{$user->email}}">
            </div>
           <span class="text-danger text-bold my-2" id="email_error"></span>
           <span class="text-danger text-bold my-2">{{$errors->first('email')}}</span>
         
         
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-mobile fa-lg text-info"></i></span>
            </div>
            <input type="text" class="form-control" name="phone" id="phone"value="{{$user->phone}}">
         </div>
           <span class="text-danger text-bold my-2" id="phone_error"></span>
           <span class="text-danger text-bold my-2">{{$errors->first('phone')}}</span>
          <div class="input-group from-group">
            <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-home "></i></span>
            </div>
            <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}">
            </div>
           <span class="text-danger text-bold my-2" id="address_error"></span>
           <span class="text-danger text-bold my-2">{{$errors->first('address')}}</span>
            <div class="input-group form-group">
             <div class="input-group-prepend">
             <span class="input-group-text"><i class="fas fa-map-marker  fa-lg text-danger"></i></span>
             </div>
            <select name="area" id="area" class="form-control">
            <option value="{{$user->area_id}}">{{$user->area->name}}</option>
             @foreach ($areas as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>  
            @endforeach
            </select>
            </div>
            <span class="text-white py-2">{{$errors->first('area')}}</span>
             <hr class="mb-4">
         <button class="btn btn-outline-primary w-100" type="submit">Save Changes</button>
        </form>
      </div>
      {{-- change password--}}
      <div class="col-md-4 p-5">
          <h5>Change password</h5>
      <form action="{{route('customer.update_password')}}" method="post">
        @csrf
        <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
           <input type="password" placeholder="Old password" class="form-control" name="current_password" id="current_password"value="{{old('current_password')}}">
        </div>
         <span class="text-danger text-bold my-2">{{$errors->first('current_password')}}</span>
        <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-success"></i></span>
            </div>
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="password" placeholder="New password" class="form-control" name="new_password" id="new_password" value="{{old('new_password')}}">
        </div>
          <span class="text-danger text-bold my-2">{{$errors->first('new_password')}}</span>
          <button type="submit" class="btn btn-outline-danger w-100">Update Password</button>
          </form>
        <a href="{{url('customer/delete_account/'.$user->id)}}" class="btn btn-outline-success w-100 my-2">Delete Profile??</a>
      </div>
       <div class="col-md-4 p-5">
              {{-- change account--}}
        <h5>Account Section</h5>
       <form action="{{url('customer/show_account')}}" method="post">
        @csrf
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
            <input type="text" placeholder="Account Number" class="form-control" name="account_number" id="account_number"value="{{old('account_number')}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('account_number')}}</span>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-danger"></i></span>
            </div>
            <input type="password" placeholder="Pin Number" class="form-control" name="pin" id="pin"value="{{old('pin')}}">
          <input type="hidden" name="id" value="{{$user->id}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('pin')}}</span>
        
         <button type="submit" class="btn btn-outline-warning w-100">View Balance</button>
      
        </form>
        <a href="#" class="btn btn-outline-danger w-100 mt-2" data-toggle="modal" data-target="#account">Add new account</a>
      </div>
    </div>
     

   
    
  <!-- Button trigger modal -->
  
   
    <!-- Modal -->
 
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
 </a>
    
    <!-- cart Modal -->
    @include('customer.partials.cart_modal')
    @include('customer.partials.logout_modal');
     @include('customer.partials.wishlist_modal')
  
    @include('customer.partials.ac_modal')
            
        
</div>



{{--footer--}}

@include('customer.partials.footer')

<script>

  function validation()
  {
      
    let name=document.getElementById('name').value;
    let email=document.getElementById('email').value;
    //let password=document.getElementById('new_password').value; 
    let phone=document.getElementById('phone').value;
    let address=document.getElementById('address').value;
    //let account_number=document.getElementById('account_number').value;  
      
    //let password_check=/^(?=.*[0-9])(?=.*[A-Za-z])[A-Za-z .,@$&*0-9]{8,16}$/;
    let name_check=/^[A-Za-z .:]{3,60}$/;
    let email_check=/[a-z0-9.-_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
    let phone_check=/01[3-9]{1}[0-9]{2}[0-9]{6}$/;
    let address_check=/[a-zA-Z-: 0-9,.]/;
    //let account_check=/[0-9]{10}$/;
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
    // if(password_check.test(password))
    // {
    //   document.getElementById('password_error').innerHTML='';
    // }else{
    //    document.getElementById('password_error').innerHTML='Invalid Password Format please Enter 8 characters with One Letter!';
    //    return false;
    // }
    
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
    //  if(account_check.test(account_number))
    // {
    //   document.getElementById('account_error').innerHTML='';
    // }else{
    //    document.getElementById('account_error').innerHTML='Invalid Account!!!';
    //    return false;
    // }
   
    return true;


  }
</script>
    
@endsection