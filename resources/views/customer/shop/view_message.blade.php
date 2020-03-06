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
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Reciever</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Reply</th>
                    </tr>     
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                    <tr>
                    <td>{{$item->id}}</td>
                    <td><?php $sender=App\User::where('id',$item->sender_id)->first();
                    echo $sender->name;
                    ?></td>
                    <td>{{$item->message}}</td>
                    <td><?php $reciever=App\User::where('id',$item->reciever_id)->first();
                    echo $reciever->name;
                    ?></td>
                    <td><a href="{{url('customer/edit_product/'.$item->product_id)}}">
                    <?php $product=App\Product::where('id',$item->product_id)->first();
                    echo $product->name;
                    ?> </a>
                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>  
                    <form action="{{url('customer/confirm_product')}}" method="POST">
                    @csrf
                    <input type="hidden" name="reciever_id" value="{{$item->sender_id}}">
                    <input type="hidden" name="product_id" value="{{$item->product_id}}">
                    <input type="hidden" name="sender_id" value="{{$item->reciever_id}}">
                    <input type="text" name="message" id="message"> 
                    <button class="btn btn-success btn-sm float-right" type="submit"><i class="fas fa-envelope"></i></button>  
                    </form>
                    </td>
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
            @include('customer.partials.logout_modal')
        <a href="{{url('/message')}}" class="btn btn-info" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
       </a>
    
</div>
</section>


@endsection