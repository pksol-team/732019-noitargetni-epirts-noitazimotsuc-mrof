 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading">Application info for <strong><?php echo e($user->name); ?></strong> <?php if(Auth::user()->isAllowedTo('activate_writer') && $user->status==0): ?> <a onclick="return confirm('Are you sure?');" href="<?php echo e(URL::to("user/$user->id/activate")); ?>" class="btn btn-info pull-right">Activate</a> <?php endif; ?></div>
        <div class="panel-body">
           <div class="col-md-5">
               <div class="panel panel-default">
                   <div class="panel-heading">
                       Application Info
                   </div>
                   <div class="panel-body">
                       <table class="table table-bordered table-condensed">
                           <?php if(!@$profile->step): ?>
                               <tr>
                                   <td colspan="2">
                                       <div class="alert alert-info">Profile Form not yet completed</div>
                                   </td>
                               </tr>
                               <?php else: ?>

                           </tr>
                               <tr>
                               <th>Native Language</th>
                               <td><?php echo e(@$profile->native_language); ?></td>
                           </tr>
                           <tr>
                               <th>Education Level</th>
                               <td><?php echo e(@$profile->academic->level); ?></td>
                           </tr>
                           <tr>
                               <th>Paypal Email</th>
                               <td><?php echo e(@$profile->payment_terms); ?></td>
                           </tr>
                           <tr>
                               <th>Was Writer for</th>
                               <td><?php echo e(@$profile->other_company,'N/A'); ?></td>
                           </tr>
                           <tr>
                               <th colspan="2" align="">About</th>
                           </tr>
                           <tr>
                           </tr>
                           <tr>
                               <th>Subjects</th>
                               <td>
                                   <ul>
                                       <?php foreach($subjects as $subject): ?>
                                           <li><?php echo e($subject->label); ?></li>
                                       <?php endforeach; ?>
                                   </ul>

                               </td>
                           </tr>
                           <tr>
                               <th>Writing Styles</th>
                               <td>
                                   <ul>
                                       <?php foreach($styles as $style): ?>
                                           <li><?php echo e($style->label); ?></li>
                                       <?php endforeach; ?>
                                   </ul>

                               </td>
                           </tr>
                           <tr>
                               <th>Certificate</th>
                               <td>
                                   <?php if(isset($profile->cert_title)): ?>
                                   <?php echo e(@$profile->cert_title); ?><a class="btn btn-sm btn-success pull-right" href="<?php echo e(URL::to("order/download/$profile->cert_file_id")); ?>"><i class="fa fa-download"></i> </a>
                              <?php endif; ?>
                               </td>
                           </tr>
                           <tr>
                               <th colspan="2" align="center">Sample Essays</th>
                           </tr>
                           <tr>
                               <td colspan="2">
                                   <ul>
                                       <?php if(@$profile->sample_essays): ?>
                                       <?php foreach(json_decode($profile->sample_essays) as $essay): ?>
                                           <li><?php echo e($essay->title); ?><a class="btn btn-xs btn-success pull-right" href="<?php echo e(URL::to("order/download/$essay->file_id")); ?>"><i class="fa fa-download"></i> </a></li>
                                       <?php endforeach; ?>
                                           <?php endif; ?>
                                   </ul>

                               </td>
                           </tr>
                               <?php endif; ?>
                       </table>
                   </div>
               </div>
           </div>
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
                            <tr>
                                <th>E-mail</th>
                                <td><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td><?php echo e(ucwords($user->role)); ?></td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td><?php echo e(ucwords($user->country)); ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td><?php echo e(ucwords($user->phone)); ?></td>
                            </tr>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>