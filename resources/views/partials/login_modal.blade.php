<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="login">Login to Continue Shopping</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('signin')}}" method="POST">
         @csrf
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope fa-lg text-info"></i></span>
            </div>
          <input type="email" class="form-control" placeholder="Email" name="email" id="email"value="{{old('email')}}">
             
          </div>
           <span class="text-danger">{{$errors->first('email')}}</span>
           <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
          <input type="password" class="form-control" placeholder="Password" name="password" id="password"value="{{old('password')}}">
             
          </div>
           <span class="text-danger text-bold">{{$errors->first('password')}}</span>
           <div class="input-group form-group">
            <div class="input-group-prepend">
               <span class="input-group-text"><i class="fas fa-user fa-lg text-info"></i></span>
            </div>
            <select name="role_id" id="role_id" class="form-control">
              <option value="">Select Your Type</option>
              <option value="1">Customer</option>
              <option value="2">Farmer</option>
              <option value="11">Admin</option>
            </select>
            
          </div> 
          <span class="text-danger ">{{$errors->first('role_id')}}</span>
          <button type="submit" class="btn btn-outline-warning w-100">Login</button>
       </form>
      </div>
      <div class="modal-footer">
      <p class="text-danger ">Don't Have an account??<a href="{{url('/signup')}}">Sign Up here</a></p>
      <p class="text-warning ">Forget password??<a href="{{url('/forget_password')}}">Click Here</a></p>
        
      </div>
    </div>
  </div>
</div>