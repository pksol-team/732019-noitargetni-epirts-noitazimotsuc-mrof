@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <?php
    $decrease_percent = $bid->user->writerCategory->deadline;
    if($order->bidmapper->deadline == '0000-00-00 00:00:00'){
        $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
        $decrease_percent = 100-$decrease_percent;
        $decrease_percent = $decrease_percent/100;
        $new_hours = $c_deadline->diffInHours()*$decrease_percent;
        $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
    }else{
        $b_deadline = $order->bidmapper->deadline;
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                View Bid:<strong>#{{ $bid->id }}</strong> On Order:<strong>#{{ $order->id.'-'.$order->topic }}</strong> Order Amount: <strong>{{  number_format($order->amount,2) }}</strong> Deadline <strong>{{ date('d M Y, h:i a',strtotime($order->deadline)) }}</strong>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-5">
                <table class="table table-condensed table-bordered">
                    <tr>
                        <th>Writer#</th>
                        <td>{{ $bid->user->id }}</td>
                    </tr>
                    <tr>
                        <th>Amount ({{ $order->currency_id == 0 ? 'USD':$order->currency->abbrev }})</th>

                        <td>{{ number_format($order->currency_id == 0 ? $bid->amount:$bid->amount*$order->currency->rate,2) }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Message</th>
                    </tr>
                    <tr>
                        <td colspan="2">{{ $bid->message }}</td>
                    </tr>
                    <tr>
                        <th>On</th>
                        <td>{{ date('d M Y, h:i a',strtotime($bid->created_at)) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign to Writer</div>
                    <div class="panel-body">
                        @if($order->paid==0 || $order->status == 0)
                            <form class="form-horizontal" method="post" onsubmit="return runPlainRequest('{{ URL::to("stud/order/$order->id/bid/$bid->id") }}',{{ $bid->id }})" action="">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label class="control-label col-md-2">Amount</label>
                                    <div class="col-md-8">
                                        <input disabled class="form-control" type="text" name="amount" value="{{ number_format($order->currency_id == 0 ? $bid->amount:$bid->amount*$order->currency->rate,2) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Deadline</label>
                                    <div class="col-md-8">
                                        <input type="text" disabled name="deadline" value="{{ $order->deadline }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">&nbsp;</label>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-thumbs-up"></i> Assign</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info">
                                This order has been assigned to another writer
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
                                ?>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message_date->diffForHumans() }}</td>
                                    <td>{{ $message->user_id == Auth::user()->id ? "Me":"Writer#".$message->user_id }}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $messages->links() }}
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
@endsection