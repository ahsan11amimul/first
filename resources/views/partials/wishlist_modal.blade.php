<!-- Modal -->
    <div class="modal fade" id="wishlist" tabindex="-1" role="dialog" aria-labelledby="wishlist"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                <h5 class="modal-title" id="wishlist">Dear Guest you have {{App\Wishlist::totalItem()}} items into your wishlist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Remove</th>
                                <th>Add To Cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Wishlist::wishItem() as $item)
                                <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                
                             <td>
                    <a href="{{url('delete_item/'.$item->id)}}" title="Delete Items from your wishlist"> <i class="fas fa-trash text-danger fa-lg"></i></a>
                              </td>
                              <td>
                     <form action="{{route('add_cart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$item->product_id}}"> 
                     <span class="text-danger">{{$errors->first('product_id')}}</span>
                        <button type="submit" class=" btn btn-outline-warning "><i class="fas fa-shopping-cart"></i>Add to cart</button>
                        </form>
                              </td>
                            </tr>
                            
                            @endforeach
                       
                        </tbody>
                   
                    </table> 
 
                </div>
                <div class="modal-footer">
               <a href="{{url('/')}}" class="btn btn-info w-100">Continue Shopping</a>
                  </div>
                </div>
                
            </div>
        </div>
    