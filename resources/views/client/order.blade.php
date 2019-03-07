 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <?php
    $now = date('y-m-d H:i:s');
    $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
    $assigns = $order->assigns()->get();
            $assign_ids = [];

     foreach($assigns as $assign){
         $assign_ids[] = $assign->id;
     }

    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Order Topic: </strong>{{ $order->topic }}
            </div>
        </div>
        <div class="panel-body">
            <h2>Order Details</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a class="btn btn-info" data-toggle="tab" href="#o_order">Order</a></li>
                {{--<li><a data-toggle="tab" href="#o_bids">Bids<span class="badge">{{ count($order->bids) }}</span> </a></li>--}}
                <li><a class="btn btn-success" data-toggle="tab" href="#o_files">Files<span class="badge">{{ $order->files()->where([
                    ['allow_client','=',1]
                ])->count()+\App\File::whereIn('assign_id',$assign_ids)->where([
                    ['allow_client','=',1]
                ])->count() }}</span></a></li>
                <li><a class="btn btn-primary" data-toggle="tab" onclick="markRead();" href="#o_messages">Messages<span class="badge">{{ $order->messages()->where([
                ['seen','=',0],
                ['sender','=',1]
                ])->count() }}</span></a></li>
            </ul>


            <div class="tab-content">

                @if($order->status == 4)
                    <div class="alert alert-info">
                        You have not approved this order. Please click the link below to approve and rate our writer.<br/>
                        <a class="btn btn-warning btn-xs" href="{{ URL::to('stud/approve/'.''.$order->id) }}"><i class="fa fa-thumbs-up"></i> Approve Now</a>

                    </div>
                @endif
                @include('client.includes.order')
                {{--@include('client.includes.bids')--}}
                @include('client.includes.messages')
                @include('client.includes.files')
            </div>
        </div>
    </div>
    @if($order->amount == 0 && $website->min_cpp >0 && $order->quote_amount == 0)
        <div class="modal fade" role="dialog" id="quote_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4>Thank you for placing an order with us</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="post" action="{{ url("stud/order/$order->id/quote") }}">
                            {{ csrf_field() }}
                            <div class="alert alert-info">Please let us know how much you are willing to pay for this order, we are always online and will approve it as soon as possible for you to proceed and make payment. <br/> Thank you</div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Order Amount(USD)</label>
                                <div class="col-md-4">
                                    <input type="text" name="quote" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">&nbsp;</label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery("#quote_modal").modal('show');
        </script>
    @endif
    @if(request('approved') == 1)
        <div class="modal fade" role="dialog" id="quote_accepted">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a class="btn btn-danger pull-right" data-dismiss="modal">&times;</a>
                            <h4>Success!</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div style="font-size: larger;" class="alert alert-success">Your quote has been approved automatically by the system, please proceed to pay for your order. Our writers have already been notified and the best will be selected to work on your order ASAP</div>
                        <a class="btn btn-success" href="{{ URL::to('stud/pay/'.''.$order->id) }}"><i class="fa fa-paypal"></i> Pay</a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery("#quote_accepted").modal('show');
        </script>
    @elseif(request('approved') == 'no')
        <div class="modal fade" role="dialog" id="quote_accepted">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a class="btn btn-danger pull-right" data-dismiss="modal">&times;</a>
                            <h4>Thank You!</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div style="font-size: larger;" class="alert alert-success">Your quote has been received and our support team have already been notified, You will be notified immediately your order quote is approved. You will then be able to pay for it and our writers will start working on it ASAP.<br/>Thank you for placing an order with us</div>
                        <a class="btn btn-success" href="{{ URL::to('stud/pay/'.''.$order->id) }}"><i class="fa fa-paypal"></i> Pay</a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery("#quote_accepted").modal('show');
        </script>
    @endif
@endsection