 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Admin Group</div>
        </div>
        <div class="panel-body">
           <form class="form-horizontal" method="post">
               <?php echo e(csrf_field()); ?>

               <div class="form-group">
                   <label class="control-label col-md-3">Name</label>
                   <div class="col-md-4">
                       <input required class="form-control" type="text" name="name" value="<?php echo e($admin_group->name); ?>">
                   </div>
               </div>
               <div class="form-group">
                   <label class="control-label col-md-3">Description</label>
                   <div class="col-md-4">
                       <textarea required name="description" class="form-control"><?php echo e($admin_group->description); ?></textarea>
                   </div>
               </div>
               <div class="form-group">
                   <label class="control-label col-md-3">Permissions</label>
                   <div class="col-md-4">
                       <?php $existing = json_decode($admin_group->permissions);  ?>
                       <?php foreach($admin_menus as $permission): ?>
                           <input <?php echo e(in_array($permission->slug,$existing) ? "checked":""); ?> name="permissions[]" type="checkbox" value="<?php echo e($permission->slug); ?>"><?php echo e($permission->name); ?><br/>
                           <?php endforeach; ?>
                   </div>
               </div>
               <div class="form-group">
                   <label class="control-label col-md-3">&nbsp;</label>
                   <div class="col-md-4">
                       <button class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                   </div>
               </div>
           </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>