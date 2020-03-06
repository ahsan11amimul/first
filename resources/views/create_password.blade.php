@extends('layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-5">
 <div class="card" style="background-color:hsl(32, 63%, 16%);">
   <div class="card-header text-center text-white">{{ __('Create password') }}</div>
 <div class="card-header text-center"><a href="{{url('/')}}">www.organicstore.com </a></div>
           @if (Session::has('error'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
           @endif
             @if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
           @endif
                <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
                <form action="{{url('create_password/'.$user->id)}}" method="POST">
                    @csrf
                     <div class="input-group form-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password"value="{{old('password')}}">
                     </div>    
                <span class="text-white py-2">{{$errors->first('password')}}</span>
                          <div class="input-group form-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="password"value="{{old('confirm_password')}}">
                            
                        </div>
                        <span class="text-white py-2">{{$errors->first('confirm_password')}}</span>
                      
                        <button type="submit" class="btn btn-outline-warning w-100">New Password</button>
                    </form>
                <a href="{{url('/signup')}}" class="my-2 float-left text-white">Create New Account??</a>
             
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
