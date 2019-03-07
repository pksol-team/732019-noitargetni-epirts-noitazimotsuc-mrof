<div id="o_client" class="tab-pane fade">
    <?php
    $user = $order->user;
    ?>
    <div class="profile_pic">

        <img src="<?php if($user->image): ?> <?php echo e(URL::to($user->image)); ?> <?php else: ?> <?php echo e(URL::to('images/img.png')); ?> <?php endif; ?>" alt="..." class="img-circle profile_img">
    </div>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo e($user->id); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo e($user->name); ?></td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?php echo e(ucwords($user->role)); ?></td>
        </tr>
    </table>
</div>