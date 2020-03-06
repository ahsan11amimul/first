@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
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
{{--main content--}}
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
<div class="row ">
<div class="container mt-5">
  <div class="row justify-content-center">
   <div class="col-md-6">
     <div class="card bg-success">
       <div class="card-header text-center text-white">{{ __('Admin settings..') }}</div>
        <div class="card-body">
           <form action="{{route('admin.settings')}}" method="POST">
           @csrf
        
            <div class="input-group form-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Current Password" name="current_password" id="current_password"value="{{old('current_password')}}">
               
            </div>
            <span class="text-danger text-weight-bold my-2">{{$errors->first('current_password')}}</span>
            <span class="text-danger text-weight-bold my-2" id="check_password"></span>
            <div class="input-group form-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password"value="{{old('new_password')}}">
                
            </div>
            <span class="text-danger text-weight-bold my-2">{{$errors->first('new_password')}}</span>
             <div class="input-group form-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password"value="{{old('confirm_password')}}">
               
            </div>
            <span class="text-danger text-weight-bold py-2">{{$errors->first('confirm_password')}}</span>
             <span class="text-danger text-weight-bold my-2" id="confirm_status"></span>
          <button type="submit" class="btn btn-outline-warning w-100">Update</button>
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