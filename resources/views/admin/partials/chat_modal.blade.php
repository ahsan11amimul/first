<div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="chat"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title" id="chat">Welcome mr: {{Auth::user()->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <div class="form-group">
                        <label for="comment">Messages:</label>
                        <textarea class="form-control" rows="10" cols="30" id="comment">
                            {{App\Message::where('reciever_id',Auth::user()->id)->message}}
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                 <form action="">
                    <div class="input-group form-group mb-3">
                        <input type="text" class="form-control" size="100">
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="submit" >Send</button>
                        </div>
                    </div>
                 </form>   
                </div>
            </div>
        </div>
    </div>
    </div>