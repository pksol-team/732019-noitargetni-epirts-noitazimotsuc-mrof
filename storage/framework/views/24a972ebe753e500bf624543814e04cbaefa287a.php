<div id="add_user_modal" class="modal fade" role="dialog">
    <div style=""  class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Add New User To Group
                <a class="btn btn-warning pull-right" data-dismiss="modal">&times</a>

            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="">
                    <?php echo csrf_field(); ?>

                    <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input required type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">

                            <?php if($errors->has('name')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input required type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('country') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">Country</label>

                        <div class="col-md-6">
                            <input required type="text" class="form-control" name="country" value="<?php echo e(old('country')); ?>">

                            <?php if($errors->has('country')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('country')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">Phone</label>

                        <div class="col-md-6">
                            <input required type="text" value="<?php echo e(old('phone')); ?>" class="form-control" name="phone">

                            <?php if($errors->has('phone')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input required type="password" class="form-control" name="password">

                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                        <label class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input required type="password" class="form-control" name="password_confirmation">

                            <?php if($errors->has('password_confirmation')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-user-plus"></i>Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if(count($errors)>0): ?>
    <script type="text/javascript">
        $("#add_user_modal").modal('show');
    </script>
<?php endif; ?>