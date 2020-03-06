@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')

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
@include('admin.partials.modal')
{{-- end main nav--}}
<div class="container-fluid">
    <div class="row mt-1">
        <div class="col-md-9">
       <h5 class="text-bold text-success p-2"> <a href="{{url('admin/index')}}">OrganicStore <sub class="text-muted">.com</sub> </a></h5>
        </div>
        <div class="col-md-3 text-danger text-bold">
           Print History
            ​<button onclick="myFunction()" class="btn btn-danger btn-sm ml-5"> <i class="fas fa-print"></i></button>

                <script>
                function myFunction() { window.print(); }
                </script>
        </div>
    </div>
    <div class="row justify-content-center">
     
     <table id="example" class="table table-hover table-striped table-responsive" style="width:100%">
          <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Total</th>
                <th>Added</th>
               
                <th>User</th>
                <th>Product Action</th>
                
            </tr>
        </thead>
        <tbody>
            
            @foreach ($low_products as $item)
             <tr>
             <td>{{$item->id}}</td>
             <td>{{$item->name}}</td>
             <td>{{$item->quantity}}</td>
             <td>{{$item->unit}}</td>
             <td>{{$item->price}}</td>   
             <td>{{$item->price * $item->quantity}}</td> 
             <td>{{$item->created_at}}</td>
             <td>{{$item->user->name}}</td>   
                <td>
                @if ($item->user_id==Auth::user()->id)
                <a href="{{url('admin/single_product/'.$item->id)}}" class="p-2 float-right" title="Add Quantity"><i class="fas fa-eye  text-success fa-lg"></i></a>
                    @else
                <form action="{{url('admin/need_product')}}" method="POST">
                    @csrf
                    <input type="hidden" name="reciever_id" value="{{$item->user_id}}">
                    <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="product_id" value="{{$item->id}}">
                   
                    <input type="text" name="message" id="message"> 
                 
                   
                    <button class="btn btn-success btn-sm float-right p-1" type="submit"><i class="fas fa-envelope"></i></button>  
                    </form>
              
                    @endif
              
               
              
                </td>
              
             </tr>
          
              
            @endforeach
        </tbody>
     </table>
   
     {{-- {{ $orders->links() }}  --}}
        </div>
    
</div>
{{--footer--}}
@include('admin.partials.footer')
@endsection