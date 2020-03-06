<div class="modal fade" id="account" tabindex="-1" role="dialog" aria-labelledby="account" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="account"> New Account </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{url('customer/create_account')}}" method="post">
        @csrf
         <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-info"></i></span>
            </div>
            <input type="text" placeholder="Phone Number" class="form-control" name="account_number" value="{{old('account_number')}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('account_number')}}</span>
         
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock fa-lg text-danger"></i></span>
            </div>
            <input type="password" placeholder="Pin Number" class="form-control" name="pin" id="pin"value="{{old('pin')}}">
       
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('pin')}}</span>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-money-bill fa-lg text-info"></i></span>
            </div>
            <input type="password" placeholder="Balance" class="form-control" name="balance" id="balance"value="{{old('balance')}}">
            <input type="hidden" name="id" value="{{$user->id}}">
         </div>
         <span class="text-danger text-bold my-2">{{$errors->first('balance')}}</span>
         <button type="submit" class="btn btn-outline-warning w-100">Create Account</button>
      
        </form>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
