 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Please Complete Your Profile</div>
        </div>
        <div class="panel-body">
            <?php if($step==0): ?>
            <form enctype="multipart/form-data" action="<?php echo e(URL::to('user/complete_profile')); ?>" class="form-horizontal" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="step" value="<?php echo e($step); ?>">
                <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-4">
                        <h3>Background Information</h3>
                        <hr/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Your Native Language</label>
                    <div class="col-md-4">
                        <input required type="text" value="<?php echo e(old('native_language',$profile->native_language)); ?>" name="native_language" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Highest Verifiable Academic Level</label>
                    <div class="col-md-4">
                        <select required class="form-control" name="academic_id">
                        <?php foreach($academics as $academic): ?>
                            <option value="<?php echo e($academic->id); ?>"> <?php echo e($academic->level); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Describe Yourself</label>
                    <div class="col-md-4">
                       <textarea required name="about" rows="10" cols="10" class="form-control"><?php echo e(old('about',$profile->about)); ?></textarea>
                    </div>
                </div>
                <div class="form-group <?php echo e($errors->has('cv') ? 'has-error':''); ?>">
                    <label class="col-md-3 control-label">Upload Your CV</label>
                    <div class="col-md-4">
                        <input required type="file" name="cv" class="form-control">
                    </div>
                    <div class="help-block">
                        <?php if($errors->has('cv')): ?>
                            <strong><?php echo e($errors->first('cv')); ?></strong>
                            <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp;</label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success">Certification &nbsp;<i class="fa fa-arrow-right"></i> </button>
                    </div>
                </div>
            </form>
                <?php elseif($step == 1): ?>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('user/complete_profile')); ?>" class="form-horizontal" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="step" value="<?php echo e($step); ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-4">
                            <h3>Certification</h3>
                            <hr/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Give you certificate a title</label>
                        <div class="col-md-4">
                           <input required type="text" name="cert_title" class="form-control" value="<?php echo e(old('cert_title')); ?>">
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('cert') ? "has-error":""); ?>">
                        <label class="col-md-3 control-label">Upload Certificate</label>
                        <div class="col-md-4">
                            <input required type="file" name="cert" class="form-control">
                            <div class="help-block">
                                <?php if($errors->has('cert')): ?>
                                    <strong><?php echo e($errors->first('cert')); ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-4">
                            <a class="btn btn-warning" href="<?php echo e(URL::to("user/complete_profile")); ?>"><i class="fa fa-arrow-left"></i> Back</a> <button type="submit" class="btn btn-success">Sample Essays &nbsp;<i class="fa fa-arrow-right"></i> </button>
                        </div>
                    </div>
                </form>
            <?php elseif($step == 2): ?>
                <form enctype="multipart/form-data" action="<?php echo e(URL::to('user/complete_profile')); ?>" class="form-horizontal" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="step" value="<?php echo e($step); ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-4">
                            <h3>Sample Essays</h3>
                            <hr/>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('title_1') ? 'has-error':''); ?>">
                        <label class="col-md-3 control-label">Essay 1 Title</label>
                        <div class="col-md-4">
                            <input required type="text" name="title_1" class="form-control" value="<?php echo e(old('title_1',$profile->title_1)); ?>">
                            <div class="help-block">
                                <?php if($errors->has('title_1')): ?>
                                    <strong><?php echo e($errors->first('title_1')); ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('file_1') ? "has-error":""); ?>">
                        <label class="col-md-3 control-label">Upload Essay 1 File</label>
                        <div class="col-md-4">
                            <input required type="file" name="file_1" class="form-control">
                            <div class="help-block">
                                <?php if($errors->has('file_1')): ?>
                                    <strong><?php echo e($errors->first('file_1')); ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('title_2') ? 'has-error':''); ?>">
                        <label class="col-md-3 control-label">Essay 2 Title</label>
                        <div class="col-md-4">
                            <input required type="text" name="title_2" class="form-control" value="<?php echo e(old('title_2')); ?>">
                        </div>
                    </div>
                    <div class="form-group <?php echo e($errors->has('file_2') ? "has-error":""); ?>">
                        <label class="col-md-3 control-label">Upload Essay 2 File</label>
                        <div class="col-md-4">
                            <input required type="file" name="file_2" class="form-control">
                            <div class="help-block">
                                <?php if($errors->has('file_2')): ?>
                                    <strong><?php echo e($errors->first('file_2')); ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-4">
                            <a class="btn btn-warning" href="<?php echo e(URL::to("user/complete_profile?step=1")); ?>"><i class="fa fa-arrow-left"></i> Back</a> <button type="submit" class="btn btn-success">Academics&nbsp;<i class="fa fa-arrow-right"></i> </button>
                        </div>
                    </div>
                </form>
            <?php elseif($step == 3): ?>
                <form id="form_4" style="" class="form-horizontal pull-left" method="post">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="step" value="<?php echo e($step); ?>">
                    <div class="form-group">
                        <label class="col-md-1 control-label">&nbsp;</label>
                        <div class="col-md-10">
                            <h3>Skills and Specialization Fields</h3>
                            <hr/>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('style_ids') ? ' has-error' : ''); ?>">
                        <label class="col-md-1 control-label">Writing Styles</label>
                        <div class="col-md-10">
                            <?php if($errors->has('style_ids')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('style_ids')); ?></strong>
                            </span>
                            <?php endif; ?>
                            <?php foreach($styles as $style): ?>
                                <input type="checkbox" name="style_ids[]" value="<?php echo e($style->id); ?>"> <?php echo e($style->label); ?><br/>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('subject_ids') ? ' has-error' : ''); ?>">
                        <label class="col-md-1 control-label">Academic Disciplines</label>
                        <div class="col-md-10">
                            <?php if($errors->has('subject_ids')): ?>
                                <span class="help-block">
                                        <strong><?php echo e($errors->first('subject_ids')); ?></strong>
                            </span>
                            <?php endif; ?>
                            <?php $sub_count = 0; ?>
                            <?php foreach($subjects as $subject): ?>

                                <?php if($sub_count%4==0): ?>
                                    <div class="row"></div>
                                <?php endif; ?>
                                <div class="col-md-3">
                                    <input class="" type="checkbox" name="subject_ids[]" value="<?php echo e($subject->id); ?>"> <?php echo e($subject->label); ?>


                                </div>
                                <?php $sub_count++; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">&nbsp;</label>
                        <div class="col-md-4">
                            <a class="btn btn-warning" href="<?php echo e(URL::to("user/complete_profile?step=2")); ?>"><i class="fa fa-arrow-left"></i> Back</a> <button type="submit" class="btn btn-success">Payment&nbsp;<i class="fa fa-arrow-right"></i> </button>
                        </div>
                    </div>
                </form>
                <?php elseif($step==4): ?>
                    <form enctype="multipart/form-data" action="<?php echo e(URL::to('user/complete_profile')); ?>" class="form-horizontal" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="step" value="<?php echo e($step); ?>">
                        <div class="form-group">
                            <label class="col-md-3 control-label">&nbsp;</label>
                            <div class="col-md-4">
                                <h3>Payment and Experience</h3>
                                <hr/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ever Worked in another Company?</label>
                            <div class="col-md-4">
                                <select id="company_select" onchange="showCompany();" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div id="other_company" style="display: none;" class="form-group">
                            <label class="col-md-3 control-label">Company Name</label>
                            <div class="col-md-4">
                                <input type="" name="other_company" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Paypal Email</label>
                            <div class="col-md-4">
                                <input required type="text" name="payment_terms" class="form-control" value="<?php echo e(old('payment_terms')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">&nbsp;</label>
                            <div class="col-md-4">
                                <a class="btn btn-warning" href="<?php echo e(URL::to("user/complete_profile")); ?>"><i class="fa fa-arrow-left"></i> Back</a> <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Complete &nbsp; </button>
                            </div>
                        </div>
                    </form>
                <script type="text/javascript">
                    function showCompany(){
                        var sel = $("#company_select").val();
                        if(sel==1){
                            $("#other_company").slideDown();
                        }else{
                            $("#other_company").slideUp();
                        }
                    }
                </script>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>