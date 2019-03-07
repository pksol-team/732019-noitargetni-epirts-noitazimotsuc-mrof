<?php $__env->startSection('content'); ?>
<div style="height:100%;" id="content"> 
    <div id="_master" style="height:100%;" data-reactroot="" data-reactid="1" data-react-checksum="-1300440954">
        <!-- react-empty: 2 --><!-- react-empty: 3 -->
        <div style="height:100%;" data-reactid="4">
            <div id="home" style="height:100%;" class="parent" data-reactid="6">
                <div class="st-container wrapper " data-reactid="7">
                    <div class="st-pusher bjGoIs">
                        <div class="st-content">
                            <div><!-- react-empty: 818 -->
                                <div style="padding-top: 10px;"></div>
                                <div id="order-page"><span></span>


                                    <div class="container"
                                         style="overflow: hidden; padding-top: 3px; padding-bottom: 20px;">
                                        <div>
                                            <form enctype="multipart/form-data" id="main_order_form" method="post" action="<?php echo e(url("stud/new")); ?>">
                                                <?php echo csrf_field(); ?>

                                                <div class=""
                                                     style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; padding-right: 0px; padding-left: 0px;">
                                                    <?php echo $__env->make('client.speedy_tabs.tabs_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    <div style="padding: 20px;">
                                                    <?php echo $__env->make('client.speedy_tabs.paper_info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                        
                                                    <?php echo $__env->make('client.speedy_tabs.price_calculation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    <?php echo $__env->make('client.speedy_tabs.extra_features', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                    </div>
                                                    <input type="hidden" name="pay_now" value="1">
                                                </div>
                                            
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <style type="text/css">
        .price_image_div{
            color: rgba(0, 0, 0, 0.870588);
            background-color: rgba(45, 149, 191, 0.14902);
            transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;
            box-sizing: border-box; font-family: Roboto, sans-serif;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px;
            border-radius: 2px; height: 72px;
            padding: 20px 0px;
            text-align: center;
            font-size: 24px;
        }
        .pricing_image{
            width: 113%;
            margin-left: -7%;
            margin-top: -13px;
        }
    </style>
<?php echo $__env->make('client.speedy_tabs.javascript', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>