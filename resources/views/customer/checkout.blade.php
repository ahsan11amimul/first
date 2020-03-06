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




{{--end sidebar--}}
 
{{--main content--}}
<div id="main" class="container-fluid">
  
   
    <!-- Button trigger modal -->
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    
    <!-- cart Modal -->
    @include('customer.partials.cart_modal')
    @include('customer.partials.wishlist_modal')
    
    
     @if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
  @if (Session::has('error'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
   
   
<div class="row">
    <div class="container">

         <div class="container">
        
            <div class="pt-1 text-center">
                
                <h2>Checkout form</h2>
               
              </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{App\Cart::totalItem()}}</span>
                    </h4>
                    <ul class="list-group mb-3">
                         @foreach (App\Cart::cartsItem() as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">{{$item->name}}</h6>
                            <small class="text-muted">Price:{{$item->price}} tk</small>
                            <small class="text-muted">Quantity:{{$item->quantity}}</small>
                            </div>
                        <span class="text-muted">Total:{{$item->price*$item->quantity}}</span>
                        </li>
                        @endforeach
                     
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (BDT)</span>
                        <strong>TK:  {{App\Cart::totalPrice()}}</strong>
                        </li>
                    </ul>

                   
                </div>
               <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Shipping address For Mr: {{$user->name}}</h4>
           <form action="{{route('customer.updateAddress')}}" method="POST" onsubmit="return validation()">
            @csrf
            <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user fa-lg text-info"></i></span>
            </div>
          <input type="text" class="form-control" placeholder="Fullname" name="name" id="name"value="{{$user->name}}">
         
          </div>
          <span class="text-danger text-weight-bold my-2" id="name_error"></span>
          <span class="text-danger text-weight-bold my-2">{{$errors->first('name')}}</span>
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope fa-lg text-info"></i></span>
            </div>
          <input type="email" class="form-control" placeholder="Email" name="email" id="email"value="{{$user->email}}">
             
          </div>
           <span class="text-danger text-weight-bold my-2" id="email_error"></span>
          <span class="text-danger text-weight-bold my-2">{{$errors->first('email')}}</span>
           
           <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-mobile fa-lg text-info"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone"value="{{$user->phone}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="total" value="{{App\Cart::totalPrice()}}">
            
          </div>
           <span class="text-danger text-weight-bold my-2" id="phone_error"></span>
           <span class="text-danger text-weight-bold my-2">{{$errors->first('phone')}}</span>
           
           <h4>Give Current address</h4>
            <hr class="mb-2">

          <div class="input-group from-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-home "></i></span>
                </div>
              <textarea class="form-control"placeholder="address" name="address" id="address" cols="8" rows="3">
                {{$user->address}}
              </textarea>
          </div>
           <span class="text-danger text-weight-bold my-2" id="address_error"></span>
           <span class="text-danger text-weight-bold my-2">{{$errors->first('address')}}</span>
            
                           <div class="input-group form-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker  fa-lg text-info"></i></span>
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
         <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
                </div>
            </div>

   </div>
       
    </div>
    </div>
     <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>

{{-- end New --}}
{{--popular--}}

{{--end popular--}}




<!-- Modal -->
@include('customer.partials.logout_modal');


{{--footer--}}

@include('customer.partials.footer')
<script>
  function validation()
  {
    let name=document.getElementById('name').value;
    let email=document.getElementById('email').value;
   // let password=document.getElementById('password').value; 
    let phone=document.getElementById('phone').value;
    let address=document.getElementById('address').value;
    let account_number=document.getElementById('account_number').value;  
      
    //let password_check=/^(?=.*[0-9])(?=.*[A-Za-z])[A-Za-z .,@$&*0-9]{8,16}$/;
    let name_check=/^[A-Za-z .:]{3,60}$/;
    let email_check=/[a-z0-9.-_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
    let phone_check=/01[3-9]{1}[0-9]{2}[0-9]{6}$/;
    let address_check=/[a-zA-Z-: 0-9,.]/;
    let account_check=/[0-9]{10}$/;
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
     if(account_check.test(account_number))
    {
      document.getElementById('account_error').innerHTML='';
    }else{
       document.getElementById('account_error').innerHTML='Invalid Account!!!';
       return false;
    }
    return true;


  }
</script>


    
@endsection