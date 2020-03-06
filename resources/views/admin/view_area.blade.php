@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')

@include('admin.partials.modal')
{{-- end main nav--}}
<div class="container">
    <div class="row mt-1">
        
     <div class="col-md-6">
       <h5 class="text-bold text-success p-2"> <a href="{{url('admin/index')}}">OrganicStore <sub class="text-muted">.com</sub> </a></h5>
     </div>
     <div class="col-md-3">
           <h5 class="text-bold text-success p-2"> <a href="{{url('admin/add_area')}}">Add Area</a></h5>
     </div>
     
        <div class="col-md-3 text-danger text-bold">
           Print History
            ​<button onclick="myFunction()" class="btn btn-danger btn-sm ml-5"> <i class="fas fa-print"></i></button>

                <script>
                function myFunction() { window.print(); }
                </script>
        </div>
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
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif

    <div class="row justify-content-center">
     
     <table id="example" class="table table-hover table-striped table-responsive" style="width:100%">
          <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Shipping Cost</th>
                <th>Delivery Boy</th>
                <th>Users</th>
                <th>Farmers</th>
                <th>Action</th>
                <th>Delivery Boy</th>
            </tr>
        </thead>
        <tbody>
          
            @foreach ($areas as $item)
             <tr>
             <td>{{$item->id}}</td>   
             <td>{{$item->name}}</td>
             <td>{{$item->delivery_charge}}</td>
             <td><?php $delivery=App\User::where(['area_id'=>$item->id,'role_id'=>3])->get();
                   echo $delivery->count();?> </td>
             <td><?php $delivery=App\User::where(['area_id'=>$item->id,'role_id'=>1])->get();
                   echo $delivery->count();?> </td>
             <td><?php $delivery=App\User::where(['area_id'=>$item->id,'role_id'=>2])->get();
                   echo $delivery->count();?>
             </td>
            <td><a href="{{url('admin/edit_area/'.$item->id)}}"><i class="fas fa-edit"></i></a>
             </td>
             <td>
               <a href="{{url('admin/add_delivery/'.$item->id)}}" title="Add delivery Boy"><i class="fas fa-plus "></i></a>
               <a href="{{url('admin/delete_delivery/'.$item->id)}}"  title="Delete delivery Boy"><i class="fas fa-trash text-danger ml-1"></i></a>  
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