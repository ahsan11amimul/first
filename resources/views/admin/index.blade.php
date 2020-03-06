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

{{--main content--}}

@include('admin.partials.main')
</div>
{{--end maincontent--}}
</div>
 
@include('admin.partials.footer')

@endsection