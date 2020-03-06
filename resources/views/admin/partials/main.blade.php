<div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row ">
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                                     <div class="text-right text-secondary">
                                         <h5>Sales</h5>
                                         <h3>{{App\Order::totalCost()}} -Tk</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                             <a href="{{url('admin/sales_report')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                             </div>
                         </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-money-bill-alt fa-3x text-success"></i>
                                <div class="text-right text-secondary">
                                    <h5>Total Cost</h5>
                                    <h3>{{App\Product::totalPrice()}} -Tk</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
                              <a href="{{url('admin/cost_report')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                        </div>
                    </div>
                    </div>
                   <div class="col-xl-3  col-sm-6 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-money-bill-alt fa-3x text-danger"></i>
                                <div class="text-right text-secondary">
                                    <h5>Payment</h5>
                                    <h3>{{App\Payment::totalCost()}} -TK</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
                        <a href="{{url('/payment_report')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                        </div>
                    </div>
                   </div>
                 <div class="col-sm-6 col-xl-3 p-2">
                    <div class="card card-common">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <i class="fas fa-users fa-3x text-primary"></i>
                                <div class="text-right text-secondary">
                                    <h5>Users</h5>
                                    <h3>{{$users->count()}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-secondary">
                            <i class="fas fa-sync mr-3"></i>
                            <span>Updated now</span>
             <a href="{{url('admin/show_customer')}}" title="View Details"><i class="fas fa-eye fa-lg text-info ml-5"></i></a>

                        </div>
                    </div>
                </div> 
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-shopping-cart fa-3x text-danger"></i>
                                     <div class="text-right text-secondary">
                                         <h5>Orders</h5>
                                         <h3>{{$orders->count()}}</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                                <a href="{{url('admin/index')}}" title="View Details"><i class="fas fa-eye fa-lg text-success ml-5"></i></a>

                             </div>
                         </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-heart fa-3x text-danger"></i>
                                     <div class="text-right text-secondary">
                                         <h5>New Items</h5>
                                         <h3>{{$new_products->count()}}</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                                <a href="{{url('admin/new_products')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                             </div>
                         </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-edit fa-3x text-danger"></i>
                                     <div class="text-right text-secondary">
                                         <h5>Low Quantity</h5>
                                     <h3>{{$low_products->count()}}</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                                    <a href="{{url('admin/low_products')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                             </div>
                         </div>
                    </div>
                    <div class="col-xl-3  col-sm-6 p-2">
                         <div class="card card-common">
                             <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                     <i class="fas fa-heart fa-3x text-danger"></i>
                                     <div class="text-right text-secondary">
                                         <h5>Online Products</h5>
                                         <h3>{{$products->count()}}</h3>
                                     </div>
                                 </div>
                             </div>
                             <div class="card-footer text-secondary">
                                 <i class="fas fa-sync mr-3"></i>
                                 <span>Updated now</span>
                                  <a href="{{url('admin/products_report')}}" title="View Details"><i class="fas fa-eye fa-lg text-warning ml-5"></i></a>
                             </div>
                         </div>
                    </div>
            </div>
            <div class="row py-4"> 
            <div class="col-md-12">
            <h5 class="text-center bg-dark text-white p-3">All Orders</h5>
            </div>
            </div>
        
    <div class="row ml-2">      
        <div class="col-md-12 text-danger text-bold text-center">
           Print History
            ​<button onclick="myFunction()" class="btn btn-danger btn-sm "> <i class="fas fa-print"></i></button>

                <script>
                function myFunction() { window.print(); }
                </script>
        </div> 
    <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Total</th>
                <th>Area</th>
                <th>Payment</th>
                <th>Delivery</th>
                <th>Approved</th>
                <th>Status</th>
                <th>Order Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item)
                <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->total}}</td>
                <td>{{$item->user->area->name}}</td>
                <td>{{$item->payment_method}}</td>
                <td>{{$item->delivered_by}}</td>
                <td>{{$item->approved_by}}</td>
                <td>{{$item->status?'Approved':'Pending'}}</td>
                <td>
                <a href="{{url('admin/view_order/'.$item->id)}}" class="p-2" title="View Details"><i class="fas fa-eye  text-success fa-lg"></i></a>
                @if($item->status==0)
                    <a href="{{url('admin/delete_order/'.$item->id)}}" class="p-2" title="Delete this"><i class="fas fa-trash-alt  text-danger fa-lg"></i></a>
                @endif
                </td>
                </tr>
            @endforeach
        </tbody>
     </table>
    
    </div>
    
  </div>

