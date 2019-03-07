 
<?php $__env->startSection('content'); ?>
    <?php
    $images = array(
            'pdf'=>'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/pdf.png',
            'doc'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Word.png',
            'docx'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Word.png',
            'ppt'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20PowerPoint.png',
            'csv'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Excel.png',
            'xls'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Excel.png',
            'xlsx'=>'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Excel.png',
            'txt'=>'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/txt2.png',
            'zip'=>'http://www.softnuke.com/wp-content/uploads/2012/10/winrar1.png'
    );
            ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Orders under Dispute</div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Reason</th>
                    <th>Files</th>
                    <th>Pref. Action</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </tr>

                <?php foreach($disputes as $dispute): ?>
                    <?php
                        if($dispute->order){
                    $assign = $dispute->order->assigns()->where('status','=',4)->first();
                    }else{
                        $dispute->delete();
                        }
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($dispute->order_id); ?> </td>
                        <td><?php echo e($dispute->reason); ?></td>
                        <td>
                            <a class="btn btn-info" data-toggle="modal" href="#modal_<?php echo e($dispute->id); ?>"><i class="fa fa-eye"></i> </a> </td>
                        <td><?php echo e($dispute->action); ?></td>
                        <th>
                            <?php if($dispute->status): ?>
                                <i style="color:green" class="fa fa-check"></i>(Resolved)
                            <?php else: ?>
                                <i style="color: darkorange" class="fa fa-warning"></i> (Pending)
                            <?php endif; ?>
                        </th>
                        <td>
                            <a class="btn btn-info btn-xs" href="<?php echo e(URL::to("order/$dispute->order_id")); ?>"><i class="fa fa-eye"></i> View</a>
                            <?php if($assign): ?>
                            <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/$dispute->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                            <?php endif; ?>
                            <?php if($dispute->status==0): ?>
                            <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to("order/resolve_dispute/$dispute->id")); ?>"><i class="fa fa-check"></i>Resolved</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<?php echo e($dispute->order_id); ?>-<a class="btn btn-info btn-xs" href="<?php echo e(URL::to("order/$dispute->order_id")); ?>"><i class="fa fa-eye"></i> View</a> </div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" href="<?php echo e(URL::to("order/$dispute->order_id")); ?>"><i class="fa fa-eye"></i> View</a>
                                <?php if($assign): ?>
                                    <a class="btn btn-success btn-xs" href="<?php echo e(URL::to("order/$dispute->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                                <?php endif; ?>                                <?php if($dispute->status==0): ?>
                                    <a class="btn btn-warning btn-xs" href="<?php echo e(URL::to("order/resolvedispute/$dispute->id")); ?>"><i class="fa fa-check"></i>Resolved</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Reason: </strong><?php echo e($dispute->reason); ?></div>
                            <div class="col-sm-3"><strong>Files: </strong><?php echo e(count(json_decode($dispute->files))); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Pref. Action: </strong><?php echo e($dispute->action); ?></div>
                            <div class="col-sm-2"><strong>Status: </strong> <?php if($dispute->status): ?>
                                    <i style="color:green" class="fa fa-check"></i>(Resolved)
                                <?php else: ?>
                                    <i style="color: darkorange" class="fa fa-warning"></i> (Pending)
                                <?php endif; ?></div>
                        </div>
                    </div>

                        <div class="modal fade bs-modal" id="modal_<?php echo e($dispute->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">Files</div>
                                </div>
                                <div class="modal-body">
                                    <?php foreach(json_decode($dispute->files) as $file): ?>
                                        <?php if($file): ?>
                                        <?php
                                        $image = @$images[$file->file_type];
                                        if(!$image){
                                        $image = "http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/txt2.png";
                                        }
                                        ?>
                                            <div class="row">
                                                <div class="col-sm-4"><a target="_blank" href="<?php echo e(URL::to('/download/path?path=').urlencode(@$file->path).'&filename='.urlencode(@$file->filename).'&file_type='.urlencode($file->file_type)); ?>"><img height="20px;" src="<?php echo e($image); ?>"><?php echo e(@$file->filename); ?></a></div>
                                                <div class="col-sm-3"><strong>Size: </strong><?php echo e(number_format($file->size/1024,2)); ?> KB</div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                    <div class="modal-footer">
                                        <center>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </center>
                                    </div>
                             </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </table>
            <?php echo e($disputes->links()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>