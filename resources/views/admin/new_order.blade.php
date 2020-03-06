@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
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
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
    <div class="row py-4"> 
            <div class="col-md-12">
            <h5 class="text-center bg-dark text-white p-3">New Orders</h5>
            </div>
    </div>
  <div class="row">       
    <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Total</th>
                <th>Area</th>
                <th>Payment</th>
                <th>Delivery</th>
                <th>Approved</th>
                <th>Status</th>
                <th>Order Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->user->area->name}}</td>
                <td>{{$item->payment_method}}</td>
                <td>{{$item->delivered_by}}</td>
                <td>{{$item->approved_by}}</td>
                <td>{{$item->status?'Approved':'Pending'}}</td>
                <td>
                <a href="{{url('admin/view_order/'.$item->id)}}" class="p-2" title="View Details"><i class="fas fa-eye  text-success fa-lg"></i></a>
                <a href="{{url('admin/delete_order/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
              
                </td>
                </tr>
            @endforeach
        </tbody>
     </table>
    
    </div>
</div>
{{--end maincontent--}}
</div>
</div>
{{--footer--}}
@include('admin.partials.footer')

@endsection