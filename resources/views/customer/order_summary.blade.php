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
        <div class="col-md-3 text-danger text-bold">
            Order No # {{$order_check->id}}
        </div>
    </div>
    <div class="row py-4">
        <div class="col-md-6">  
          <h5>{{$order_check->user->name}}</h5>
           <p>{{$order_check->user->address}}</p>
           <p>Mobile:{{$order_check->user->phone}}</p>
           <p>Email:{{$order_check->user->email}}</p>
           <p>Delivery Area: {{$order_check->user->area->name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center bg-light">
                <div class="card-body">
                    <p>Order Placed</p>
                    <p>{{$order_check->created_at}}</p>
                </div>
            </div>
        </div>
         <div class="col-md-6">
            <div class="card text-center bg-light">
                <div class="card-body">
                    <p>Order Status</p>
                    <p><?php if($order_check->status==0)
                    {
                        echo "<span class='text-danger'>Pending</span>";
                    }
                    else{
                         echo "<span class='text-success'>Approved</span>";
                    }
                    ?>, {{$order_check->updated_at}}</p>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row py-4">
        <table class="table table-hover table-stripped">
            <thead class="table-dark">
                <tr>
                    <td>SL</td>
                    <td>Items Name</td>
                    <td>Price</td>
                    <td>Qty</td>
                    <td>Total</td>
                </tr>
            </thead>
            <div class="tbody">
                   <?php $i=1;?>
               @foreach ($order_check->orderitems as $item)
                    
                   <tr>
                   <td>{{$i++}}</td>
                   <td>{{$item->name}}</td>
                   <td>{{$item->price}}</td>
                   <td>{{$item->quantity}}</td>
                 
                   <td>{{$item->total}}</td>
                   </tr>
               @endforeach
            </div>
        </table>
    </div>
    <div class="row">
        <hr>
        <div class="col-md-8">

        </div>
        <div class="col-md-4 p-4">
            <p>Sub Total: <span class="float-right">Tk. {{$order_check->total - $order_check->user->area->delivery_charge}}</span></p>
            <p>Shipping: <span class="float-right">Tk. {{$order_check->user->area->delivery_charge}}</span></p>
            <p>Total: <span class="float-right">Tk. {{$order_check->total}}</span></p>
            <p>Cash to Collect: <span class="float-right">Tk. {{$order_check->payment_method==='bkash'?'0':$order_check->total}}</span></p>
            <p>Delivered By: <span class="float-right">{{$order_check->delivered_by}}</span></p>
            <p>Issued By: <span class="float-right">{{$order_check->approved_by}}</span></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="bg-dark p-1 text-white text-center">Order Note</h5>
            <div>
                Customer Phone: <span class="px-3">{{$order_check->user->phone}},</span>  Payment method: <span class="px-3">{{$order_check->payment_method=="CashOn"?"CashOn Delivery":"Bkash Payment"}}, </span>  Delivery Boy Phone:
                 <span class="px-3">{{$delivery_boy->phone}}.</span> 
            </div>
            <div>
                Thank you for ordering from OrganicStore.com.<strong class="pl-3"> Reciepent Signature  ..........................</strong>
            </div>
        </div>
    </div>
</div>
 <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>
     @include('customer.partials.cart_modal')
    @include('customer.partials.wishlist_modal')
@endsection