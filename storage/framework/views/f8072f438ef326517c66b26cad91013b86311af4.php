<?php $__env->startSection('header'); ?>
<?php echo $__env->make('front.sub_parts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title','My Account | Login Page'); ?>

  <div class="container-fluid register-page">
   <div class="row">
    <div class="container">
        <div class="row">
		
            <div class="col-xs-12">
			<div class="row">
			  <div class="col-sm-7 col-md-8 col-xs-12">
          <!-- login  -->
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('user/login')); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">E-Mail or Username</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('forgot/password')); ?>">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			</div>
					<div class="col-sm-5 col-md-4 col-xs-12 features-links">
			    <ul>
			       <li><a href="<?=url("/")?>">Assignment</a></li>
			       <li><a href="<?=url("/essay-writer")?>">Essay Writer</a></li>
			       <li><a href="<?=url("/case-study")?>">Case Study</a></li>
			       <li><a href="<?=url("/dissertation")?>">Dissertation</a></li>
			       <li><a href="<?=url("/homework")?>">Homework</a></li>
			       <li><a href="<?=url("/coursework")?>">Course Work</a></li>
			       <li><a href="<?=url("/research-papers")?>">Research</a></li>
			       <li><a href="<?=url("/thesis")?>">Thesis</a></li>
			 </ul>
			</div>
        </div>
        </div>
        </div>
    </div>
    </div>
    </div>
      
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('front.sub_parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>   

<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'front.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>