@extends('layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-5">
 <div class="card" style="background-color:hsl(32, 63%, 16%);">
   <div class="card-header text-center text-white">{{ __('Foget password') }}</div>
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
                <form action="{{route('forget_password')}}" method="POST">
                    @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope fa-lg text-info"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"value="{{old('email')}}">
                         </div>
                         <span class="text-white py-2 text-bold">{{$errors->first('email')}}</span>
                       
                        <button type="submit" class="btn btn-outline-warning w-100">Send Request</button>
                    </form>
          
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
