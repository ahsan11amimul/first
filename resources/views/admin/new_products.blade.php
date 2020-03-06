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
                <th>Description</th>
                <th>User</th>
                <th>Product Action</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $totals=0;?>
            @foreach ($products as $item)
             <tr>
             <td>{{$item->id}}</td>
             <td>{{$item->name}}</td>
             <td>{{$item->quantity}}</td>
             <td>{{$item->unit}}</td>
             <td>{{$item->price}}</td>   
             <td>{{$item->price * $item->quantity}}</td> 
             <td>{{$item->created_at}}</td>
             <td>{{$item->description}}</td>
             <td>{{$item->user->name}}</td> 
                <td>
                <a href="{{url("admin/buy_product/".$item->id)}}" class="p-2" title="By This item"><i class="fas fa-thumbs-up  text-success fa-lg"></i></a>
                <a href="{{url('admin/delete_product/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
                 </td>
              
             </tr>
            
             <?php $totals+=($item->quantity * $item->price) ?>
              
            @endforeach
        </tbody>
     </table>
    <h5 class="text-success px-3">Total Costs Amount Will be:{{$totals}}</h5>
     {{-- {{ $orders->links() }}  --}}
        </div>
    
</div>

                  
@include('admin.partials.footer')
@endsection
