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
     <div class="card p-2  text-white"style="background-color:hsl(32, 63%, 16%);">
       <div class="card-header text-center text-white">{{ __('Add Product..') }}</div>
        <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
             <form action="{{url('admin/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                 <label for="name">Product Name:</label>
                 <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('name')}}</span>
                <div class="form-group col-md-6">
                <label for="category_id">Category:</label>
                <select name="category_id" id="Ctaegory" class="form-control">
                   <option value="">Select Category</option> 
                   @foreach ($categories as $item)
                   <option value="{{$item->id}}">{{$item->name}}</option>
                   @endforeach
                </select>         
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('name')}}</span>
                </div>
                <div class="form-row">
     
                
                <div class="form-group col-md-4">
                 <label for="quantity">Quantity:</label>
                 <input type="number" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('quantity')}}</span>
                <div class="form-group col-md-4">
                 <label for="unit">Unit:</label>
                 <input type="text" class="form-control" id="unit" name="unit" placeholder="ex:litre,kg,Dozen"value="{{old('unit')}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('unit')}}</span>
                <div class="form-group col-md-4">
                 <label for="price">Price:</label>
                 <input type="number" class="form-control" id="price" name="price" value="{{old('price')}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('price')}}</span>
                </div>
                <div class="form-group">
                <label for="description">Description:</label>
               <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
               </div>
               <span class="text-white text-weight-bold my-2"> {{$errors->first('description')}}</span>
           
              <div class="form-group">
             <label for="image">Image:</label>
             <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}">
             </div>
             <span class="text-white text-weight-bold my-2"> {{$errors->first('image')}}</span>                        
            <button type="submit" class="btn btn-outline-warning w-100">Add Product</button>
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