@extends('admin.layouts.master')
@section('title')
  Admin
@endsection
@section('content')


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
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
<div class="row">
<div class="container mb-2">
  <div class="row justify-content-left">
   <div class="col-md-6">
     <div class="card p-2  text-white"style="background-color:hsl(32, 63%, 16%);">
       <div class="card-header text-center text-white">{{ __('Online Payment..') }}</div>
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
        <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
               <form action="{{route('admin.online_payment')}}" method="POST">
            @csrf
            <div class="form-group">
                  <label for="to"><h5>Farmer Ac:</h5></label>
                    <input type="text" class="form-control"  value="{{App\Account::where('user_id',$product->user_id)->value('account_number')}}" readonly>
                  </div>
                   <div class="form-group">
                    <label for="from"><h5>Account Type:</h5></label>
                    <input type="text" class="form-control" value="Personal" readonly>
                  </div>
                 
                  <div class="form-group">
                    <label for="amount"><h5>Amount</h5></label>
                    <input type="number" class="form-control" value="{{$product->price * $product->quantity - $product->price*$product->old_quantity}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="trx">Transaction Id</label>
                    <input type="number" class="form-control" id="trx" name="trx" placeholder="111222333" required>
                  </div>
                    <span class="text-danger text-bold">{{$errors->first('trx')}}</span>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                     <input type="hidden" name="product_id" value="{{$product->id}}">
                      
                    <button type="submit" class="btn btn-outline-warning w-100">Confirm</button>
                    </form>     
                      @if(!Session::has('success'))
                          <a  href="#" data-toggle="modal" data-target="#bkash" class="p-2 btn btn-outline-success w-100" title="Send Mocney">First Send Money </a>
                          @endif 
        </div>
       </div>
     </div>
    </div>
 </div>
                   
 </div>
</div>    
{{--end maincontent--}}
{{--bkash--}}
    <div class="modal fade" id="bkash" tabindex="-1" role="dialog" aria-labelledby="bkash" aria-hidden="true">
      <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="bkash">bKash Payment</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                         </button>
                      </div>
                <div class="modal-body">
                 <form action="{{route('payment')}}" method="POST">
                        @csrf
                    <div class="form-group">
                    <label for="to">To</label>
                    <input type="text" class="form-control" id="to" name="to" value="{{App\Account::where('user_id',$product->user_id)->value('account_number')}}" readonly>
                    </div>
                    <div class="form-group">
                    <label for="from">From</label>
                    <input type="text" class="form-control" id="from" name="from" required>
                   </div>
                  <span class="text-danger text-bold">{{$errors->first('from')}}</span>
                  <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="number" class="form-control" id="amount" name="amount" value="{{$product->price * $product->quantity - $product->price*$product->old_quantity}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="pin">Pin</label>
                    <input type="password" class="form-control" id="pin" name="pin" required>
                  </div>
                  <span class="text-danger text-bold">{{$errors->first('pin')}}</span>
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <button type="submit" class="btn btn-outline-warning w-100">Send</button>
                    </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                      </div>
                    </div>  
                  </div>
     </div>



{{--footer--}}
@include('admin.partials.footer')

    
  
@endsection