 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Subjects <a href="<?php echo e(URL::to("settings/add/subject")); ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
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

                <?php foreach($subjects as $subject): ?>
                    <?php
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($subject->id); ?></td>
                        <td><?php echo e($subject->label); ?></td>
                        <td><?php echo e($subject->inc_type); ?></td>
                        <td><?php echo e($subject->amount); ?></td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("settings/add/subject?id=$subject->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("settings/delete/subject/$subject->id")); ?>"><i class="fa fa-remove"></i> Delete</a>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm-7"><strong>ID: </strong><?php echo e($subject->id); ?></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("settings/add/subject?id=$subject->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("settings/delete/subject/$subject->id")); ?>"><i class="fa fa-remove"></i> Delete</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Label: </strong><?php echo e($subject->label); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Inc. Type: </strong><?php echo e($subject->inc_type); ?></div>
                            <div class="col-sm-2"><strong>Amount: </strong><?php echo e($subject->amount); ?></div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </table>
            <?php echo e($subjects->links()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>