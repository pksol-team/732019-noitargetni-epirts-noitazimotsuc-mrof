 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Active Orders</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order</th>
                    <th>Instructions</th>
                    <th>Pages</th>
                    <th>Subject</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>

                @foreach($active as $assigned)
                    <?php
                    $now = date('y-m-d H:i:s');

                    $order = $assigned->order;
                    $now = date('y-m-d H:i:s');
                    $deadline = $assigned->deadline;
                    $today = date_create($now);
                    $end = date_create($deadline);
                    $diff = date_diff($today,$end);
                    if($today>$end){
                        if($diff->d){
                            $remaining = '<span style="color: red;">Late: '.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }else{
                            $remaining = '<span style="color: red;">Late: '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }
                    }else{

                        if($diff->d){
                            $remaining = '<span style="color: darkgreen;">'.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }else{
                            $remaining = '<span style="color: darkgreen;">'.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
                        }
                    }
                    ?>
                    <tr class="tabular">
                        <td>{{ $order->id }} - {{ $order->topic  }}</td>
                        <td>{{ substr($order->instructions,0,100)  }}..</td>
                        <td>{{ $order->pages  }}</td>
                        <td>{{ $order->subject->label  }}</td>
                        <td>{!! $remaining !!}</td>
                        <td>
                            <a class="btn btn-success btn-xs" href="{{ URL::to("writer/order/$order->id/room/$assigned->id") }}"><i class="fa fa-users fa-fw"></i>Room</a>
                            <a class="btn btn-info btn-xs" href="{{ URL::to('/writer/order/'.''.$order->id) }}"><i class="fa fa-eye fa-fw"></i> View</a>
                        </td>
                    </tr>

                <div class="well gridular well-lg col-md-11">
                    <div class="row">
                        <div class="col-sm-4"><strong>Order: </strong>#{{ $order->id }} - {{ $order->topic  }}</div>
                        <div class="dropdown pull-right">
                            <a class="btn btn-success btn-xs" href="{{ URL::to("writer/order/$order->id/room/$assigned->id") }}"><i class="fa fa-users fa-fw"></i>Room</a>
                            <a class="btn btn-info btn-xs" href="{{ URL::to('/writer/order/'.''.$order->id) }}"><i class="fa fa-eye fa-fw"></i> View</a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"><strong>Assigned on: </strong>{{ date('d M Y, h:i a',strtotime($assigned->created_at)) }}</div>
                        <div class="col-sm-5"><strong>Deadline: </strong>{!! $remaining !!}</div>
                    </div>

                </div>
            @endforeach
            </table>
            {{ $active->links() }}
        </div>
    </div>
@endsection