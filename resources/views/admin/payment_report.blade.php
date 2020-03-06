@extends('admin.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
{{--mainnav--}}
@include('admin.partials.nav')

@include('admin.partials.modal')
{{-- end main nav--}}
<div class="container-fluid">
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
    <div class="row justify-content-center">
     
     <table id="example" class="table table-hover table-striped table-responsive" style="width:100%">
          <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Sender</th>
                <th>Reciever</th>
                <th>Transaction Id</th>
                <th>Amount</th>
                <th>Date</th>
              
              
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_sell=0;
            $total_buy=0;
                  
            ?>
            @foreach ($payments as $item)
             <tr>
             <td>{{$item->id}}</td>
             <td>{{$item->from}}</td>
             <td>{{$item->to}}</td>
             <td>{{$item->trx}}</td>
             <td>{{$item->amount}}</td>   
             <td>{{$item->created_at}}</td>
            
             <?php 
            if($item->from==='01721544957')
            {
                $total_buy+=$item->amount;
              
            }else {
                $total_sell+=$item->amount;
            }
            
            ?>
              
             </tr>
           
              
            @endforeach
        </tbody>
     </table>
   
     {{-- {{ $orders->links() }}  --}}
        </div>
     <h5 class="text-success px-3">Total Online Cost Amount: {{$total_buy}} -Tk</h5>
    <h5 class="text-danger px-3 ">Total Online Sell Amount: {{$total_sell}} -Tk</h5>
</div>
{{--footer--}}
@include('admin.partials.footer')
@endsection