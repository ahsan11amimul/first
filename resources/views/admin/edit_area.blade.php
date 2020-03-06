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
     <div class="card p-2 text-white"style="background-color:hsl(32, 63%, 16%);">
       <div class="card-header text-center text-white">{{ __('Edit Area..') }}</div>
        <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
             <form action="{{url('admin/edit_area/'.$area->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                 <label for="name">Area Name:</label>
                 <input type="text" class="form-control" id="name" name="name" value="{{$area->name}}">
                </div>
                <span class="text-danger text-weight-bold my-2"> {{$errors->first('name')}}</span>
             
                <div class="form-group">
                 <label for="charge">Delivery Cost:</label>
                 <input type="number" class="form-control" id="charge" name="delivery_charge" value="{{$area->delivery_charge}}">             
                </div>
                <span class="text-danger text-weight-bold my-2"> {{$errors->first('delivery_charge')}}</span>
                </div>
                                
             <button type="submit" class="btn btn-outline-warning w-100">Edit Area</button>
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