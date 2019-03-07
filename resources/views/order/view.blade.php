 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <strong>Order Topic: </strong>{{ $order->topic }}
                <div class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks"> Action </i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ URL::to("order/edit/$order->id/") }}"><i class="fa fa-edit"></i> Edit</a>
                        </li>
                        @if($assign_id = @$order->assigns()->where('status',0)->get()[0]->id)
                            <li><a href="{{ URL::to("order/$order->id/room/$assign_id") }}"><i class="fa fa-users"></i> Room</a>
                            </li>
                            @endif

                    </ul>
                </div>
            </div>
        </div>
        <?php
        $features = [];
        if($order->add_features){
            $features = \App\AdditionalFeature::whereIn('id',json_decode($order->add_features))->get();
        }
        $has_milestones = 0;
        foreach($features as $feature){
            $f_name = $feature->name;
            similar_text(strtolower($f_name),'progressive delivery',$percent);
            if($percent>80){
                $has_milestones = 1;
            }
        }
        ?>
        <div class="panel-body">
            <h2>Order Details</h2>
            <ul class="nav nav-tabs">
                <li class="active"><a class="btn btn-warning" data-toggle="tab" href="#o_order">Order</a></li>
                <li><a class="btn btn-info" data-toggle="tab" href="#o_bids">Bids<span class="badge">{{ count($order->bids) }}</span> </a></li>
                <li><a class="btn btn-primary" data-toggle="tab" href="#o_files">Files<span class="badge">{{ count($order->files) }}</span></a></li>
                <li><a class="btn btn-success" data-toggle="tab" onclick="markRead();" href="#o_messages">Messages<span class="badge">{{ count($order->messages()->where([
                ['seen','=',0],
                ['sender','=',0]
                ])->get()) }}</span></a></li>
                {{--<li><a data-toggle="tab" href="#o_client"><i class="fa fa-user"></i> Client</a></li>--}}
                @if($has_milestones == 1)
                    <li>
                        <a class="btn btn-info" data-toggle="tab" href="#progressive_milestones">Milestones <span class="badge">{{ $order->progressiveMilestones()->count() }}</span> </a>
                    </li>
                @endif
            </ul>


                <div class="tab-content">
                    @include('order.includes.order')
                    @include('order.includes.bids')
                    @include('order.includes.messages')
                    @include('order.includes.files')
                    @include('order.includes.client')
                    @if($has_milestones == 1)
                        @include('order.includes.milestones')
                    @endif
                </div>

        </div>
    </div>
@endsection