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
    <?php if($assign = $order->assigns()->where([
        ['status','<',3]
    ])->first()): ?>
    <?php if($assign->status < 3): ?>
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
                    Order Progress: <span id="current_progress"><?php echo e((int)$progress->percent); ?></span>% Done
                    <input onchange="return setRange();" type="range" name="progress" value="<?php echo e((int)$progress->percent); ?>">
                </form>
                <script type="text/javascript">
                    function setRange(){
                        var val = $("input[name='progress']").val();
                        var current = $("#current_progress").text();
                        val = parseFloat(val);
                        current = parseFloat(current);

                        var url = '<?php echo e(URL::to("/order/assign/$assign->id/progress")); ?>?progress='+val;
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
    <?php endif; ?>
    <?php endif; ?>
    <table align="centre" class="table table-bordered">
        <tr>
                <td colspan="4"><p style="font-size: large; font-weight: bold;">#<?php echo e($order->id); ?>-<?php echo e($order->topic); ?></p></td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td class="titlecolumn">Type of Paper</td>
            <td><?php echo e($order->document->label); ?></td>
            <td class="titlecolumn">English Style</td>
            <td><?php echo e($order->language->label); ?></td>

        </tr>
        <tr>
            <td class="titlecolumn">Subject Area</td>
            <td><?php echo e($order->subject->label); ?></td>
            <th class="titlecolumn">Writer Category</th>
            <td><?php echo e(@$order->writerCategory->name); ?></td>
        </tr>
        <tr>
            <td class="titlecolumn">Academic Level</td>
            <td><?php echo e(ucwords($order->academic->level)); ?></td>
            <td class="titlecolumn">Sources</td>
            <td><?php echo e($order->sources); ?></td>


        </tr>
        <tr>
            <td class="titlecolumn">Number of Pages</td>
            <?php $multiply = $order->spacing==2 ? 1:2  ?>
            <td><?php echo e($order->pages.' page(s) / '.$multiply*275*$order->pages.' Words'); ?></td>
            <td class="titlecolumn">Referencing Style</td>
            <td><?php echo e($order->style->label); ?></td>
        </tr>
        <tr>
            <td class="titlecolumn">Spacing</td>
            <td><?php
                if($order->spacing==1){
                    echo "Single Spaced";
                }else{
                    echo "Double Spaced";
                }?></td>
            <th class="titlecolumn">Total</th>
            <td>
                <?php if($order->amount>0): ?>
                <?php echo e($order->currency ? number_format($order->amount*$order->currency->usd_rate,2)." ".$order->currency->abbrev:'$'.number_format($order->amount,2)); ?>

                <?php if(!$order->paid): ?>
                    <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay</a>
                <?php endif; ?>
                <?php if($order->paid): ?>
                    <?php if($order->getTotalPaid()<$order->amount): ?>
                        <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('stud/pay/'.''.$order->id)); ?>"><i class="fa fa-paypal"></i> Pay Pending(<?php echo e(@number_format($order->amount-$order->getTotalPaid(),2)); ?>)</a>
                    <?php endif; ?>
                <?php endif; ?>
                    <?php else: ?>
                    <strong style="color:green;">Pending</strong>
                <?php endif; ?>
            </td>
        </tr>

        <tr>
            <td class="titlecolumn">WriterID</td>
            <td>
                <?php if(isset($order->writer_id)): ?>
                    <?php echo e($order->writer_id); ?>

                <?php else: ?>
                    N/A
                <?php endif; ?>
            </td>
            <td class="titlecolumn">Discount</td>
            <td><?php echo $order->discounted.'%'; ?></td>

        </tr>
        <tr>
            <td class="titlecolumn">Deadline</td>
            <td><?php echo $remaining; ?></td>
            <td class="titlecolumn">Status</td>
            <td>
                <?php if($order->status>=1 && $order->status != 4 && $order->status != 6): ?>
                    Working
                <?php elseif($order->status==0): ?>
                    On Hold
                <?php else: ?>
                    Closed
                <?php endif; ?>
            </td>
        </tr>
        <tr>
        <!--     <td class="titlecolumn">Paper Size</td>
            <td><?php echo $order->paper_size; ?></td> -->
            <td class="titlecolumn">Additionals</td>
            <td colspan="3">
                <ul>
                    <?php foreach($features as $feature): ?>
                        <li><?php echo e($feature->name); ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <!-- <a href="#add_pages_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>Pages</a> -->
                <a href="#add_instructions_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>Instructions</a>
                <a href="#add_sources_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i>Sources</a>
                <!-- <a href="#add_hours_modal" data-toggle="modal" class="btn btn-success"><i class="fa fa-calendar"></i> Extend Deadline</a> -->
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>Order Instructions</strong></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo nl2br($order->instructions); ?></td>
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
                <?php echo e('Add Pages'); ?>

            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?php echo e(URL::to("stud/add_pages/$order->id")); ?>">
                    <?php echo e(csrf_field()); ?>

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
                <form class="form-horizontal" method="post" action="<?php echo e(URL::to("stud/add_instructions/$order->id")); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-3">Instructions</label>
                        <div class="col-md-4">
                        </div>
                    </div><div class="form-group">
                        <div class="col-md-10">
                            <textarea rows="10" name="instructions" class="form-control"><?php echo $order->instructions; ?></textarea>
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
                <form class="form-horizontal" method="post" action="<?php echo e(URL::to("stud/add_sources/$order->id")); ?>">
                    <?php echo e(csrf_field()); ?>

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
                <form class="form-horizontal" method="post" action="<?php echo e(URL::to("stud/add_hours/$order->id")); ?>">
                    <?php echo e(csrf_field()); ?>

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