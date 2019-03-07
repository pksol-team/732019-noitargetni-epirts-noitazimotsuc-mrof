 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Completed Orders</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Cost</th>
                    @if($website->designer == 1)
                        <th>Designer ID</th>
                    @else
                        <th>Writer ID</th>
                        <th>Pages</th>
                    @endif
                    <th>Action</th>
                </tr>

                @foreach($orders as $order)
                    <?php
                    $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
                    ?>
                    <tr class="tabular">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->topic  }}</td>
                        <td>{{ $order->subject->label  }}</td>
                        <td>{{ $order->document->label  }}</td>
                        <td>{{ $order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2) }}</td>

                        <td>
                            @if($assign = $order->assigns()->where('status','<=','4')->first())
                                {{ $assign->user_id }}
                            @else
                                --
                            @endif
                        </td>
                        @if($website->designer == 1)

                        @else
                            <td>{{ $order->pages }}</td>
                        @endif<td>
                              <a class="btn btn-info btn-xs" href="{{ URL::to('stud/order/'.''.$order->id.'#o_files') }}"><i class="fa fa-file"></i> Files</a>

                            <a class="btn btn-info btn-xs" href="{{ URL::to('stud/order/'.''.$order->id) }}"><i class="fa fa-eye"></i> View</a>
                            @if($order->status==4)
                            <a class="btn btn-success btn-xs" href="{{ URL::to('stud/approve/'.''.$order->id) }}"><i class="fa fa-thumbs-up"></i> Approve</a>
                           @elseif($order->status == 4)
                           <a class="btn btn-danger btn-xs" href="{{ URL::to('stud/dispute/'.''.$order->id) }}"><i class="fa fa-thumbs-down"></i> Revise</a>
                            @endif
                            @if($order->amount > $order->getTotalPaid())
                              <a class="btn btn-success btn-sm" href="{{ URL::to('stud/pay/'.''.$order->id) }}"><i class="fa fa-paypal"></i> Pay Pending({{ @number_format($order->amount-$order->payments()->sum('amount'),2) }})</a>
                            @endif

                            <?php
                                $completed = \Carbon\Carbon::createFromTimestamp(strtotime($order->updated_at));
                                if($order->status == 6 && $completed->diffInDays() < 14){
                                    ?>
                            <a class="btn btn-danger btn-xs" href="{{ URL::to('stud/dispute/'.''.$order->id) }}"><i class="fa fa-thumbs-down"></i> Revise</a>
                        <?php
                                }
                                ?>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="{{ URL::to('stud/order/'.''.$order->id) }}">{{ $order->id }} - {{ $order->topic  }}</a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="{{ URL::to('stud/order/'.''.$order->id) }}"><i class="fa fa-eye"></i> View</a>
                            @if($order->status==4 && $order->amount <= $order->payments()->sum('amount'))
                             <a class="btn btn-success btn-sm" href="{{ URL::to('stud/pay/'.''.$order->id) }}"><i class="fa fa-paypal"></i> Pay Pending({{ @number_format($order->amount-$order->payments()->sum('amount'),2) }})</a>
                            <a class="btn btn-success btn-xs" href="{{ URL::to('stud/approve/'.''.$order->id) }}"><i class="fa fa-thumbs-up"></i> Approve</a>
                           @elseif($order->status == 4)
                           <a class="btn btn-danger btn-xs" href="{{ URL::to('stud/dispute/'.''.$order->id) }}"><i class="fa fa-thumbs-down"></i> Revise</a>
                            @endif
                             @if($order->amount > $order->payments()->sum('amount'))
                              <a class="btn btn-success btn-sm" href="{{ URL::to('stud/pay/'.''.$order->id) }}"><i class="fa fa-paypal"></i> Pay Pending({{ @number_format($order->amount-$order->payments()->sum('amount'),2) }})</a>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong>{{ $order->subject->label  }}</div>
                            <div class="col-sm-3"><strong>Pages: </strong>{{ $order->pages  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Placed: </strong>{{ date('d M Y, h:i a',strtotime($order->created_at)) }}</div>
                            <div class="col-sm-2"><strong>Cost: </strong>{{ $order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2) }}</div>
                        </div>

                    </div>
            @endforeach
            </table>
            {{ $orders->links()  }}
        </div>
    </div>
@endsection