@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-9">
         @if (Session::has('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
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
       
       <h5 class="text-bold text-success"> <a href="{{url('admin/index')}}">OrganicStore <sub class="text-muted">.com</sub> </a></h5>
        </div>
        <div class="col-md-3 text-danger text-bold">
            Order No # {{$order->id}}
        </div>
    </div>
    <div class="row py-4">
        <div class="col-md-6">
          <h5>{{$order->user->name}}</h5>
           <p>{{$order->user->address}}</p>
           <p>Mobile:{{$order->user->phone}}</p>
           <p>Email:{{$order->user->email}}</p>
           <p>Delivery Area: {{$order->user->area->name}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center bg-light">
                <div class="card-body">
                    <p>Order Placed</p>
                    <p>{{$order->created_at}}</p>
                </div>
            </div>
        </div>
         <div class="col-md-6">
            <div class="card text-center bg-light">
                <div class="card-body">
                    <p>Order Status</p>
                    <p><span class="text-success">{{$order->status?'Approved':'Pending'}}</span> At {{$order->updated_at}}</p>
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
               @foreach ($order->orderitems as $item)
                    
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
            <p>Sub Total: <span class="float-right">Tk. {{$order->total - $order->user->area->delivery_charge}}</span></p>
            <p>Shipping: <span class="float-right">Tk. {{$order->user->area->delivery_charge}}</span></p>
            <p>Total: <span class="float-right">Tk. {{$order->total}}</span></p>
            <p>Cash to Collect: <span class="float-right">Tk. {{$order->payment_method==='bkash'?'0':$order->total}}</span></p>
            <p>Delivered By: <span class="float-right">{{$order->delivered_by}}</span></p>
            <p>Issued By: <span class="float-right">{{$order->approved_by}}</span></p>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <h5 class="bg-dark p-1 text-white text-center">Order Note</h5>
            <div>
                Customer Phone:<span class="px-3">{{$order->user->phone}},</span>  Payment method: <span class="px-3">{{$order->payment_method}} </span>  Delivery Boy:
                 <span class="px-3">{{$delivery_boy->name}}.</span> 
                 @if ($order->payment_method =='bKash')
            Transaction Id:<span class="px-3">{{$order->trx}}</span>
                <form action="{{route('check_trx')}}" method="POST">
                   @csrf
               <input type="hidden" name="trx" value="{{$order->trx}}">
              <input type="hidden" name="to" value="{{App\Account::where('user_id',Auth::user()->id)->value('account_number')}}">
               <button type="submit" class="btn btn-success btn-sm">Check</button>
               </form>
            
                 @endif
            </div>
            <div class="col-md-12 py-4">
           @if ($order->status==0)
              <a class="btn btn-outline-danger w-50" href="{{url('admin/delete_order/'.$order->id)}}">Cancel order</a><a  class="btn btn-outline-success w-50" href="{{url('admin/update_order/'.$order->id)}}">Confirm Order</a>  
           @endif
            </div>
        </div>
    </div>  
</div>
@endsection