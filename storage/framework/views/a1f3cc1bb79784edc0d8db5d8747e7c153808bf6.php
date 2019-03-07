 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                Change <strong><?php echo e($user->name); ?></strong> Role
            </div>
        </div>
        <div class="panel-body">
            <form method="post" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="control-label col-md-4">
                        New Role
                    </label>
                    <div class="col-md-4">
                        <select id="role_select" onchange="checkAdmin();" name="role" required class="form-control">
                            <option value="">Select...</option>
                            <option value="writer">Writer</option>
                            <option value="client">Client</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div id="admin_groups"  style="display: none;" class="form-group">
                    <label class="control-label col-md-4">Admin Group</label>
                    <div class="col-md-4">
                        <select name="admin_group_id" class="form-control">
                            <?php foreach($admin_groups as $admin_group): ?>
                                <option value="<?php echo e($admin_group->id); ?>"><?php echo e($admin_group->name); ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">
                       &nbsp;
                    </label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function checkAdmin(){
            var selected = $("#role_select").val();
            if(selected=='admin') {
                $("#admin_groups").slideDown();
            }else{
                $("#admin_groups").slideUp();
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>