@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')

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
                <th>No Order</th>
                <th>Ordered QTY</th>
                <th>Status</th>
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
               <td><?php $order_item=App\OrderItem::where('product_id',$item->id)->get();
                   echo $order_item->count();?> </td> 
                <td><?php 
                  $i=0;
                   $order_item=App\OrderItem::where('product_id',$item->id)->get();
                   foreach ($order_item as $key ) {
                   $i+=$key->quantity;
                   }
                    echo $i;
                   
                  ?> </td>  
             
               <td>{{$item->status?'Online':'Offline'}}</td>
                <td>
                <a href="{{url('admin/single_product/'.$item->id)}}" class="p-2" title="View Details"><i class="fas fa-eye  text-success fa-lg"></i></a>
                <a href="{{url('admin/delete_product/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
                <a href="{{url('admin/edit_product/'.$item->id)}}" class="p-2" title="Edit this"><i class="fas fa-edit text-primary text-warning fa-lg"></i></a>
                </td>
              
             </tr>
            <?php $totals+=$item->total ?>
              
            @endforeach
        </tbody>
     </table>
   
    </div>
</div>
{{--footer--}}
@include('admin.partials.footer')
@endsection