@extends('admin.layouts.master')
@section('title')
   View Product
@endsection
@section('content')
@if (Session::has('error'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
@if (Session::has('success'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif

{{--mainnav--}}
@include('admin.partials.nav')
{{-- end main nav--}}

{{--endmodal--}}
{{--main content--}}
<div class="container-fluid">
@include('admin.partials.modal')
<div class="row">
{{-- sidebar --}}
@include('admin.partials.sidebar')
{{--end sidebar--}}

{{--main content--}}

<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="container"> 
   <div class="m-1 p-2 text-center">
  <a href="{{url('admin/add_product')}}" class="btn btn-warning text-center">Add New Product</a>        
  </div> 
<div class="row">
           
    <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
              
                <th>Qty</th> 
            
                <th>Price</th>
               
                <th>Total</th>
                <th>Status</th>
                <th>User</th>
               
               <th>Product Action</th>
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
            
            <td>{{$item->quantity*$item->price}}</td>
            <td class="text-success">{{$item->status?'Online':'Offline'}}</td>
            <td>{{$item->user->name}}</td>
         
            
            <td>
                <a href="{{url('admin/single_product/'.$item->id)}}" class="p-2" title="View Details"><i class="fas fa-eye  text-success fa-lg"></i></a>
                <a href="{{url('admin/delete_product/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
                <a href="{{url('admin/edit_product/'.$item->id)}}" class="p-2" title="Edit this"><i class="fas fa-edit text-primary text-warning fa-lg"></i></a>
            </td>
            </tr>
            @endforeach
           
        </tbody>
     </table>
    
    </div>
  </div>
</div>
</div>
{{--end maincontent--}}
</div>

{{--footer--}}
@include('admin.partials.footer')

@endsection