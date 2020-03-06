@extends('admin.layouts.master')
@section('title')
   view Category
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
  <a href="{{url('admin/add_category')}}" class="btn btn-warning text-center">Add New Category</a>        
  </div> 
<div class="row">
           
    <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>description</th>
               
                <th>Products</th>
                <th> Category Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
            <tr>
           <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
           
            <td>{{$item->products->count()}}</td>
            <td>
                <a href="{{url('admin/single_category/'.$item->id)}}" class="p-2" title="View Details"><i class="fas fa-eye  text-success fa-lg"></i></a>
                <a href="{{url('admin/delete_category/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
                <a href="{{url('admin/edit_category/'.$item->id)}}" class="p-2" title="Edit this"><i class="fas fa-edit text-primary text-warning fa-lg"></i></a>
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