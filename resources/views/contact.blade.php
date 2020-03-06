
@extends('layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h5 class="text-success w-100">Contact page</h5>
        </div>
        <div class="col-md-4">
            <h5><button onclick="goBack()" class="btn btn-danger">Go Back</button>

            </h5>
            <script>
             function goBack() 
             {
             window.history.back();
             }                   
           </script>
        </div>
    </div>
</div>

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

@if (Session::has('success'))
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                <div class="card-body">
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p class="text-muted">
                    <i class="fas fa-home mr-3 text-muted"></i>Road no:14,G-block,Bashundhara R/A,Dhaka,Bangladesh</p>
                <p class="text-muted">
                    <i class="fas fa-envelope mr-3 text-muted"></i>amimul.ahsan369@gmail.com</p>
                <p class="text-muted">
                    <i class="fas fa-phone mr-3 text-muted"></i> 01721-544957</p>
                <p class="text-muted">
                    <i class="fas fa-print mr-3 text-muted"></i> 01721-544957</p>
                </div>

            </div>
        </div>
    </div>
</div>   
@else
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact us.
                </div>
                <div class="card-body">
                <form action="{{url('/contact')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter name" required>
                        </div>
                       <span class="text-danger">{{$errors->first('name')}}</span>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                         <span class="text-danger">{{$errors->first('email')}}</span>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>
                         <span class="text-danger">{{$errors->first('message')}}</span>
                        <div class="mx-auto">
                        <button type="submit" class="btn btn-outline-warning w-100 text-center">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address</div>
                <div class="card-body">
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p class="text-muted">
                    <i class="fas fa-home mr-3 text-muted"></i>Road no:14,G-block,Bashundhara R/A,Dhaka,Bangladesh</p>
                <p class="text-muted">
                    <i class="fas fa-envelope mr-3 text-muted"></i>amimul.ahsan369@gmail.com</p>
                <p class="text-muted">
                    <i class="fas fa-phone mr-3 text-muted"></i> 01721-544957</p>
                <p class="text-muted">
                    <i class="fas fa-print mr-3 text-muted"></i> 01721-544957</p>
                </div>

            </div>
        </div>
    </div>
</div>    
@endif
{{--footer--}}
@include('partials.footer')
@endsection
