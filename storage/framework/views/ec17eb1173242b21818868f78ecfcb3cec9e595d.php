<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">Departments <a href="#department_modal" onclick="newDepartment();" data-toggle="modal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> </a> </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($departments as $department): ?>
                    <tr>
                        <td><?php echo e($department->id); ?></td>
                        <td><?php echo e($department->name); ?></td>
                        <td><?php echo e($department->description); ?></td>
                        <td>
                            <a onclick="return edit(<?php echo e($department->id); ?>,'<?php echo e(str_replace("'","",$department->name)); ?>','<?php echo e(str_replace("'","",$department->description)); ?>')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a onclick="return confirm('Are you sure?\n All messages in the department will be removed!');" href="<?php echo e(URL::to("/departments/delete/$department->id")); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="department_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                    Department Form
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post">
                        <input type="hidden" name="id">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-6">
                               <input type="text" name="name" required class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-6">
                                <textarea required class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">&nbsp;</label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function edit(id,name,description){
            $("input[name='id']").val(id);
            $("input[name='name']").val(name);
            $("textarea[name='description']").val(description);
            $("#department_modal").modal('show');
            return false;
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>