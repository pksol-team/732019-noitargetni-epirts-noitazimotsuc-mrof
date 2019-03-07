@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <?php
    $cpp = Auth::user()->writerCategory->cpp;
    $decrease_percent = Auth::user()->writerCategory->deadline;
    $total = $bidmapper->bid_amount;
    $writer_amount = (1-($website->deduction_rate/100))*$total;
    $bid_amount = $bidmapper->bid_amount;
    $amount = $writer_amount;
    $client_charged = $bidmapper->bid_amount;
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Place Bid For Order: <strong>#{{ $order->id }}</strong> Topic: <strong>{{ $order->topic }}</Strong> Page(s):<Strong>{{ $order->pages }}</strong>
            </div>
        </div>
        <div class="panel-body">
            <div class="alert alert-info">
                This is a designer order, please estimate your best bid amount that will be favourable to the client.
            </div>
            @if(count($mybid)>0)
                <?php
                    $bid = $mybid;
                    $commission = (1+($website->getCommission()));
                $amount = $mybid->amount;
                $writer_amount = $amount/$commission;
                $client_charged = $mybid->amount;
                    $amount = $writer_amount;
                $message = $mybid->message;
                ?>
                <div class="alert alert-info">You have already placed a bid for this order. You can update it here.</div>
            @else
                <?php
                if($bidmapper->bid_amount){
                    //  $amount = $bidmapper->bid_amount;
                } else{
                    // $amount = $cpp*$order->pages;
                }
                $message = "";

                ?>
            @endif
            <form class="form-horizontal ajax-load" method="post" action="{{ URL::to('/writer/bid/'.$bidmapper->id) }}">
                {{ csrf_field() }}
                <div class="form-group">

                    <label for="amount" class="control-label col-md-3">Your Bid (USD)</label>
                    <div class="col-md-3">
                        <input type="text" value="{{ $amount }}" onkeyup="chargeClient();" name="bid_amount" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="amount" class="control-label col-md-3">Client Charged (USD)</label>
                    <div class="col-md-3">
                        <input disabled type="text" value="{{  number_format($client_charged,2) }}" onchange="" class="form-control client_charged">
                        <input type="hidden" value="{{  number_format($client_charged,2) }}" onchange="" name="amount" class="form-control client_charged">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Message</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="message">{{ $message }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(count($mybid)>0)
        <div class="row"></div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Bid Messages
                        <a href="#i_message_modal" data-toggle="modal" class="btn btn-success btn-lg pull-right"><i class="fa fa-plus"></i> New Message</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>From</th>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach($messages = $bid->messages()->orderBy('id','desc')->paginate(5) as $message)
                            <?php
                            $message_date = \Carbon\Carbon::createFromTimestamp(strtotime($message->created_at));
                            if($message->isRead() == false && $message->user_id != Auth::user()->id){
                                $message->markRead();
                            }
                            ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message_date->diffForHumans() }}</td>
                                <td>{{ $message->user_id == Auth::user()->id ? "Me":"Client#".$message->user_id }}</td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $messages->links() }}
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
                        <form id="messageform" class="ajax-post form-horizontal" method="post" action="{{ URL::to("stud/order/$order->id/bid/$bid->id") }}" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Message</label>
                                <div class="col-md-8">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                                    <textarea required id="newmessage" name="message" class="form-control" placeholder="Compose new Message"></textarea>
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
    @endif


    <script type="text/javascript">
        function chargeClient(){
            var total = $("input[name='bid_amount']").val();
            var increase = parseFloat('{{ (($website->commission/100)) }}')+1;
            total = parseFloat(total);
            var client_charged = increase*total;
            $(".client_charged").val(client_charged.toFixed(2));
        }
    </script>
@endsection