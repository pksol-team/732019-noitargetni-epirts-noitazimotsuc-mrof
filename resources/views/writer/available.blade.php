 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
<?php

        $writerCategory = Auth::user()->writerCategory;
//        if(!$writerCategory){
//            $writer = Auth::user();
//            $writerCategory = \App\WriterCategory::first();
//            $writer->writer_category_id = $writerCategory->id;
//            $writer->save();
//        }
        $cpp = $writerCategory->cpp;
        $decrease_percent = $writerCategory->deadline;
        $category_id = $writerCategory->id;
        ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Available</div>
        </div>
        <div class="panel-body">
            @if(Auth::user()->status==0)
                <div class="panel-body">
                    <div style="font-size: large;" class="alert alert-danger">
                        Hello {{ Auth::user()->name }},<br/>
                        Your account has not yet been activated.
                    </div>
                </div>
                @elseif(Auth::user()->suspended==1)
                <div style="font-size: large;" class="alert alert-danger">
                    Hello {{ Auth::user()->name }},<br/>
                    Your account has been suspended
                </div>
                @else
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>Amount</th>
                    <th>Bids</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                @foreach($bidmappers as $bidmapper)
                    <?php
                    $order = $bidmapper->order;
                    $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($bidmapper->deadline));

                    $c_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));

                    if($bidmapper->deadline == '0000-00-00 00:00:00'){
                        $decrease_percent = 100-$decrease_percent;
                        $decrease_percent = $decrease_percent/100;
                        $new_hours = $c_deadline->diffInHours()*$decrease_percent;
                        $b_deadline = \Carbon\Carbon::now()->addHours($new_hours);
                    }
                    if($order->designer == 1){
                        $b_deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
                    }

                        $remaining = $b_deadline->diffForHumans();
                    ?>
                    <tr class="tabular">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->topic  }}</td>
                        <td>{{ $order->subject->label  }}</td>
                        <td>{{ $order->pages != 0 ? $order->pages:'-' }}</td>
                        <td>
                            @if($order->designer == 1)
                                -
                                @else
                            @if($bidmapper->bid_amount)
                                {{ number_format($bidmapper->bid_amount,2) }}
                                @else
                                {{ number_format($cpp*$order->pages,2) }}
                                @endif
                            @endif
                            </td>
                        <td>{{ count($order->bids()->get()) }}</td>
                        <td>{!! $remaining !!}</td>
                        <th>
                            @if(json_decode($bidmapper->allow_take) && in_array($category_id,json_decode($bidmapper->allow_take)))
                            <a class="btn btn-primary btn-xs" href="{{ URL::to('/writer/take/'.''.$bidmapper->id) }}"><i class="fa fa-thumbs-up"></i> Take</a>
                            @endif
                            <a class="btn btn-success btn-xs" href="{{ URL::to('/writer/bid/'.''.$bidmapper->id) }}"><i class="fa fa-thumbs-up"></i> Bid</a>
                            <a class="btn btn-info btn-xs" href="{{ URL::to('/writer/order/'.''.$order->id) }}"><i class="fa fa-eye fa-fw"></i> View</a>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="{{ URL::to('/order/'.''.$order->id) }}">{{ $order->id }} - {{ $order->topic  }}</a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-success btn-xs" href="{{ URL::to('/writer/bid/'.''.$bidmapper->id) }}"><i class="fa fa-thumbs-up"></i> Bid</a>
                                <a class="btn btn-info btn-xs" href="{{ URL::to('/writer/order/'.''.$order->id) }}"><i class="fa fa-eye fa-fw"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong>{{ $order->subject->label  }}</div>
                            <div class="col-sm-3"><strong>Pages: </strong>{{ $order->pages  }}</div>
                            <div class="col-sm-3"><strong>Total: </strong>{{ number_format($bidmapper->bid_amount,2)  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"><strong>Deadline: </strong>{!! $remaining !!}</div>
                            <div class="col-sm-2"><strong>Bids: </strong>{{ count($order->bids()->get()) }}</div>
                        </div>
                    </div>
                @endforeach
                {{ $bidmappers->links()  }}
            </table>
                @endif
        </div>
    </div>
@endsection