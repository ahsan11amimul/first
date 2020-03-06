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
       <div class="card-header text-center text-white">{{ __('Published online..') }}</div>
        <div class="card-body" style="background-color: hsl(26, 87%, 33%);">
             <form action="{{url('admin/single_product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                <div class="form-group col-md-6">
                 <label for="name">Product Name:</label>
                 <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('name')}}</span>

                <div class="form-group col-md-6">
                <label for="category_id">Category:</label>
                <select name="category_id" id="Category" class="form-control">
                <option value="{{$product->category_id}}">{{$product->category->name}}</option>  
                </select>         
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('category_id')}}</span>
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-3">
                 <label for="quantity">Quantity:</label>
                 <input type="number" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}"{{Auth::user()->id==$product->user_id?'':"readonly"}}>             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('quantity')}}</span>

                <div class="form-group col-md-3">
                 <label for="unit">Unit:</label>
                 <input type="text" class="form-control" id="unit" name="unit" placeholder="ex:litre,kg,Dozen"value="{{$product->unit}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('unit')}}</span>

                <div class="form-group col-md-3">
                 <label for="price">Price:</label>
                 <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('price')}}</span>

                <div class="form-group col-md-3">
                <label for="total">Total:</label>
                 <input type="number" class="form-control" id="total" name="total" value="">             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('total')}}</span>
                 </div>
                 <div class="form-row">
                 <div class="form-group col-md-6">
                 <label for="customer">Farmer:</label>
                 <input type="text" class="form-control" id="customer" name="customer" value="{{$product->user->name}}" readonly>             
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('total')}}</span>
                <div class="form-group col-md-6">
                <label for="customer">Status:</label>
                <input type="number" class="form-control" id="status" name="status" value="{{$product->status}}">             
                </div>
                </div>
                <span class="text-white text-weight-bold my-2"> {{$errors->first('total')}}</span>
                <div class="form-group">
                <label for="description">Description:</label>
               <input type="text" class="form-control" id="description" name="description" value="{{$product->description}}">
               </div>
               <span class="text-white text-weight-bold my-2"> {{$errors->first('description')}}</span>
             <div class="form-row">
          
             <div class="form-group col-md-8">
             <label for="image">Image:</label>
             <input type="file" class="form-control" id="image" name="image">
              <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{$product->image}}">
             </div>
             <span class="text-white text-weight-bold my-2"> {{$errors->first('image')}}</span> 
            </div>
             <img src="{{asset('storage/uploads/'.$product->image)}}" alt="" style="width:150px;height:100px" class="image-thumbnail mb-2">
             
                                
        <button type="submit" class="btn btn-outline-warning w-100">{{$product->status?' Send to Offline':'Published Online'}}</button>
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