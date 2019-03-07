 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Company Websites<a href="<?php echo e(URL::to("websites/add")); ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
        </div>
        <div class="panel-body">
            <table id="rates_table" class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Role</th>
                    <th>Layout</th>
                    <th>Action</th>
                </tr>
                <?php foreach($websites as $website): ?>
                    <?php
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($website->id); ?></td>
                        <td><?php echo e($website->name); ?></td>
                        <td><?php echo e($website->home_url); ?></td>
                        <td><?php echo e($website->role); ?></td>
                        <td><?php echo e($website->layout); ?></td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("websites/view/$website->id")); ?>"><i class="fa fa-eye"></i> View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($websites->links()); ?>

        </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>