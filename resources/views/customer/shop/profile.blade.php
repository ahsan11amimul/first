@extends('customer.layouts.shop')
@section('title')
    OrganicStore
@endsection
@section('content')
    <!--navbar-->
    @include('customer.partials.shop_nav')
{{--end sidebar--}}

{{--main content--}}
<section>
<div class="container-fluid">

 <div class="row">

        
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto mt-5">
  <div class="container mt-5"> 
   <div class="m-1 p-2 text-center">
   <a href="{{url('customer/profile/'.Auth::user()->id)}}" class="btn btn-warning text-center">Edit Your Profile {{Auth::user()->name}}</a>        
   </div> 
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
      <form action="{{route('farmer.settings',$user->id)}}" method="POST" onsubmit="return validation()" >
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
        {{-- <a href="{{url('customer/delete_account/'.$user->id)}}" class="btn btn-outline-success w-100 my-2">Delete Profile??</a> --}}
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
            <input type="number" placeholder="Account Number" class="form-control" name="account_number" id="account_number"value="{{old('account_number')}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('account_number')}}</span>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
            <input type="password" placeholder="Balance" class="form-control" name="pin" id="balance"value="{{old('pin')}}">
            <input type="hidden" name="id" value="{{$user->id}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('pin')}}</span>
         <button type="submit" class="btn btn-outline-warning w-100">View Balance</button>
        </form>
        <a href="#" class="btn btn-outline-danger w-100 mt-2" data-toggle="modal" data-target="#account">Add new account</a>
      </div>
    </div>
     

   
            
        
</div>
            @include('customer.partials.logout_modal')
              @include('customer.partials.logout_modal')
        <a href="{{url('/message')}}" class="btn btn-info" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
       </a>
             @include('customer.partials.ac_modal')
            <div class="row">
            @include('customer.partials.footer')
            </div>
         </div>
  

</div>
</div>
 
    
</div>
</section>


@endsection