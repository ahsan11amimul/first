@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')

{{--topnav--}}

{{--end topnav--}}
{{--mainnav--}}
@include('customer.partials.nav')
{{-- end mainnav--}}
{{--sidebar--}}




{{--end sidebar--}}
 
{{--main content--}}
<div id="main" class="container-fluid">
   
    <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    
    <!-- cart Modal -->
    @include('customer.partials.cart_modal')
     @include('customer.partials.wishlist_modal')
    
    
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
   
   
<div class="row">
    <div class="container">
     <div class="row">
         <div class="col-md-12 col-12" style="background-color:burlywood">
             <div class="text-center p-4">
                 <p class="text-muted">Order Number <strong class="text-danger">
                   {{ App\Order::all()->count()+1}}
                
                </strong></p>
                 <h5>Your order is on its way</h5>
                 <h5>Please Pay with <span class="text-success">Cash On Delivery</span></h5>
             </div>
         </div>
     </div>
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <div>
                    <h5  class="text-center p-4 text-bold text-danger"><a  href="#" data-toggle="modal" data-target="#bkash">Do you want to pay now!!</a></h5>
                </div>
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
                    <input type="text" class="form-control" id="to" name="to" value="01721544957" readonly>
                    </div>
                   <div class="form-group">
                    <label for="from">From</label>
                    <input type="text" class="form-control" id="from" name="from" required>
                  </div>
                    <span class="text-danger text-bold">{{$errors->first('from')}}</span>
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{App\Cart::totalPrice()+$user->area->delivery_charge}}" readonly>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cash On Delivery</button>
                      </div>
                    </div>  
                  </div>
                </div>
                </div>
                <div class="col-md-6">
                 <div class="card">
                    <div class="card-body text-center">
                   
                    <a href="#" data-toggle="modal" data-target="#payment" style="display:inline-block;"><img src="{{asset('test-image/'.'dbbl.jpg')}}" alt=""  style="width:150px;height:80px;"></a>
                    </div>
                </div>    
                </div>
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body text-center">
                    <a href="#" data-toggle="modal" data-target="#payment"  style="display:inline-block;"><img src="{{asset('test-image/'.'bkash.png')}}" alt="" style="width:150px;height:80px;"></a>
                 
                    </div>
                </div> 
                </div>
               
            
        </div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="payment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Online Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          </div>
          <div class="modal-body">
          <form action="{{route('customer.onlinePayment')}}" method="POST">
            @csrf
            <div class="form-group">
                  <label for="to"><h5>Organic Store Ac:</h5></label>
                    <input type="text" class="form-control"  value="01721544957" readonly>
                  </div>
                   <div class="form-group">
                    <label for="from"><h5>Account Type:</h5></label>
                    <input type="text" class="form-control" value="Personal">
                  </div>
                  <span class="text-danger text-bold">{{$errors->first('from')}}</span>
                  <div class="form-group">
                    <label for="amount"><h5>Amount</h5></label>
                    <input type="number" class="form-control"  value="{{App\Cart::totalPrice()+$user->area->delivery_charge}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="trx">Transaction Id</label>
                    <input type="number" class="form-control" id="trx" name="trx" placeholder="111222333" required>
                  </div>
                    <span class="text-danger text-bold">{{$errors->first('trx')}}</span>
                          <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                          <input type="hidden" name="total" value="{{App\Cart::totalPrice()+$user->area->delivery_charge}}">
                          <input type="hidden" name="delivered_by" value="{{$delivery_boy->name}}">
                          <input type="hidden" name="payment" value="bkash">
                      
                    <button type="submit" class="btn btn-outline-warning w-100">Pay Now</button>
                    </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                        </div>
                      </div>
  </div>
