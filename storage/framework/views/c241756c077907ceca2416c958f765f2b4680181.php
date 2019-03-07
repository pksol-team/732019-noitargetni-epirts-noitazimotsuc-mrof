 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e($role); ?></div>
        <div class="panel-body">
            <form method="GET" action="<?php echo e(URL::to('emails/send')); ?>">
                <?php if(Auth::user()->isAllowedTo('send_emails')): ?> <input class="" type="checkbox" name="check_all" value="all" onchange="checkAllWriters()"> Check All <span style="display:none;" class="hidden_all"><input type="checkbox" name="all_pages" value="all page"> All Pages</span> <?php endif; ?>

                <table class="table table-bordered">
                <tr class="tabular">
                    <th>Id</th>
                    <?php if(Auth::user()->isAllowedTo('view_email')): ?>
                        <th>E-mail</th>
                    <?php endif; ?>
                    <th>Name</th>
                    <th>Active<br/><small>(Orders)</small></th>
                    <th>Revision<br/><small>(Orders)</small></th>
                    <th>Pending<br/><small>(Orders)</small></th>
                    <th>Completed<br/><small>(Orders)</small></th>
                    <th>Action</th>
                </tr>
                <?php foreach($users as $writer): ?>
                    <?php
                    $id = $writer->id;
                    ?>
                    <tr class="tabular">
                        <td><?php echo e($writer->id); ?>

                            <?php if(Auth::user()->isAllowedTo('send_emails')): ?>   <input class="checkbox" type="checkbox" name="user_ids[]" value="<?php echo e($writer->id); ?>"> <?php endif; ?>
                        </td>
                        <?php if(Auth::user()->isAllowedTo('view_email')): ?>
                            <td><?php echo e($writer->email); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($writer->name); ?></td>
                        <td>
                            <?php echo e($active = count(\App\Assign::where([
                                         ['user_id',$writer->id],
                                         ['status',0]
                                ])->get())); ?>

                        </td>
                        <td>
                            <?php echo e($revision = count(\App\Assign::where([
                                        ['user_id',$writer->id],
                                        ['status',2]
                               ])->get())); ?>

                        </td>
                        <td>
                            <?php echo e($pending = count(\App\Assign::where([
                                        ['user_id',$writer->id],
                                        ['status',3]
                               ])->get())); ?>

                        </td>
                        <td>
                            <?php echo e($completed = count(\App\Assign::where([
                                        ['user_id',$writer->id],
                                        ['status',4]
                               ])->get())); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(URL::to("user/view/$writer->role/$writer->id")); ?>" class="btn btn-info btn-xs">View</a>
                          <?php if(Auth::user()->isAllowedTo('change_role')): ?>  <a href="<?php echo e(URL::to("user/changerole/$writer->id")); ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Role</a> <?php endif; ?>
                            <?php if(Auth::user()->isAllowedTo('delete_data')): ?>
                                <a onclick="return confirm('Delete User <?php echo e($writer->id); ?> ?\n All items and info associated with user will be permanently deleted!')" href="<?php echo e(URL::to("user/delete/$writer->id")); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <div class="well gridular well-lg col-md-11">
                        <div class="row">
                            <div class="col-sm-4"><strong>Writer: </strong>#<?php echo e($writer->id); ?> - <?php echo e($writer->name); ?></div>
                            <div class="col-sm-4"><strong>Writer: </strong><?php echo e($writer->email); ?></div>
                            <div class="dropdown pull-right">
                                <a href="<?php echo e(URL::to("order/writer/$writer->id")); ?>" class="btn btn-info btn-xs">View</a>
                                <a href="<?php echo e(URL::to("user/changerole/$writer->id")); ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Role</a>
                                <?php if(Auth::user()->isAllowedTo('delete_data')): ?>
                                    <a onclick="return confirm('Delete User <?php echo e($writer->id); ?> ?\n All items and info associated with user will be permanently deleted!')" href="<?php echo e(URL::to("user/delete/$writer->id")); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Active<small>(Orders)</small>: </strong><?php echo e($active); ?></div>
                            <div class="col-sm-5"><strong>Revision<small>(Orders)</small>: </strong><?php echo e($revision); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Pending<small>(Orders)</small>: </strong><?php echo e($pending); ?></div>
                            <div class="col-sm-5"><strong>Completed<small>(Orders)</small>: </strong><?php echo e($completed); ?></div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </table>
                    <?php if(Auth::user()->isAllowedTo('send_emails')): ?>
                        <input type="hidden" name="role" value="<?php echo e($role); ?>">
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