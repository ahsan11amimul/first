<!-- Modal -->
    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="cart"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                <h5 class="modal-title" id="cart">Dear {{Auth::user()->name}} you have {{App\Cart::totalItem()}} items price: Tk: {{App\Cart::totalPrice()}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Cart::cartsItem() as $item)
                                <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->price*$item->quantity}}</td>
                                <td>
                                    <a href="{{url('increment_cart/'.$item->id)}}" title="Add 1 Item in your cart"> <i class="fas fa-plus text-success"></i></a>
                                    <a href="{{url('delete_cart/'.$item->id)}}" title="Delete Items from your Bag"> <i class="fas fa-trash text-danger"></i></a>
                                    <a href="{{url('decrement_cart/'.$item->id)}}" title="Remove 1 Item from from your Bag"> <i class="fas fa-minus text-warning"></i></a>
                                </td>
                            </tr>
                            
                            @endforeach
                           <p class="w-100 text-muted">Total Price: {{App\Cart::totalPrice()}}</p> 
                        </tbody>
                 
                    </table> 
    <a href="{{url('/clear_cart')}}" class="btn btn-danger w-20 float-right">Clear Cart</a>
                </div>
                <div class="modal-footer">
               
                    <a href="{{url('/customer/index')}}" class="btn btn-info w-50">Continue Shopping</a>
                    <a href="{{url('/customer/checkout')}}" class="btn btn-warning w-50">Checkout</a>
                    
                </div>
                </div>
                
            </div>
        </div>
    