<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <?php echo e($user->name); ?>

                <?php if($user->role=='writer'): ?>
                    <div class="pull-right">
                        <?php if(Auth::user()->isAllowedTo('writer_application_info')): ?>  <a class="btn btn-info btn-sm" href="<?php echo e(URL::to("user/$user->id/application_info")); ?>"><i class="fa fa-info"></i> Application Info</a> <?php endif; ?>
                        <?php if(Auth::user()->isAllowedTo('writer_payments')): ?> <a class="btn btn-success btn-sm" href="<?php echo e(URL::to("user/$user->id/payments")); ?>"><i class="fa fa-money"></i> Payments</a> <?php endif; ?>
                        <?php if(!$user->suspended): ?>
                        <?php endif; ?>
                        <?php if(\App\Website::where('designer',1)->count()): ?>
                            <?php if(!$user->isDesigner()): ?>
                            <a onclick="runPlainRequest('<?php echo e(URL::to('user/view/writer/allow-designer')); ?>',<?php echo e($user->id); ?>,'Allow writer to view/bid and work on orders from designer website(s)')" class="btn btn-primary"><i class="fa fa-check"></i> Allow Designer</a>
                                <?php else: ?>
                                    <a onclick="runPlainRequest('<?php echo e(URL::to('user/view/writer/allow-designer')); ?>',<?php echo e($user->id); ?>,'Disable writer from viewing/bidding and working on orders from designer website(s)')" class="btn btn-warning"><i class="fa fa-times"></i> Disable Designer</a>
                                <?php endif; ?>
                         <?php endif; ?>
                    </div>
                 <?php else: ?>
                    <div class="pull-right">
                        <?php if($user->suspended): ?>
                            <?php else: ?>
                            <?php if(Auth::user()->isAllowedTo('suspend_writer')): ?> <a class="btn btn-danger btn-sm" href="<?php echo e(URL::to("user/$user->id/suspend")); ?>"><i class="fa fa-money"></i> Suspend User</a> <?php endif; ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Personal Details</div>
                    <div class="panel-body">
                        <div class="profile_pic">

                          <img src="<?php if($user->image): ?> <?php echo e(URL::to($user->image)); ?> <?php else: ?> <?php echo e(URL::to('images/img.png')); ?> <?php endif; ?> " alt="..." class="img-circle profile_img">
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
                            <?php if(Auth::user()->isAllowedTo('view_email')): ?>
                            <tr>
                                <th>E-mail</th>
                                <td><?php echo e($user->email); ?></td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th>Send Email</th>
                                <td>
                                    <form action="<?php echo e(URL::to("emails/send")); ?>">
                                        <input type="hidden" name="role" value="<?php echo e($user->role); ?>">
                                        <input type="hidden" name="user_ids[]" value="<?php echo e($user->id); ?>">
                                        <button type="submit"><i class="fa fa-envelope"></i> Email</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td><?php echo e(ucwords($user->role)); ?></td>
                            </tr>
                            <tr>
                                <th>Author</th>
                                <td>
                                    <?php if($user->author): ?>
                                        <label class="label label-info">Yes</label>
                                        <button class="btn btn-warning btn-xs" onclick="runPlainRequest('<?php echo e(url("user/view/$user->role/author")); ?>',<?php echo e($user->id); ?>)">Revoke Author</button>
                                    <?php else: ?>
                                        <label class="label label-warning">No</label>
                                        <button class="btn btn-info btn-xs" onclick="runPlainRequest('<?php echo e(url("user/view/$user->role/author")); ?>',<?php echo e($user->id); ?>)">Make Author</button>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo e(ucwords($user->country)); ?></td>
                            </tr>
                            <?php if(Auth::user()->isAllowedTo('view_phone')): ?>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo e(ucwords($user->phone)); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if($user->role=='client'): ?>
                            <tr>
                                <th>Total Orders</th>
                                <td><?php echo e($user->orders()->count()); ?><a class="btn btn-info btn-xs pull-right" href="<?php echo e(URL::to("user/$user->id/orders")); ?>"><i class="fa fa-eye"></i> View</a> </td>
                            </tr>
                            <?php endif; ?>
                            <?php if($user->website): ?>
                                <tr>
                                    <th>Website</th>
                                    <td><?php echo e($user->website->name); ?> </td>
                                </tr>
                            <?php endif; ?>

                            <?php if($user->role=='writer'): ?>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php if($user->status==0): ?>
                                            Inactive
                                        <?php elseif($user->suspended): ?>
                                            <p style="color: red"><i class="fa fa-times"></i>Suspended </p>
                                            <a onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("user/$user->id/activate")); ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-check"></i> Activate</a>

                                        <?php else: ?>
                                            Active
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?php echo e(@$user->writerCategory->name); ?><a href="#category_modal" data-toggle="modal" class="pull-right label label-info"><i class="fa fa-edit"></i> Edit</a> </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php if($user->suspended): ?>
                                            <p style="color: red"><i class="fa fa-times"></i>Suspended </p>
                                            <a onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("user/$user->id/activate")); ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-check"></i> Activate</a>

                                        <?php else: ?>
                                            Active
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>

                                <tr>
                                    <th>Last Login</th>
                                    <?php
                                    $login = $user->devices()->orderBy('updated_at','desc')->first();
                                    // dd($login);
                                        if(!$login){
                                            $updated = $user->updated_at;
                                        }else{
                                            $updated = $login->updated_at;
                                        }
                                    $last_login = \Carbon\Carbon::createFromTimestamp(strtotime($updated));
                                    $login_time = $last_login->diffForHumans();
                                    ?>
                                    <td><?php echo e($login_time); ?></td>
                                </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="#password_modal" class="btn btn-info" data-toggle="modal">Update Password</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">User Traits <a href="<?php echo e(URL::to("user/$user->id/add_trait")); ?>" class="pull-right btn btn-info"><i class="fa fa-plus"></i> ADD</a> </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Trait</th>
                                <th>Description</th>
                                <th>On</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach($traits = $user->traits()->orderBy('id','desc')->paginate(10) as $trait): ?>
                                <tr>
                                    <td><?php echo e($trait->id); ?></td>
                                    <td><?php echo e($trait->trait); ?></td>
                                    <td><?php echo e($trait->description); ?></td>
                                    <td><?php echo e(date('Y M d',strtotime($trait->created_at))); ?></td>
                                    <td>
                                        <a href="<?php echo e(URL::to("user/$user->id/edit_trait/$trait->id")); ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <?php if($user->website->wallet): ?>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">User E-Wallet </div>
                    <div class="panel-body">
                     <?php echo $__env->make('client.e_wallet', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($user->role=='writer'): ?>
                <div class="row"></div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Writer Performance
                        </div>
                        <div class="panel-body">
                            <div id="rating_gauge" class="col-md-3">

                            </div>
                            <div id="order_stats" class="col-md-9">

                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
        </div>
    </div>
    <?php echo $__env->make('user.graphs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="modal fade" role="dialog" id="password_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Update <?php echo e($user->name); ?> Password<a data-dismiss="modal" class="pull-right btn-danger btn">&times;</a></div>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal ajax-post" action="<?php echo e(URL::to("user/$user->id/password")); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-8">
                                    <input type="password" name="password_confirmation" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>