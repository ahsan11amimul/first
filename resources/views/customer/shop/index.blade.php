@extends('customer.layouts.shop')
@section('title')
    OrganicStore
@endsection
@section('content')
    <!--navbar-->
    @include('customer.partials.shop_nav')
    <!--end navbar-->
   <!--Content-->
<section>
    <div class="container-fluid">
     @include('customer.partials.logout_modal')
       
      <div class="row">
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-md-5">
                    <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{Session('success')}}!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>  
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session('error')}}!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>  
                        @endif
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                                     <div class="text-right text-secondary">
                                         <h5>My Accounts</h5>
                                     <h3>{{App\Account::where('user_id',Auth::user()->id)->value('balance')}}</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                                  <a href="{{url('customer/profile/'.Auth::user()->id)}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                             </div>
                         </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-heart fa-3x text-danger"></i>
                                <div class="text-right text-secondary">
                                    <h5>My Products</h5>
                                    <h3>{{$products->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
                             <a href="{{url('customer/view_product')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-user-circle fa-3x text-danger"></i>
                                <div class="text-right text-secondary">
                                    <h5>Farmers</h5>
                                <h3>{{$users->where('role_id',2)->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-users fa-3x text-primary"></i>
                                <div class="text-right text-secondary">
                                    <h5>Users</h5>
                                <h3>{{$users->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
                        </div>
                    </div>
                    </div> 
                    <div class="col-xl-5">
                    <form action="{{route('check_trx')}}" method="POST">
                    @csrf
                    <input type="number" name="trx" id="" required>
                    <input type="hidden" name="to" value="{{App\Account::where('user_id',Auth::user()->id)->value('account_number')}}">
                    <button type="submit" class="btn btn-success">Check TRX</button>
                   </form>   
                    </div>
                
                </div>
                <div class="row">
                    <a href="{{url('/message')}}" class="btn btn-info" id="fixedbtn">
                     Live Chat  <i class="fas fa-comment-alt"></i>
                    </a>
                    </div> @include('customer.partials.footer')  
                </div>
           
        </div>
     </div>    
                
            
</section>
@endsection
   