@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
<div class="container"> 
    <div class="row mt-5">
        <div class="col-md-9">
       <h5 class="text-bold text-success"> <a href="{{url('customer/index')}}">OrganicStore <sub class="text-muted">.com</sub> </a></h5>
        </div>
        <div class="col-md-3 text-danger text-bold">
           Print History
            ​<button onclick="myFunction()" class="btn btn-danger btn-sm ml-5"> <i class="fas fa-print"></i></button>

                <script>
                function myFunction() { window.print(); }
                </script>
        </div>
       
    </div>
    
   
    <div class="row py-4 justify-content-center">
        <table id="example" class="table table-hover table-stripped table-responsive">
            <thead class="table-dark">
                <tr>
                    <td>SL</td>
                    <td>Name</td>
                    <td>Total</td>
                    <td>Status</td>
                    <td>Issued By</td>
                    <td>Order date</td>
                    <td>Payment</td>
                    <td>From</td>
                    <td>To</td> 
                </tr>
            </thead>
            <tbody>
                    <?php $totals=0;?>  
               @foreach ($orders as $item)
                    
                   <tr>
                   <td>{{$item->id}}</td>
                   <td>{{$item->user->name}}</td>
                   <td>{{$item->total}}</td>
                   <td>{{$item->status?'Approved':'Pending'}}</td>
                   <td>{{$item->approved_by}}</td>
                   <td>{{date_format($item->created_at,'d-M-y')}}</td>
                   <td>{{$item->payment_method}}</td>
                   <td>{{$item->trx?App\Payment::where('trx',$item->trx)->value('from'):$item->user->name}}</td>
                  <td>{{$item->trx?App\Payment::where('trx',$item->trx)->value('to'):$item->delivered_by}}</td>
                   </tr>
                    <?php $totals+=$item->total ?>
              
            
               @endforeach
                </tbody>
        </table>
         <h5 class="text-success px-3">Total Order Amount:{{$totals}} -Tk</h5>
    </div>
   
    <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>
</div>
@endsection