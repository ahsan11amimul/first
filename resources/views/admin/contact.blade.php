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
                        <th>SL</th>
                        <th>Name</th>
                        <th>Sender</th>
                        <th>Message</th>
                        <th>Reciever</th>
                        <th>Date</th>
                        <th>Delete</th>
                        <th>Reply</th>
                      
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($contacts as $item)
                    <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->message}}</td>
                    <td><?php $reciever=App\User::where('role_id',11)->first();
                    echo $reciever->email;
                    ?></td>
                    <td>{{$item->created_at}}</td>
                    <td><a href="{{url('admin/contact_delete/'.$item->id)}}"><i class="fas fa-trash text-danger"></i></a>
                    </td>
                    <td>
                    <form action="{{url('admin/contact_reply')}}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="{{$item->name}}">
                    
                    <input type="hidden" name="email" value="{{$item->email}}">
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