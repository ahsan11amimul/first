@extends('customer.layouts.shop')
@section('title')
    OrganicStore
@endsection
@section('content')
    <!--navbar-->
    @include('customer.partials.shop_nav')
{{--end sidebar--}}

{{--main content--}}
<section>
<div class="container-fluid">

 <div class="row">

        
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto mt-5">
  <div class="container mt-5"> 
   <div class="m-1 p-2 text-center">
    <a href="{{url('customer/add_product')}}" class="btn btn-warning text-center">Add New Product</a>        
  </div> 
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
           <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th> 
                        <th>Price</th> 
                        <th>Total</th>
                        <th>Status</th>
                        <th>Confirm</th>
                        <th>Upload Date</th>
                        <th>Verified Date</th>
                      
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>  
                    <td>{{$item->price*$item->quantity}}</td>
                   <td><?php if($item->status)
                    {
                        echo "<span class='text-success'>Approved</span>";
                    }else{
                        echo "<a href='#' class='text-danger'>Pending</a>";
                    }
                    
                    ?></td>
                    <td>@if ($item->is_verified)
                      <span class="text-success">Done</span>  
                    @else
                    <span><a class="text-danger" href="{{url('customer/verify/'.$item->id)}}" title="are you sure??">Not Yet</a></span> 
                    @endif</td>
                    <td>{{ date_format($item->created_at,'d-M-y')}}</td>
                    <td>{{ date_format($item->updated_at,'d-M-y')}}</td>
                    
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
            
            </div>
         
            <div class="row">
           
            <!-- Footer -->
            @include('customer.partials.footer')
            <!-- Footer -->
               
            </div>
         </div>
  

</div>
</div>
    @include('customer.partials.logout_modal')
        <a href="{{url('/message')}}" class="btn btn-info" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
       </a>
    
</div>
</section>


@endsection