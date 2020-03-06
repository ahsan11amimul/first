<div class="col-md-4 col-lg-3 col-5">
    <div class="title-box w-100">
       <h5>Catgeories</h5>
    </div>
<div class="list-group">
  @foreach ($categories as $item)
<a href="{{url('/category/'.$item->id)}}"title="Visit {{$item->name}} details Page" class="list-group-item list-group-item-action font-weight-bold text-capitalize">{{$item->name}} 
<span class="badge badge-warning">{{$item->products->count()}}</span></a>   
  @endforeach
</div>
</div>