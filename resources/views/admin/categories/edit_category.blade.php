@extends('admin.layouts.master')
@section('title')
  Admin
@endsection
@section('content')


{{--mainnav--}}
@include('admin.partials.nav')
{{-- end main nav--}}
@include('admin.partials.modal')
{{--endmodal--}}
{{--main content--}}
<div class="container-fluid">

<div class="row">
{{-- sidebar --}}
@include('admin.partials.sidebar')
{{--end sidebar--}}
<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
<div class="row">
<div class="container mb-2">
  <div class="row justify-content-left">
   <div class="col-md-6">
     <div class="card p-2 text-white" style="background-color:hsl(32, 63%, 16%);">
       <div class="card-header text-center text-white">{{ __('Edit category..') }}</div>
        <div class="card-body"style="background-color: hsl(26, 87%, 33%);">
             <form action="{{url('admin/edit_category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                 <label for="name">Category Name:</label>
                 <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}">             
                </div>
                <span class="text-danger text-weight-bold my-2"> {{$errors->first('name')}}</span>
                <div class="form-group">
                <label for="description">Description:</label>
               <input type="text" class="form-control" id="description" name="description" value="{{$category->description}}">
               </div>
             <span class="text-danger text-weight-bold my-2"> {{$errors->first('description')}}</span>
           
              <div class="form-group">
             <label for="image">Image:</label>
             <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{$category->image}}">
             <input type="file" class="form-control" id="image" name="image" >
             </div> 
              <span class="text-danger text-weight-bold my-2"> {{$errors->first('image')}}</span>   
         <img src="{{asset('storage/uploads/'.$category->image)}}" alt="category image" style="width:150px;height:100px" class="image-thumbnail mb-2">
                                
            <button type="submit" class="btn btn-outline-warning w-100">Update Category</button>
            </form>            
        </div>
       </div>
     </div>
    </div>
 </div>
                   
 </div>
</div>    
{{--end maincontent--}}


{{--footer--}}
@include('admin.partials.footer')

    
  
@endsection