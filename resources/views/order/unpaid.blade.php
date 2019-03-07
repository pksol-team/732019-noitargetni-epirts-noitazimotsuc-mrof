 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">New Orders <a href="{{ URL::to('/order/create')  }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add New</a> </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Topic</th>
                    <th>Subject</th>
                    <th>Pages</th>
                    <th>Amount</th>
                    <th>Bids</th>
                    <th>On</th>
                    <th>Action</th>
                </tr>

                @foreach($orders as $order)
                    <?php
                        $deadline = Carbon\Carbon::createFromTimestamp(strtotime($order->created_at));
                    ?>
                    <tr class="tabular">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->topic  }}</td>
                        <td>{{ $order->subject  }}</td>
                        <td>{{ $order->pages }}</td>
                        <td>{{ number_format($order->amount,2) }}</td>
                        <td>{{ count($order->bids()->get()) }}</td>
                        <td>{{ $deadline->diffForHumans() }}</td>
                        <th>
                            <a class="btn btn-info btn-xs" href="{{ URL::to('/order/'.''.$order->id) }}"><i class="fa fa-eye"></i> View</a>

                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<a href="{{ URL::to('/order/'.''.$order->id) }}">{{ $order->id }} - {{ $order->topic  }}</a></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="{{ URL::to('/order/'.''.$order->id) }}"><i class="fa fa-eye"></i> View</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Subject: </strong>{{ $order->subject  }}</div>
                            <div class="col-sm-3"><strong>Pages: </strong>{{ $order->pages  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Placed: </strong>{{ $deadline->diffForHumans() }}</div>
                            <div class="col-sm-2"><strong>Amount: </strong>{{ number_format($order->amount,2) }}</div>
                            <div class="col-sm-2"><strong>Bids: </strong>{{ count($order->bids()->get()) }}</div>
                        </div>

                    </div>

                @endforeach
                {{ $orders->links()  }}
            </table>
        </div>
    </div>
@endsection