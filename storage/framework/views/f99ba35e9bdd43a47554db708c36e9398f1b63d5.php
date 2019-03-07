<?php if(!Auth::user()->author_type && Auth::user()->role =='client' && $website->author ==1): ?>
<div class="well col-md-10">
<form method="post" action="<?php echo e(url('stud/e-wallet')); ?>">
<?php echo e(csrf_field()); ?>

Hey <strong><?php echo e(Auth::user()->name); ?></strong> would you like to earn from your articles?
<div class="">
	<input required type="radio" name="author_type" value="2"><strong>Earn $50 per 300 posts</strong>
</div>
<div class="">
	<input required type="radio" name="author_type" value="1"></option><strong>Earn 10 Redeemable points by article visits(Default)</strong>
</div>
<div class="">
		<input class="btn btn-info btn-sm" type="submit" value="Save">

</div>
</div>

</form>

<?php endif; ?>
<div class="row"></div>