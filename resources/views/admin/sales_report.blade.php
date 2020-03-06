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
                <th>Order</th>
                <th>User</th>
                <th>Item</th>
                <th>Quantity</th>
                
                <th>Price</th>
                <th>Total</th>
                <th>Order_date</th>
                <th>Delivery_date</th>
                <th>Deliver_by</th>
                <th>Area</th>
                <th>Approved_by</th>
            </tr>
        </thead>
        <tbody>
            <?php $totals=0;?>
            @foreach ($orders as $item)
             <tr>
             <td>{{$item->id}}</td>
             <td>{{$item->user->name}}</td>
             <td>@foreach ($item->orderItems as $i)
                 {{$i->name}},
             @endforeach</td>
              <td>@foreach ($item->orderItems as $i)
                 {{$i->quantity}},
             @endforeach</td>
             
               <td>@foreach ($item->orderItems as $i)
                 {{$i->price}},
             @endforeach</td> 
             <td>{{$item->total}}</td>
            <td>{{ date_format($item->created_at,'y-M-d')}}</td>
             <td>{{ date_format($item->updated_at,'y-M-d')}}</td>
               <td>{{$item->delivered_by}}</td> 
               <td>{{$item->user->area->name}}</td>
               <td>{{$item->approved_by}}</td>
              
              
             </tr>
            <?php $totals+=$item->total ?>
              
            @endforeach
        </tbody>
     </table>
    <h5 class="text-success px-3">Total Sales Amount:{{$totals}}</h5>
     {{ $orders->links() }} 
        </div>
    
</div>
{{--footer--}}
@include('admin.partials.footer')
@endsection