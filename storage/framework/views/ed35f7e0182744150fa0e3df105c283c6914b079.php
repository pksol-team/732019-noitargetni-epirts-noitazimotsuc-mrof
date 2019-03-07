<br/><a href="#subject_modal" onclick="resetForm('subject_form')" data-toggle="modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Subject</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php foreach($subjects as $subject): ?>
        <tr>
            <td><?php echo e($subject->id); ?></td>
            <td><?php echo e($subject->label); ?></td>
            <td>
                <button class="btn btn-xs btn-success" onclick="getEditItem('<?php echo e(URL::to('designer/subject')); ?>',<?php echo e($subject->id); ?>,'subject_modal')"><i class="fa fa-pencil"></i> Edit</button>
                <button class="btn btn-xs btn-danger" onclick="deleteItem('<?php echo e(URL::to("designer/subject")); ?>',<?php echo e($subject->id); ?>)"><i class="fa fa-trash"></i> Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="modal fade" id="subject_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <a data-dismiss="modal" class="btn btn-danger pull-right">&times;</a>
                    Subject Form
                </div>
            </div>
            <div class="modal-body">
                <form id="subject_form" class="form-horizontal ajax-post" action="<?php echo e(URL::to('designer/subject')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="label">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">&nbsp;</label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>