<?php $__env->startSection('content'); ?>
    <?php $c_user = Auth::user();  ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e('Messages'); ?><?php if(Auth::user()->role != 'client'): ?> <a href="#new_message_modal" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New</a> <?php endif; ?> </div>
        <div class="panel-body">
            <table class="table table-condensed table-bordered">
                <thead>
                <tr>
                    <?php if(Auth::user()->role !='client'): ?>
                    <th>#</th>
                    <th>User</th>
                    <th>Department</th>
                        <?php else: ?>
                        <th>OrderID</th>
                    <?php endif; ?>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($messages as $message): ?>
                    <tr style="background-color:<?php echo e($message->seen ? "":"#ddd"); ?>">
                        <?php if(Auth::user()->role !='client'): ?>
                        <td><?php echo e($message->id); ?></td>
                        <td>
                        <?php if($c_user->role=='writer'): ?>
                                <?php if($c_user->id == $message->user_id): ?>
                                Me
                            <?php else: ?>
                                Admin
                            <?php endif; ?>
                            <?php else: ?>
                                    <?php echo e($message->email); ?>

                                <?php endif; ?>
                        </td>
                        <td>
                            <?php if($message->name): ?>
                                <?php echo e($message->name); ?>

                            <?php elseif($message->assign_id): ?>
                                <?php echo e("Room#".$message->assign_id); ?>

                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <?php else: ?>
                            <td><?php echo e($message->order_id); ?></td>
                            <?php endif; ?>
                        <td>
                            <?php echo nl2br($message->message); ?>

                        </td>
                        <td>
                            <?php if($message->name): ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(URL::to("departments/conversation/$message->department_id/$message->client_id")); ?>"><i class="fa fa-comment"></i> View</a>
                            <?php elseif($message->assign_id): ?>
                                    <?php $assign = $message->assign ?>
                            <?php if(@$assign->id): ?>
                                    <?php if(Auth::user()->role=='writer'): ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("writer/order/$assign->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                                     <?php elseif(Auth::user()->role=='admin'): ?>
                                        <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("order/$assign->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                                     <?php elseif(Auth::user()->role=='client'): ?>
                                        <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("order/$assign->order_id/room/$assign->id")); ?>"><i class="fa fa-users"></i> Room</a>
                                        <?php endif; ?>
                                <?php else: ?>
                                <?php $message->delete() ?>
                                <?php endif; ?>
                            <?php elseif($message->order_id && Auth::user()->role=='client'): ?>
                                <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("/stud/order/$message->order_id")); ?>#o_messages"><i class="fa fa-eye"></i> View</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo e($messages->links()); ?>


        </div>
    </div>
<?php if($website->designer == 1): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"> Bid Messages</div>
        </div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>OrderID</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                <?php foreach($bid_messages as $bid_message): ?>
                    <tr>
                        <td><?php echo e($bid_message->order_id); ?></td>
                        <td><?php echo e($bid_message->message); ?></td>
                       <td>
                           <?php if(Auth::user()->role == 'client'): ?>
                           <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("/stud/order/$bid_message->order_id")); ?>"><i class="fa fa-eye"></i> View</a>
                            <?php elseif(Auth::user()->role == 'writer'): ?>
                               <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("/writer/bid/$bid_message->mapper_id")); ?>"><i class="fa fa-eye"></i> View</a>
                           <?php endif; ?>
                       </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
<?php endif; ?>
    <div class="modal fade" id="new_message_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                    Message Form
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <?php if(Auth::user()->role=='admin'): ?>
                                <input type="hidden" name="sender" value="0">
                            <label class="control-label col-md-3">To</label>
                            <div class="col-md-6">
                                <input name="writer_id" class="form-control">
                            </div>
                                <?php else: ?>
                                <input type="hidden" name="sender" value="1">
                                <input name="writer_id[]" type="hidden" value="<?php echo e(Auth::user()->id); ?>" class="form-control">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Department</label>
                            <div class="col-md-6">
                                <select class="form-control" name="department_id">
                                    <?php foreach($departments as $department): ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Message</label>
                            <div class="col-md-6">
                                <textarea required class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            var ms = $("input[name='writer_id']").magicSuggest({
                data: '<?php echo e(URL::to('order/force_assign')); ?>',
                valueField: 'id',
                method:'get',
                displayField: 'email',
                required:true,
                maxSelection:1
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>