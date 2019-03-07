<?php
$now = date('y-m-d H:i:s');
$deadline = $order->deadline;
$today = date_create($now);
$end = date_create($deadline);
$diff = date_diff($today,$end);
if($today>$end){
    if($diff->d){
        $remaining = '<span style="color: red;"><i class="fa fa-calendar"></i> Late: '.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
    }else{
        $remaining = '<span style="color: red;"><i class="fa fa-calendar"></i> Late: '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
    }
}else{

    if($diff->d){
        $remaining = '<span style="color: darkgreen;"><i class="fa fa-calendar"></i> '.$diff->d.' Day(s) '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
    }else{
        $remaining = '<span style="color: darkgreen;"><i class="fa fa-calendar"></i> '.$diff->h.' Hr(s) '.$diff->i.' Min(s)</span>';
    }
}
$features = [];

?>
<div id="o_order" class="tab-pane fade in active">
    @if($assign = $order->assigns()->where([
        ['status','<',3]
    ])->first())
    @if($assign->status < 3)
        <br/>
        <div class="panel panel-success">
            <div class="panel-body">
                <form id="progress_form" class="ajax-post">
                    <?php
                    $progress = $assign->progress;
                    if(!$progress){
                        $progress = $assign->progress()->updateOrCreate(['assign_id'=>$assign->id],[
                                'progress'=>0
                        ]);
                    }

                    ?>
                    Order Progress: <span id="current_progress">{{ (int)$progress->percent }}</span>% Done
                    <input onchange="return setRange();" type="range" name="progress" value="{{ (int)$progress->percent }}">
                </form>
                <script type="text/javascript">
                    function setRange(){
                        var val = $("input[name='progress']").val();
                        var current = $("#current_progress").text();
                        val = parseFloat(val);
                        current = parseFloat(current);

                        var url = '{{ URL::to("/order/assign/$assign->id/progress") }}?progress='+val;
                        $("input[name='progress']").val(current);
                    }

                    function runAfterSubmit(response){
                        if(response.percent){
                            $("#current_progress").text(response.percent);
                        }
                    }
                </script>
            </div>
        </div>
    @endif
    @endif
    <table align="centre" class="table table-bordered">
        <tr>
                <td colspan="4"><p style="font-size: large; font-weight: bold;">#{{ $order->id}}-{{ $order->topic }}</p></td>
        </tr>

        <tr>
            <td class="titlecolumn">Subject Area</td>
            <td>{{ $order->subject->label }}</td>
            <th class="titlecolumn">Category</th>
            <td>{{ @$order->document->label }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <!-- <a href="#add_pages_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>Pages</a> -->
                <a href="#add_instructions_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-edit"></i>Instructions</a>
                {{--<a href="#add_sources_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>Sources</a>--}}
                <!-- <a href="#add_hours_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-calendar"></i> Extend Deadline</a> -->
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>Order Instructions</strong></td>
        </tr>
        <tr>
            <td colspan="4">{!! nl2br($order->instructions) !!}</td>
        </tr>

    </table>
</div>
<style type="text/css">
    .titlecolumn {
        background: whitesmoke;
        white-space: nowrap;
        text-align: right;
        font-weight: bold;
        width: 5%;
    }
</style>

<div id="add_pages_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                {{ 'Add Pages' }}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ URL::to("stud/add_pages/$order->id") }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3">Pages</label>
                        <div class="col-md-4">
                            <input type="number" min="1" class="form-control" name="pages">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add_instructions_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                Add More Instructions
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ URL::to("stud/add_instructions/$order->id") }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3">Instructions</label>
                        <div class="col-md-4">
                        </div>
                    </div><div class="form-group">
                        <div class="col-md-10">
                            <textarea rows="10" name="instructions" class="form-control">{!! $order->instructions !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="add_sources_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                Add More Sources
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ URL::to("stud/add_sources/$order->id") }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3">Sources</label>
                        <div class="col-md-4">
                            <input type="number" min="1" class="form-control" name="sources">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="add_hours_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                Extent Deadline
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="{{ URL::to("stud/add_hours/$order->id") }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-3">Extent By<small>(Hours)</small></label>
                        <div class="col-md-4">
                            <input type="number" min="1" class="form-control" name="hours">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>