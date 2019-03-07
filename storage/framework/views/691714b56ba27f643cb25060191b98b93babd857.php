 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Currencies <a href="<?php echo e(URL::to("currency/add")); ?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
        </div>
        <div class="panel-body">
            <table id="rates_table" class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Abbrev</th>
                    <th>USD Rate</th>
                    <th>Action</th>
                </tr>

                <?php foreach($currencies as $currency): ?>
                    <?php
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($currency->id); ?></td>
                        <td><?php echo e($currency->name); ?></td>
                        <td><?php echo e($currency->abbrev); ?></td>
                        <td><?php echo e($currency->usd_rate); ?></td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="<?php echo e(URL::to("currency/add?id=$currency->id")); ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("currency/delete/$currency->id")); ?>"><i class="fa fa-delete"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo e($currencies->links()); ?>

        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>