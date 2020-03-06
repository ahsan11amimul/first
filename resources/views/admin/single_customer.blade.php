@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')

@include('admin.partials.modal')
{{-- end main nav--}}
<div class="container">
    <div class="row mt-1 justify-content-center">
       <div class="col-md-12">
       <h5>Details for {{$user->name}}</h5>
       </div>
    </div>  
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Register</th>
                        <th>Last Login</th>
                        <th>Area</th>
                        <th>Role</th>
                        <th>Buy</th>
                        <th>Sell</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>{{$user->area->name}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->orders->count()}} items</td>
                    <td>{{$user->products->count()}} items</td>
                
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
{{--footer--}}
@include('admin.partials.footer')
@endsection