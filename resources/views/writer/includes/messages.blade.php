<div id="o_messages" class="tab-pane fade">
    <h3>Messages</h3>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Messages</div>
            </div>
            <div class="panel-body" >
                <div id="div1" class="row" style="max-height: 400px; overflow-y: scroll">
                    <div class="chat">
                        @foreach($order->messages as $message)
                            @if($message->sender==0)
                                <hr/>
                                <div class="bubble me row">{{ $message->message }}</div><br/>
                            @else
                                <hr/>
                                <div class="bubble you row">{{ $message->message }}</div><br/>
                            @endif
                        @endforeach
                    </div>
                </div>
                <hr>
                <form id="messageform" method="post" action="{{ URL::to("messages/ordermessages/$order->id") }}" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            {{ csrf_field() }}
                            <input type="hidden" name="sender" value="0">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="client_id" value="{{ $order->user->id }}">
                            <textarea required id="newmessage" name="message" class="form-control" placeholder="Compose new Message"></textarea>
                            <button type="submit" onclick="return sendMessage();" class="btn btn-default pull-right"><i class="fa fa-mail-forward"></i>Send</button>
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
    scrollDown();
    function getMessages(){
        var count = "";
        var url = $("#messageform").attr('action');
        $.get(url,{count:count},function(response){
            $(".chat").html('');
            var messages = JSON.parse(response);
            for(var i =0;i<messages.length;i++){
                var message = messages[i];
                if(message.sender==1){
                    $(".chat").append('<hr/><div class="bubble you row">'+message.message+'</div><br/>');
                }else{
                    $(".chat").append('<hr/><div class="bubble me row">'+message.message+'</div><br/>');
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
                    $(".chat").append('<hr/><div class="bubble you row">'+message.message+'</div><br/>');
                }else{
                    $(".chat").append('<hr/><div class="bubble me row">'+message.message+'</div><br/>');
                }
            }
        });
        scrollDown();
        return false;
    }
</script>