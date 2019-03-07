 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                All Academic Levels
                <a href="#general_adjust_modal" data-toggle="modal" class="btn btn-success">Adjust Rates</a>
                <a href="<?php echo e(URL::to('settings/academic/add')); ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New</a> </div>
        </div>
        <div class="panel-body">
            <table class="table table-condensed table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Level</th>
                    <th>Rates</th>
                    <th>Action</th>
                </tr>

                <?php foreach($academics as $academic): ?>
                    <tr>
                        <td><?php echo e($academic->id); ?></td>
                        <td><?php echo e($academic->level); ?></td>
                        <td>
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>Hours</th>
                                    <th>Label</th>
                                    <th>Cost</th>
                                    <th>
                                        <button onclick="return showRow('<?php echo e($academic->id); ?>');" class="label label-info"><i class="fa fa-plus"></i> Add</button>
                                    </th>
                                </tr>
                                <?php $no  = 0;  ?>
                                <?php foreach($rates = $academic->rates()->where('deleted','=',0)->get() as $rate): ?>
                                   <?php $no++; ?>
                                    <tr>
                                        <td><?php echo e($no); ?></td>
                                        <td><?php echo e($rate->hours); ?></td>
                                        <td><?php echo e($rate->label); ?></td>
                                        <td>$<?php echo e($rate->cost); ?></td>
                                        <td>
                                            <a onclick="return editRate('<?php echo e($academic->id); ?>','<?php echo e($rate->id); ?>','<?php echo e($rate->hours); ?>','<?php echo e($rate->label); ?>','<?php echo e($rate->cost); ?>');" href="#"><i class="fa fa-edit"></i></a> |
                                            <a onclick="return confirm('Are you sure?');" style="color: red;" href="<?php echo e(URL::to("settings/academic/rates/delete/$rate->id")); ?>"><i class="fa fa-remove"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <tr style="display: none;" id="rate_row<?php echo e($academic->id); ?>">
                                <form method="post" action="<?php echo e(URL::to("settings/academic/$academic->id/add_rate")); ?>" id="rate_form<?php echo e($academic->id); ?>">
                                   <?php echo e(csrf_field()); ?>

                                    <td><input id="id_<?php echo e($academic->id); ?>" type="hidden" name="id"> </td>
                                    <td><input id="hours_<?php echo e($academic->id); ?>" class="form-control" type="text" name="hours" value=""></td>
                                    <td><input id="label_<?php echo e($academic->id); ?>" class="form-control" type="text" name="label"> </td>
                                    <td><input id="cost_<?php echo e($academic->id); ?>" class="form-control" type="text" name="cost"> </td>
                                    <td><button class="label label-success" type="submit"><i class="fa fa-check"></i> </button> <button onclick="return hideRow('<?php echo e($academic->id); ?>');" class="label label-danger"><i class="fa fa-remove"></i> </button> </td>
                                </form>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <a href="<?php echo e(URL::to("settings/academic/edit/$academic->id")); ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>
                            <a onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("settings/academic/delete/$academic->id")); ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i> Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </table>
            <?php /*<?php echo e($academics->links()); ?>*/ ?>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        function hideRow(id){
            $("#rate_row"+id).slideUp();
            $("#id_"+id).val('');
            $("#hours_"+id).val('');
            $("#label_"+id).val('');
            $("#cost_"+id).val('');
            return false;
        }
        function showRow(id){
            $("#rate_row"+id).slideDown('slow');
            $("#id_"+id).val('');
            $("#hours_"+id).val('');
            $("#label_"+id).val('');
            $("#cost_"+id).val('');
            return false;
        }
        function editRate(rowid,id,hours,label,cost){
            $("#rate_row"+rowid).slideDown('slow');
            $("#id_"+rowid).val(id);
            $("#hours_"+rowid).val(hours);
            $("#label_"+rowid).val(label);
            $("#cost_"+rowid).val(cost);
            return false;
        }
    </script>
    <div class="modal fade" id="general_adjust_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        Adjust All Rates
                        <a data-dismiss="modal" class="btn btn-danger pull-right">&times;</a>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal ajax-post" method="post" action="<?php echo e(URL::to("settings/academic/adjust-all")); ?>">
                        <div class="form-group">
                            <?php echo e(csrf_field()); ?>

                            <label class="control-label col-md-2">Method</label>
                            <div class="col-md-6">
                                <select name="type" class="form-control">
                                    <option value="percent">Percentage</option>
                                    <option value="money">Money</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Amount</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="amount" max="100" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">&nbsp;</label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>