<?php $__env->startSection('header'); ?>
<?php echo $__env->make('front.sub_parts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->yieldSection(); ?>
<?php $__env->startSection('content'); ?>

<?$title= "Revision Policy | $website[name]" ?>
<?php $__env->startSection('title',$title); ?>
  <!-- terms -->
   <div class="container-fluid terms-conditions">
       <div class="row">
	      <div class="container">
		    <div class="row">
			    <div class="col-xs-12 heading">
				   <h1>Revision Policy</h1>
				</div>
			</div>
		    <div class="row">
			    <div class="col-xs-12 contents">				   
				   <p>At <span class="color"><?php echo $website['name']; ?></span>, we take pride in providing prime-quality academic assistance. We are always ready to revise your paper if it does not entirely meet your specifications. We will revise your paper 3 times for free if your revision request follows our main terms:</p>
				  <ul>
				      <li><b>Instructions:</b> Your revision instructions should not contradict your initial instructions. In case our Quality Assurance Department decides that the initial instructions of the client are satisfied, his/her request for revision will be rejected.</li>
				      <li><b>Submission:</b> You can submit your revision request using the “Send for revision” button on your personal account page before approving the paper. If you would like to have your document revised after the approval, you will need to contact Customer Support Representatives within 7 days from the moment you approved the paper.</li>
				      <li><b>Deadline:</b> You can request unlimited free revisions any time before pressing the “Approve” button; Thus, do not press it at once and view the document in details in the preview mode. If you cannot clearly see the text in the preview mode due to some technical problems, contact our Customer Support Representatives and ask them for another variant of the work preview. You can also request a free revision within 7 days after the moment you approved the order. For orders that exceed 20 pages, a free revision is possible within 14 days after approval.</li>		
					  <li><b>Number of revisions:</b> We can complete unlimited revisions absolutely for free and only if they satisfy the conditions listed above.</li>						  
				   </ul>
				   <p>If your request instructions do not meet the requirements stated above, you should place a new order for editing/proofreading and clearly specify the changes that have to be made in the paper.</p>
					<P>If due to some reason you pressed the "Approve" button, but still need a revision, you can ask for it only within 7 days after the button is pressed. In this case you should contact Customer Support Representatives and ask for the necessary revision. After 7 days have passed, you cannot ask for a free revision. In this case you can place a new order for editing/proofreading.</P>
					<P>Please note that you have 7 days to approve the revised paper. Time for approval is calculated automatically from the moment the last version was uploaded to your personal order page. After this period, the paper (or a part of the paper) is approved automatically.</P>
				</div>
			</div>
		  </div>
	   </div>
   </div>
 <!-- terms -->




<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php echo $__env->make('front.sub_parts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldSection(); ?>	
<?php echo $__env->make('front.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>