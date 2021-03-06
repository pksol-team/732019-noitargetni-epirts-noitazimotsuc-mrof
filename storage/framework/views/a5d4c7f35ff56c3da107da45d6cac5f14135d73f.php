 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">user Applications </div>
        <div class="panel-body">
            <form method="GET" action="<?php echo e(URL::to('emails/send')); ?>">
                <?php if(Auth::user()->isAllowedTo('send_emails')): ?> <input class="" type="checkbox" name="check_all" value="all" onchange="checkAllWriters()"> Check All <span style="display:none;" class="hidden_all"><input type="checkbox" name="all_pages" value="all page"> All Pages</span> <?php endif; ?>

                <table class="table table-bordered">
                <tr class="tabular">
                    <th>Id</th>
                    <th>E-mail</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <?php
                    $id = $user->id ?>
                    <tr class="tabular">
                        <td><?php echo e($user->id); ?>

                            <?php if(Auth::user()->isAllowedTo('send_emails')): ?>   <input class="checkbox" type="checkbox" name="user_ids[]" value="<?php echo e($user->id); ?>"> <?php endif; ?>

                        </td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="<?php echo e(URL::to("user/$user->id/activate")); ?>"><i class="fa fa-check"></i> Activate</a>
                            <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("user/view/$user->role/$user->id")); ?>"><i class="fa fa-user"></i> Profile</a>
                            <?php if(Auth::user()->isAllowedTo('delete_data')): ?>
                                <a onclick="return confirm('Delete User <?php echo e($user->id); ?> ?\n All items and info associated with user will be permanently deleted!')" href="<?php echo e(URL::to("user/delete/$user->id")); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <div class="well gridular well-lg col-md-11">
                        <div class="row">
                            <div class="col-sm-4"><strong>user: </strong>#<?php echo e($user->id); ?> - <?php echo e($user->name); ?></div>
                            <div class="col-sm-4"><strong>user: </strong><?php echo e($user->email); ?></div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-sm" href="<?php echo e(URL::to("user/$user->id/application_info")); ?>"><i class="fa fa-info"></i> Application Info</a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

            </table>
                    <?php if(Auth::user()->isAllowedTo('send_emails')): ?>
                        <input type="hidden" name="role" value="<?php echo e('writer'); ?>">
                        <?php foreach(Request::all() as $param=>$value): ?>
                            <input type="hidden" name="<?php echo e($param); ?>" value="<?php echo e($value); ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-success"><i class="fa fa-envelope"></i> Send Emails</button>
            </form>
            <?php endif; ?>
            <?php echo e($users->links()); ?>

        </div>
    </div>

    <script type="text/javascript">
        function checkAllWriters(){
            var checked = $("input[name='check_all']").is(":checked");
            if(checked==true){
                $(".checkbox").prop('checked', true);
                $(".hidden_all").slideDown();
            }else{
                $(".checkbox").prop('checked', false);
                $(".hidden_all").hide();
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>