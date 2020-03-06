<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-danger" id="logout">Want to Leave Mr: {{Auth::user()->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-warning">
      For Sign out Please Press logout button??
         </div>    
         <div class="modal-footer"> 
      <button type="button" class="close btn btn-outline-success" data-dismiss="modal" aria-label="Close">Stay here??</button>
       <a href="{{route('logout')}}" class="btn btn-outline-warning">Logout</a>
        </div>  
      
        
     
    </div>
  </div>
</div>