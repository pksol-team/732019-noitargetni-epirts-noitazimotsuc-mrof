 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">styles <a href="<?php echo e(URL::to("settings/add/style")); ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
        </div>
        <div class="panel-body">
            <table id="rates_table" class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>ID</th>
                    <th>Label</th>
                    <th>Inc. Type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>

                <?php foreach($styles as $style): ?>
                    <?php
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($style->id); ?></td>
                        <td><?php echo e($style->label); ?></td>
                        <td><?php echo e($style->inc_type); ?></td>
                        <td><?php echo e($style->amount); ?></td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("settings/add/style?id=$style->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("settings/delete/style/$style->id")); ?>"><i class="fa fa-delete"></i> Delete</a>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm-7"><strong>ID: </strong><?php echo e($style->id); ?></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("settings/add/style?id=$style->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("settings/delete/style/$style->id")); ?>"><i class="fa fa-remove"></i> Delete</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Label: </strong><?php echo e($style->label); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Inc. Type: </strong><?php echo e($style->inc_type); ?></div>
                            <div class="col-sm-2"><strong>Amount: </strong><?php echo e($style->amount); ?></div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </table>
            <?php echo e($styles->links()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>