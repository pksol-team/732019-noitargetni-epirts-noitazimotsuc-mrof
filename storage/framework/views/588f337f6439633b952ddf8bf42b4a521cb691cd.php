<?php
$referral_link  = URL::to("stud/new?referred_by=$user->id");
?>
<?php if($user->website->wallet == 1): ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">E-Wallet Overview</div>
     </div>
        <div class="panel-body">
            <div class="col-md-offset-1">
            <?php echo $__env->make('client.redeem_notice', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="form-group">
                    <label class="control-label col-md-2">Referral Link:</label>
                    <div class="col-md-8">
                        <p style="color:green;padding:5px;border:solid;border-width:0.2px;border-color:#00dd00;" name="link"><?php echo e($referral_link); ?></p>
                    </div>
                </div>
                <div class="row"></div>
                <script type="text/javascript">
                    function resetLink(){
                        $("input[name='link']").val('<?php echo e($referral_link); ?>');
                    }
                </script>
                <div class="row tile_count">
                    <?php if(Auth::user()->role != 'admin'): ?>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-anchor"></i> Total Orders</span>
                        <div class="count green"><?php echo e($user->orders->count()); ?></div>
                        <span class="count_bottom"><i class="green"><i class="fa fa-heart"></i> <span class="client_active"></span> </i> Active</span>
                    </div>
                    <?php endif; ?>
                    <div style="margin-right: 10px;" class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-google-wallet"></i> E-Wallet Balance</span>
                        <div class="count">$<?php echo e(number_format($user->getBalance(),2)); ?></div>
                        <?php if(Auth::user()->role == 'admin'): ?>
                        <span class="count_bottom"><a data-toggle="modal" href="#admin_top_up_modal" class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Top Up</a></span>
                        <?php else: ?>
                          <span class="count_bottom"><a data-toggle="modal" href="#top_up_modal" class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Top Up</a></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-building"></i> Loyalty Points</span>
                        <div class="count"><?php echo e($user->getPoints()); ?></div>
                        <?php if(Auth::user()->role == 'admin'): ?>
                        <span class="count_bottom"><a data-toggle="modal" href="#add_points_modal" class="btn btn-xs btn-info"><i class="fa fa-plus"></i> Add Points</a></span>
                       <?php else: ?>
                        <span class="count_bottom"><a data-toggle="modal" href="#redeem_modal" class="btn btn-xs btn-info"><i class="fa fa-coffee"></i> Redeem</a></span>
                      <?php endif; ?>
                    </div>
                    <?php if($user->website->author ==1): ?>
                      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-pencil"></i> Articles</span>

                          <div class="count"><?php echo e($user->articles()->count()); ?></div>
                          <span class="count_bottom"><i class="green"><i class="fa fa-heart"></i> <?php echo e($user->getUnredeemedArticles()); ?> </i> Redeemable</span>
<br/>
                      <?php if(Auth::user()->role == 'admin'): ?>
                        <span class="count_bottom"><a href="<?php echo e(url("order/articles?tab=published&user=$user->id")); ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View Articles</a></span>                        
                        <?php endif; ?>
                          <?php if(Auth::user()->role == 'client'): ?>
                              <span class="count_bottom"><a data-toggle="modal" href="#redeem_articles_modal" class="btn btn-xs btn-info"><i class="fa fa-coffee"></i> Redeem</a></span>

                          <?php endif; ?>
                    </div>
                            <div class="modal fade" role="dialog" id="redeem_articles_modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title">Redeem Articles<a data-dismiss="modal" class="pull-right btn-danger btn">&times;</a></div>
                                        </div>
                                        <div class="modal-body">
                                            <?php if($user->getUnredeemedArticles()>300): ?>
                                                <form class="form-horizontal ajax-post" action="<?php echo e(URL::to('stud/redeem-articles')); ?>">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="form-group">
                                                        <?php
                                                        $redeemable = $user->getUnredeemedArticles();
                                                        $selects = explode('.',$redeemable/300)[0];
                                                        $i=0;
                                                        ?>
                                                <label class="control-label col-md-4">Articles</label>
                                                            <div class="col-md-5">
                                                        <select class="form-control" name="amount">
                                                            <?php while($i<$selects): ?>
                                                                <?php $i++; ?>
                                                            <option value="<?php echo e($i*50); ?>"><?php echo e($i*300); ?> articles for $<?php echo e($i*50); ?></option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">

                                                        <label class="control-label col-md-4">&nbsp;</label>
                                                        <div class="col-md-5">
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Redeem</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php else: ?>
                                                <div class="alert alert-info">Minimum redeemable articles should be 300, please submit more articles</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endif; ?>
                    <?php if(Auth::user()->role != 'admin'): ?>
                    <div class="row"></div>
                    <div class="row"></div>
                    <hr/>
                    <div class="col-md-8 col-xs-6">
                        <p>Earn <strong>+</strong><?php echo e($www->getReferralPoints()); ?> more points by referring a friend to us.
                            <br/><strong><i class="fa fa-info"></i> Tip</strong> Share your referral url to your friends in social media to get more points
                        <p> <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($referral_link); ?>"><i class="fa fa-facebook fa-2x"></i> </a>&nbsp;
                            <a target="_blank" href="https://twitter.com/home?status=<?php echo e($referral_link); ?>"><i class="fa fa-twitter fa-2x"></i> </a>&nbsp;
                            <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e($referral_link); ?>&title=Get%20Academi%20Help&summary=&source="><i class="fa fa-linkedin fa-2x"></i> </a>&nbsp;
                            <a target="_blank" href="https://plus.google.com/share?url=<?php echo e($referral_link); ?>"><i class="fa fa-google-plus fa-2x"></i> </a>&nbsp;
                            <a target="_blank" href="mailto:?&subject=Get Online Academic Assistance&body=Hey,%20Get%20High%20quality%20academic%20assignment%20and%20research%20help%20%0A%3Ca%20href=%22<?php echo e($referral_link); ?>%22%3E<?php echo e($referral_link); ?>%3C/a%3E"><i class="fa fa-envelope fa-2x"></i> </a>&nbsp;
                        </p>
                        </p>
                        <a class="btn btn-success" data-toggle="modal" href="#faq_modal">More Tips <i class="fa fa-question"></i> </a>
                    </div>
                        <?php endif; ?>
                </div>
        </div>
    </div>
    <?php if(Auth::user()->role == 'admin'): ?>
        <div id="add_points_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                        Add Points
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal ajax-post" method="post" action="<?php echo e(URL::to("user/view/$user->role/$user->id")); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PUT')); ?>

                            <div class="form-group">
                                <label class="control-label col-md-3">Amount</label>
                                <div class="col-md-8">
                                    <input type="number" min="1" value="" class="form-control" name="points">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Reason</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="reason">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="admin_top_up_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="pull-right btn btn-danger" data-dismiss="modal">&times;</button>
                        Top Up Account
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal ajax-post" method="post" action="<?php echo e(URL::to("user/view/$user->role/$user->id")); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PATCH')); ?>

                            <div class="form-group">
                                <label class="control-label col-md-3">Amount</label>
                                <div class="col-md-6">
                                    <input type="text" required value="" class="form-control" name="amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Method</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="via">
                                        <option value="paypal">Paypal</option>
                                        <option value="invoice">Invoice</option>
                                        <option value="manual">manual</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Reference</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="reference">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">&nbsp;</label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>