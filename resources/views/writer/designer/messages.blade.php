<div id="o_messages" class="tab-pane fade">
    <h3>Messages</h3>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Messages</div>
            </div>
            <div class="panel-body" >           
                <a href="#i_message_modal" data-toggle="modal" class="btn btn-success btn-lg pull-right"><i class="fa fa-plus"></i> New Message</a>
                 <div class="row"></div>
                <div id="div1" class="row" style="max-height: 400px; overflow-y: scroll">
                    <div class="chat">
                        @foreach($order->messages()->orderBy('id','desc')->get() as $message)
                            @if($message->sender==0)
                                <hr>
                                <div class="bubble me"><?php echo $message->message ?>
                                    <br/>
                                    <strong style="color:blue;">To:<i>{{ ucwords($message->destination ? $message->destination:'Support') }}</i></strong>
                                    <br/><small><strong>{{ $message->created_at }}</strong></small>
                                </div>
                            @else
                                <hr>
                                <div class="bubble you"><?php echo $message->message ?>
                                    <br/>
                                    <strong style="color:blue;">From: <i>{{ ucwords($message->destination ? $message->destination:'Support') }}</i></strong>
                                    <br/>
                                    <small><strong>{{ $message->created_at }}</strong></small>
                                </div>
                            @endif
                        @endforeach

                       </div>
                    <hr/>
                   </div>
               
            </div>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="i_message_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <a class="btn btn-danger pull-right" data-dismiss="modal">&times;</a>
                    <h4>New Message</h4>
                </div>
            </div>
            <div class="modal-body">
                <form id="messageform" class="ajax-post form-horizontal" method="post" action="{{ URL::to("messages/ordermessages/$order->id") }}" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Message</label>
                        <div class="col-md-8">
                            {{ csrf_field() }}
                            <input type="hidden" name="sender" value="0">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="client_id" value="{{ $order->user->id }}">
                            <textarea required id="newmessage" name="message" class="form-control" placeholder="Compose new Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">To</label>
                        <div class="col-md-8">
                            <select name="destination" class="form-control">
                                <option value="support">Support</option>
                                <option value="writer">Writer</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                        <div class="col-md-8">
                           <button type="submit" class="btn btn-success">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //        setInterval(function(){
    //            getMessages();
    //        },5000);
    function scrollDown(){
        $("#div1").animate({ scrollTop: $('#div1')[0].scrollHeight}, 1000);
    }
    function markRead(){
        var url = $("#messageform").attr('action')+'/markread';
        var data = $("#messageform").serialize();
        $.get(url,data,function(response){
        });
    }

    function runAfterSubmit(messages){
            getMessages();
    }
    scrollDown();
    function getMessages(){
        var count = "";
        var url = $("#messageform").attr('action');
        $.get(url,{count:count},function(response){
            $(".chat").html('');
            var messages = response;
            for(var i =0;i<messages.length;i++){
                var message = messages[i];
                if(message.sender==1){
                    $(".chat").append('<hr><div class="bubble you">'+message.message+'<br/>' +
                            ' <strong>FROM:'+message.destination+'</strong><br/><small><strong>'+message.created_at+'</strong></div>');
                }else{
                    $(".chat").append('<hr><div class="bubble me">'+message.message+'<br/>' +
                           +' <strong>'+message.destination+'</strong><br/><small><strong>'+message.created_at+'</strong></div>');
                }
            }
        });
        scrollDown();
    }



    /**
     * Send a message to writer
     */
    function sendMessage(){
        var url = $("#messageform").attr('action');
        var data = $("#messageform").serialize();
        $.post(url,data,function(response){
            $(".chat").html('');
            $("#newmessage").val('');
            var messages = JSON.parse(response);
            for(var i =0;i<messages.length;i++){
                var message = messages[i];
                if(message.sender==1){
                    $(".chat").append('<hr><div class="bubble you">'+message.message+'<br/><small><strong>'+message.created_at+'</strong></div>');
                }else{
                    $(".chat").append('<hr><div class="bubble me">'+message.message+'<br/><small><strong>'+message.created_at+'</strong></div>');
                }
            }
        });
        scrollDown();
        return false;
    }
</script>