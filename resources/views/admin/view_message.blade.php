@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')
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

@include('admin.partials.modal')
{{-- end main nav--}}
<div class="container">
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
<div class="row">
           <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Reciever</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Reply</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                    <tr>
                    <td>{{$item->id}}</td>
                    <td><?php $sender=App\User::where('id',$item->sender_id)->first();
                    echo $sender->name;
                    ?></td>
                    <td>{{$item->message}}</td>
                    <td><?php $reciever=App\User::where('id',$item->reciever_id)->first();
                    echo $reciever->name;
                    ?></td>
                    <td><a href="{{url('admin/edit_product/'.$item->product_id)}}">
                    <?php $product=App\Product::where('id',$item->product_id)->first();
                    echo $product->name;
                    ?> </a>
                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>  
                    <form action="{{url('admin/need_product')}}" method="POST">
                    @csrf
                    <input type="hidden" name="reciever_id" value="{{$item->sender_id}}">
                    <input type="hidden" name="product_id" value="{{$item->product_id}}">
                    <input type="hidden" name="sender_id" value="{{$item->reciever_id}}">
                    <input type="text" name="message" id="message" required> 
                    <button class="btn btn-success btn-sm float-right" type="submit"><i class="fas fa-envelope"></i></button>  
                    </form>
                    </td>
                    </tr>
                    @endforeach
                
                </tbody>
            </table>
       </div>
           
          

</div>
{{--footer--}}
@include('admin.partials.footer')

@endsection