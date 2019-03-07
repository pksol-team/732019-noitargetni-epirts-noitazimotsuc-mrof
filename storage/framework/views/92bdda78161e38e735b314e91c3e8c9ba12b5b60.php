<?php $__env->startSection('header'); ?>
<?php echo $__env->make('front.sub_parts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>

<?$title= "Prices | $website[name]" ?>
<?php $__env->startSection('title',$title); ?>
 

<!-- how its work -->
<div class="container-fluid pricing">
   <div class="row">
        <div class="container">
		    <div class="row">
				   <h1>Pricing</h1>
				   <p>We at site.com are devoted to providing you with the best services at the best prices so that you end up satisfied with our services. We take four factors into consideration to fix the price of your order:</p>
					<ul>
						<li>Paper type: While we charge special prices for admission letters and application essays, other papers are charged at the same rate. </li>
						<li>Writing type: We charge more for original papers which have to be written from scratch when compared to the papers that require only our editing or proofreading services. </li>
						<li>Academic level: Papers which can be written using a lower writing of level are priced lower than papers requiring a higher writing level. </li>
						<li>Deadline: Papers with longer deadlines are cheaper than papers with short deadlines.</li>
					</ul>
			</div>
			   <div class="row">
			   <div class="col-xs-12 contents-page">
			    <div class="row">
		     <div class="col-xs-12 contents-table">
			    <div class="table-responsive">
				    <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>ACADEMIC LEVEL / DEADLINE</th>
       <?php foreach($deadlines as $deadline) { ?>
         <th><?php echo e($deadline['label']); ?></th>
       <?php } ?>
      </tr>
    </thead>
    <tbody>
     
       <?php foreach ($academic_levels as $academic_level) { ?>
       <tr>
         <td><?php echo $academic_level['level'] ?></td>
         

         <?php foreach ($deadlines as $deadline) { ?>
         	<td>
         	<?php foreach ($rates as $rate) { ?>
         		<?php
         		 if($academic_level['id']==$rate['academic_id'] and $deadline['label']==$rate['label'])
         		 { 
                    echo $rate['cost'];

         			?>


         	<?php 
         } } ?>
         	</td>
       <?php } ?>

       </tr>
      <?php  } ?>
     
      <tr>
       
      </tr>
      <tr>
        
      </tr>
    </tbody>
  </table>
				</div>
			 </div>
		  </div>
		  
				 <!-- offer -->
								<div class="row">
								   <div class="col-xs-12 offer">
								   <h4>We also offer discounts!</h4>
								   <p>At <span class="color"><?php echo $website['name']; ?></span>, we are amused when we see returning clients requesting our services. For this reason we have implemented a system of life time discounts. Your happiness is our responsibility; to make your experience with us more gratifying. </p>
								   
								   </div>
								   <div class="col-xs-12 offer-box">
								      <div class="row">
									     <div class="col-sm-4 box">
										    <h2>5%</h2>
											<p>for More than <span> $500 </span></p>
										 </div>
									     <div class="col-sm-4 box">
										    <h2>10%</h2>
											<p>for More than <span> $1000 </span></p>
										 </div>
									     <div class="col-sm-4 box">
										    <h2>15%</h2>
											<p>for More than <span> $2000 </span></p>
										 </div>
									  </div>
								   </div>
								</div>
								<!-- offer -->
								
				   
				  
		
      
    </div>
</div>	
</div>	
</div>	
</div>	
 <!-- how its work -->
 


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('front.sub_parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldSection(); ?>	
<?php echo $__env->make('front.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>