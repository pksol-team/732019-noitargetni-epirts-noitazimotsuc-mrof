<div id="o_bids" class="tab-pane fade">
    <h3>Bids</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Message</th>
            <th>Writer</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($order->bids as $bid): ?>
            <tr>
                <td><?php echo e($bid->id); ?></td>
                <td><?php echo e($bid->amount); ?></td>
                <td><?php echo e(substr($bid->message,0,25)); ?>...</td>
                <td><?php echo e($bid->user->name); ?></td>
                <td><a class="btn btn-info btn-xs" href="<?php echo e(URL::to('/order/'.$order->id.'/bid/'.$bid->id)); ?>"><i class="fa fa-eye"></i> View</a> </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>