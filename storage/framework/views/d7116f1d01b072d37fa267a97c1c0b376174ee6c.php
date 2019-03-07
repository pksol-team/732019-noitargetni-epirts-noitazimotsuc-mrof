            <table class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>Order ID</th>
                    <th>Reason</th>
                    <th>Files</th>
                    <th>Pref. Action</th>
                    <th>Status</th>
                </tr>

                <?php foreach($disputes as $dispute): ?>
                    <?php
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($dispute->order_id); ?><a class="btn btn-info btn-xs" href="<?php echo e(URL::to("stud/order/$dispute->order_id")); ?>"><i class="fa fa-eye"></i> View</a> </td>
                        <td><?php echo e($dispute->reason); ?></td>
                        <td><?php echo e(count(json_decode($dispute->files))); ?></td>
                        <td><?php echo e($dispute->action); ?></td>
                        <th>
                            <?php if($dispute->status): ?>
                                <i style="color:green" class="fa fa-check"></i>(Resolved)
                            <?php else: ?>
                                <i style="color: darkorange" class="fa fa-warning"></i> (Pending)
                            <?php endif; ?>
                        </th>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm7"><strong>Order: </strong>#<?php echo e($dispute->order_id); ?>-<a class="btn btn-info btn-xs" href="<?php echo e(URL::to("stud/order/$dispute->order_id")); ?>"><i class="fa fa-eye"></i> View</a> </div>
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

                <?php endforeach; ?>
            </table>
            <?php echo e($disputes->links()); ?>

