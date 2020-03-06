<div class="col-md-4 col-lg-3 col-xl-2 col-5" id="sidebar">
       
<div class="list-group">
<a href="{{url('admin/profile/'.Auth::user()->id)}}" class="list-group-item list-group-item-action"><i class="fas fa-user-circle fa-lg text-info pr-3"></i>{{Auth::user()->name}}</a>
<a href="{{route('admin.view_area')}}" class="list-group-item list-group-item-action"><i class="fas fa-map-marker fa-lg text-info pr-3"></i>Areas</a>
 
 <a href="{{url('admin/view_product')}}" class="list-group-item list-group-item-action"><i class="fas fa-edit fa-lg text-info pr-3"></i>Products</a>
 <a href="{{url('admin/view_category')}}" class="list-group-item list-group-item-action"><i class="fas fa-edit fa-lg text-info pr-3"></i>Categories</a>
 <a href="{{url('admin/index')}}" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart fa-lg text-info pr-3"><span class="badge badge-danger"></span></i>Orders</a>
 <a href="{{url('admin/view_message')}}" class="list-group-item list-group-item-action"><i class="fas fa-envelope fa-lg text-info pr-3"><span class="badge badge-danger"></span></i>Messages</a>

 <a href="{{url('admin/show_customer')}}" class="list-group-item list-group-item-action"><i class="fas fa-user fa-lg text-info pr-3"><span class="badge badge-danger"></span></i>Users</a>
 <a href="{{url('admin/new_order')}}" class="list-group-item list-group-item-action"><i class="fas fa-shopping-basket fa-lg text-info pr-3"><span class="badge badge-danger"></span></i>New orders</a>
 <a href="{{url('/message')}}" class="list-group-item list-group-item-action"><i class="fas fa-comment-alt fa-lg text-info pr-3"><span class="badge badge-danger"></span></i>Live chat</a>
 <a href="{{route('logout')}}" class="list-group-item list-group-item-action"><i class="fas fa-power-off fa-lg text-info pr-3"></i>Logout</a>
 
  
  
  
  
  
</div>
</div>