 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">styles <a href="<?php echo e(URL::to("writer_categories/add")); ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
        </div>
        <div class="panel-body">
            <table id="rates_table" class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Writer Cpp</th>
                    <th>Deadline Adjustment</th>
                    <th>Inc. Type</th>
                    <th>Amount</th>
                    <th>Late Fine(%)</th>
                    <th>Action</th>
                </tr>
                <?php foreach($writer_categories as $writer_category): ?>
                    <?php
                    ?>
                    <tr class="tabrular">
                        <td><?php echo e($writer_category->id); ?></td>
                        <td><?php echo e($writer_category->name); ?></td>
                        <td><?php echo e($writer_category->description); ?></td>
                        <td><?php echo e($writer_category->cpp); ?></td>
                        <td><?php echo e($writer_category->deadline); ?>%</td>
                        <td><?php echo e($writer_category->inc_type); ?></td>
                        <td><?php echo e($writer_category->amount); ?>%</td>
                        <td><?php echo e($writer_category->fine_percent); ?>%</td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("writer_categories/add?id=$writer_category->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("writer_categories/delete/$writer_category->id")); ?>"><i class="fa fa-delete"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($writer_categories->links()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>