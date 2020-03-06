<div class="container-fluid">
 <div id="top-nav">
    <div class="row">
        <div class="col-md-6 col-6">
        <a href="#"><span class="text-danger mr-3">Wellcome mr: {{Auth::user()->name}}</span>Contact Us:<i class="fas fa-envelope fa-lg px-1 text-info"></i></a>
        
        </div>
        <div class="col-md-4 col-6">
           <a href="#">Call:<i class="fas fa-phone fa-lg px-1 text-info"></i>01721-544957</a> 
        </div>
        <div class="col-md-2 col-6">
        <a href="{{url('/signin')}}"><i class="fas fa-user-circle fa-lg px-1 text-warning"></i> Farmer Land</a>
        </div>
    </div>
    
     
 </div>
</div>