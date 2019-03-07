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
                {{--<li><a class="btn btn-info" data-toggle="tab" href="#o_bids">Bids<span class="badge">{{ count($order->bids) }}</span> </a></li>--}}
            </ul>
            <div class="tab-content">
                @include('writer.designer.order')
                {{--@include('writer.includes.bids')--}}
                {{--@include('writer.designer.messages')--}}
                @include('writer.designer.files')
            </div>
        </div>
    </div>
@endsection