</div>
        <div class="row">
            <div class="col-md-6 col-6 border border-warning p-2">
             <h5 class=" p-4 text-muted">Delivery Address</h5>
             <div class="row "> 
                 <div class="col-md-4 col-4">
                 <p>Name</p>
                 <p>Phone</p>
                 <p>Email</p>  
                 <p>Address</p>
               
                 <hr class="pb-3">
                 <p>{{$delivery_boy->name}}</p>
                 </div>
                 <div class="col-md-8 col-8">
                 <p>{{$user->name}}</p>
                 <p>{{$user->phone}}</p>
                 <p>{{$user->email}}</p>  
                 <p>{{$user->address}},<span class="text-muted" style="font-size:12px;">{{$user->area->name}}</span></p>
                 <hr class="pb-3">
                 <p>{{$delivery_boy->phone}}</p>
                 </div>
             </div>
            </div>
            <div class="col-md-6 col-6 border border-danger p-2">
               <h5  class="text-center p-4 text-muted">Order Summary</h5>
               <div class="row ">
                   <div class="col-md-4">
                    <p>Subtotal:</p>
                    <p>Delivery Charge:</p>
                    <p>Order Total:</p>
                    <p class="text-danger">Amount Paid:</p>
                    <hr class="pb-3">
                    <p>Due:</p>
                   </div>
                   <div class="col-md-6">

                   </div>
                   <div class="col-md-2">
                      <p>{{App\Cart::totalPrice()}} Tk</p>
                      <p>{{$user->area->delivery_charge}} Tk</p>
                      <p>{{App\Cart::totalPrice() + $user->area->delivery_charge}} Tk</p>
                      <p>0 Tk</p>
                       <hr class="pb-3 ">
                      <p>{{App\Cart::totalPrice()+ $user->area->delivery_charge}} Tk</p>
                    </div>
               </div>
             
            
            </div> 
            </div>
        </div>
    </div>
    <div class="container mt-2">
         <div class="col-md-12">
     
           <form action="{{route('customer.orderStore')}}" method="POST">
            @csrf
         
           
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="total" value="{{App\Cart::totalPrice()+$user->area->delivery_charge}}">
            <input type="hidden" name="delivered_by" value="{{$delivery_boy->name}}">
            
            
         <button class="btn btn-warning float-right w-50" type="submit">Confirm Order</button>
        
        </form>
    <a href="{{route('customer.cancelOrder')}}" class="btn btn-info w-50">Cancel Order</a>
    </div>
    

</div>
</div>
       


{{-- end New --}}
{{--popular--}}

{{--end popular--}}




<!-- Modal -->
@include('customer.partials.logout_modal');
 <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
 </a>

{{--footer--}}

@include('customer.partials.footer')
<script>
  function validation()
  {
    let name=document.getElementById('name').value;
    let email=document.getElementById('email').value;
   // let password=document.getElementById('password').value; 
    let phone=document.getElementById('phone').value;
    let address=document.getElementById('address').value;
    let account_number=document.getElementById('account_number').value;  
      
    //let password_check=/^(?=.*[0-9])(?=.*[A-Za-z])[A-Za-z .,@$&*0-9]{8,16}$/;
    let name_check=/^[A-Za-z .:]{3,60}$/;
    let email_check=/[a-z0-9.-_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
    let phone_check=/01[3-9]{1}[0-9]{2}[0-9]{6}$/;
    let address_check=/[a-zA-Z-: 0-9,.]/;
    let account_check=/[0-9]{10}$/;
    if(name_check.test(name))
    {
      document.getElementById('name_error').innerHTML='';
    }else{
       document.getElementById('name_error').innerHTML='Invalid Name!!!';
       return false;
    }
    if(email_check.test(email))
    {
      document.getElementById('email_error').innerHTML='';
    }else{
       document.getElementById('email_error').innerHTML='Invalid Email!!!';
       return false;
    }
    
    if(phone_check.test(phone))
    {
      document.getElementById('phone_error').innerHTML='';
    }else{
       document.getElementById('phone_error').innerHTML='Invalid Format input correct mobile no:!!!';
       return false;
    }
    if(address_check.test(address))
    {
      document.getElementById('address_error').innerHTML='';
    }else{
       document.getElementById('address_error').innerHTML='Invalid address!!!';
       return false;
    }
     if(account_check.test(account_number))
    {
      document.getElementById('account_error').innerHTML='';
    }else{
       document.getElementById('account_error').innerHTML='Invalid Account!!!';
       return false;
    }
    return true;


  }
</script>


    
@endsection