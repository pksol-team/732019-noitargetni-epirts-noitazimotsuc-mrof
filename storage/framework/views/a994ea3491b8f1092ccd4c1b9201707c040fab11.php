 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Website Details</div>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger">These settings are very important and using wrong config might make your wbesite go down</div>
            <form class="form-horizontal" method="post" action="<?php echo e(URL::to('websites/add')); ?>">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($website->id); ?>">
                <div class="form-group hide">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-4">
                        <input required type="text" value="<?php echo e($website->name); ?>" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label class="control-label col-md-3">Home Url</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->home_url); ?>" required type="text" name="home_url" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">Telephone</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->telephone); ?>" required type="text" name="telephone" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">E-mail</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->email); ?>" required type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">Mail Password</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->password); ?>" required type="text" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">Mail Host</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->host); ?>" required type="text" name="host" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">Mail Encryption</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->encryption); ?>" type="text" name="encryption" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label for="telephone" class="control-label col-md-3">Mail Port</label>
                    <div class="col-md-4">
                        <input value="<?php echo e($website->port); ?>" required type="number" name="port" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label class="control-label col-md-3">Role</label>
                    <div class="col-md-4">
                        <select onchange="checkWriter();" name="role" required class="form-control">
                            <option <?php echo e($website->role=='writer' ? "selected":""); ?> value="writer">Writer</option>
                            <option <?php echo e($website->role=='client' ? "selected":""); ?> value="client">Client</option>
                            <option <?php echo e($website->role=='admin' ? "selected":""); ?> value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div id="late_fine hide" style="display: none;" class="form-group">
                    <label class="control-label col-md-3">Late Fine(%)</label>
                    <div class="col-md-4">
                        <input type="text" name="fine" value="<?php echo e($website->fine); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label class="control-label col-md-3">Layout</label>
                    <div class="col-md-4">
                        <input type="text" name="layout" value="<?php echo e($website->layout); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Deposit Amount(%)</label>
                    <div class="col-md-4">
                        <input type="number" max="100" min="1" name="deposit" value="<?php echo e($website->deposit); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Commission Amount(%)</label>
                    <div class="col-md-4">
                        <input type="number" max="100" min="1" name="commission" value="<?php echo e($website->commission); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group hide">
                    <label class="control-label col-md-3">Designer Website</label>
                    <div class="col-md-4">
                        <select name="designer" class="form-control">
                            <option value="0" <?php echo e($website->designer == 0 ? 'selected':''); ?>>No</option>
                            <option value="1" <?php echo e($website->designer == 1 ? 'selected':''); ?>>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Website</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<style type="text/css">
    .hide{
        display:none;
    }
</style>
    <script type="text/javascript">
        function checkWriter(){
            var val = $("select[name='role']").val();
            if(val=='writer'){
                $("#late_fine").slideDown();
            }else{
                $("#late_fine").slideUp();
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>