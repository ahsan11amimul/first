@extends('admin.layouts.master')
@section('title')
   view Customer
@endsection
@section('content')
@if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
<a href="{{url('admin/show_customer')}}" class="btn btn-warning text-center">All Users <span class="text-white">{{$users->count()}}</span></a>        
</div> 
<div class="row">
           
    <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Status</td>
                <th>Role</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
            <td>{{$item->id}}</td>  
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->phone}}</td>
            <td>{{$item->address}}</td>
            <td class="text-success text-bold">{{$item->login_status?'Online':'Offline'}}</td>
            <td>{{$item->role->name}}</td>
           
            
            <td>
                
                <a href="{{url('admin/single_customer/'.$item->id)}}" class="p-2" title="Users history"><i class="fas fa-edit text-primary text-warning fa-lg"></i></a>
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