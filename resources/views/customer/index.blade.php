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

@include('customer.partials.sidebar')



{{--end sidebar--}}
 
{{--main content--}}
<div id="main" class="container-fluid">
   
  <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>
  
   
    <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    
    <!-- cart Modal -->
    @include('customer.partials.cart_modal')
    @include('customer.partials.wishlist_modal')
    
     @include('customer.partials.slider')
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
   
<div class="row">
    <div class="container">
        <div class="title_box">
            <h5>Our Products Categories.</h5>
        </div>
        <div class="row">
            @foreach ($categories as $item)
             <div class="col-md-4">
                <div class="card">
                <div class="card-body"><a href="{{url('customer/details/'.$item->id)}}" title="Visit this category products">{{$item->name}} <span class="badge badge-danger">{{$item->products->count()}}</span></a></div>
                </div>
            </div>
            @endforeach
           
            
        </div>
        {{-- why love--}}
        <div class="row">
            <div class="title_box">
                <h5>Why people <i class="fas fa-heart text-danger pr-2"></i>Loves Us!!</h5>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">100% Fresh & Organic Foods.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Delivery Just in 2 Hours.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Least Delivery charge!!.</h5>
                    </div>
                </div>
            </div>
        </div>
         {{-- top categories--}}
        <div class="row mt-5">
           <div class="col-md-5">
               <div class="underline">
             <h6></h6>
               </div>
           </div>
           <div class="col-md-2">
              <div class="category">
                  <h6>Top categories</h6>
              </div>
           </div>
           <div class="col-md-5">
              <div class="underline">
                <h6></h6>
              </div>
           </div>
        </div>
        <div class="row mt-5">
            @foreach ($categories as $item)
            <div class="col-md-3 p-3">
              <div class="products">
               <div class="image-box">
               <img src="{{asset('storage/uploads/'.$item->image)}}" alt="" class="image"> 
                    <div class="overlay">
                        <div class="text">
                        <p>{{$item->name}}</p>
                        <p>{{$item->description}}</p>
                        </div>
                    </div>
               </div>
                <div class="products-footer">
                    <a href="{{url('customer/details/'.$item->id)}}" class="btn btn-info w-100 " title="Visit this category products"> <i class="fas fa-eye pr-2"></i>View Details</a>
                  
                    
                </div>
               </div>
            </div>
            @endforeach
           
            
        </div>
        {{-- end top categories--}}
        {{-- On Sale--}}
        <div class="row mt-5">
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category">
                    <h6>On Sale</h6>
                </div>
            </div>
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($products as $item)
            <div class="col-md-3 p-3">
                <div class="products">
                    <div class="image-box">
                    <img src="{{asset('storage/uploads/'.$item->image)}}" alt="" class="image">
                        <div class="overlay">
                            <div class="text">
                            <p>{{$item->name}}</p>
                            <p class="currency">BDT: {{$item->price}}-tk per {{$item->unit}}</p>
                            <p>{{$item->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="products-footer">
                        <div>
                        <h5 class="text-center text-muted">{{$item->name}}</h5>
                        <p class="text-center text-muted">BDT: <strong class="text-danger">{{$item->price}}</strong>-tk per({{$item->unit}})</p>
                        </div>
                        <form action="{{route('add_cart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$item->id}}"product_id="{{$item->id}}"> 
                        <button type="submit" class="add_cart btn btn-outline-warning float-right"><i class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
                        </form>
                     <form action="{{route('add_wishlist')}}" method="POST">
                     @csrf
                    <input type="hidden" name="product_id" value="{{$item->id}}"product_id="{{$item->id}}"> 
                    <button type="submit" class=" btn btn-outline-danger float-left"><i class="fas fa-heart pr-2"></i>Wishlist</button>
                    </form>
      
                     </div>
                </div>
            </div> 
            @endforeach
           
          
        </div>
        {{-- End sale--}}
    </div>
    
          
        
    </div>

{{-- end New --}}
{{--popular--}}

{{--end popular--}}




<!-- Modal -->
@include('customer.partials.logout_modal');


{{--footer--}}

@include('customer.partials.footer')


    
@endsection