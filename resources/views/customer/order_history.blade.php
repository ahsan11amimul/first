@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-9">
       <h5 class="text-bold text-success"> <a href="{{url('customer/index')}}">OrganicStore <sub class="text-muted">.com</sub> </a></h5>
        </div>
       
    </div>
    
   
    <div class="row py-4">
        <table class="table table-hover table-stripped">
            <thead class="table-dark">
                <tr>
                    <td>SL</td>
                    <td>Name</td>
                    <td>Total</td>
                    <td>Status</td>
                    <td>Delivered By</td>
                    <td>Issued By</td>
                    <td>Order date</td>
                    <td>Payment</td>
                </tr>
            </thead>
            <div class="tbody">
                    
               @foreach ($orders as $item)
                    
                   <tr>
                   <td>{{$item->id}}</td>
                   <td>{{$item->user->name}}</td>
                   <td>{{$item->total}}</td>
                   <td>{{$item->status?'Approved':'Pending'}}</td>
                   <td>{{$item->delivered_by}}</td>
                   <td>{{$item->approved_by}}</td>
                   <td>{{$item->created_at}}</td>
                   <td>{{$item->payment_method}}</td>
                   </tr>
               @endforeach
            </div>
        </table>
    </div>
   
    <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>
</div>
 @include('customer.partials.cart_modal')
    @include('customer.partials.wishlist_modal')
@endsection