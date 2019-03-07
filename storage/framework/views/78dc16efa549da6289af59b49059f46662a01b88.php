 
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('client.includes.register', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php
            $deadline = \Carbon\Carbon::createFromTimestamp(strtotime($order->deadline));
        $repo = new \App\Repositories\OrderRepository();
            $cost = $repo->calculateCost($order);
            ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Confirm Order Details are Ok.</div>
        </div>
        <div class="panel-body">
            <?php /*<div class="alert alert-default col-md-5">*/ ?>
                <?php /*<div class="panel panel-default">*/ ?>
                    <?php /*<div class="panel-body">*/ ?>
                        <?php /*<ul style="font-size: large;" class="fa-ul">*/ ?>
                            <?php /*<?php foreach($website->punchlines as $punchline): ?>*/ ?>
                                <?php /*<li><i class="fa-li fa fa-check-square"></i> &nbsp;<?php echo e($punchline->assurance); ?> </li>*/ ?>
                            <?php /*<?php endforeach; ?>*/ ?>
                        <?php /*</ul>*/ ?>
                        <?php /*<br/>*/ ?>
                        <?php /*<?php if($website->promo_image): ?>*/ ?>
                            <?php /*<img height="200" src="<?php echo e(URL::to($website->promo_image)); ?>">*/ ?>
                        <?php /*<?php endif; ?>*/ ?>
                    <?php /*</div>*/ ?>
                <?php /*</div>*/ ?>
            <?php /*</div>*/ ?>
            <div class="alert alert-default col-md-13">
                <div class="panel panel-default">
                    <div class="panel-body">
                <table align="centre" class="table">
                    <tr>
                        <th>&nbsp;</th>
                        <th style="font-size:100%;" colspan="3">
                            <strong>Order Details</strong>
                            <div class="pull-right">
                                <a onclick="goBack();" class="btn btn-warning btn-sm" href="<?php echo e(URL::to("stud/new")); ?>"><i class="fa fa-arrow-left"></i> Back</a>
                                <?php if(@Auth::user()->role == 'admin'): ?>
                                    <a onclick="" class="btn btn-success btn-sm" href="<?php echo e(URL::to("order/create_order")); ?>"><i class="fa fa-check"></i> Complete</a>
                                <?php elseif($website->admin_quote): ?>
                                 <a onclick="return checkLogin();" class="btn btn-info btn-sm" href="<?php echo e(URL::to("stud/paylater/$order->id")); ?>"><i class="fa fa-check"></i> Place Order</a>
                                <?php else: ?>
                                <a onclick="return checkLogin();" class="btn btn-success btn-sm" href="<?php echo e(URL::to("stud/checkout/$order->id")); ?>"><i class="fa fa-paypal"></i> Checkout</a>
                                <?php endif; ?>
                            </div>
                        </th>
                    </tr>
                    <?php if(!$website->admin_quote): ?>
                    <?php if(!$order->partial): ?>
                    <tr id="pricediv" style="font-size:150%;color:red;">
                        <td><strong>Total Cost</strong></td>
                        <td><span id="ttl"><?php echo number_format($order->amount*$order->currency->usd_rate,2).' '.$order->currency->abbrev; ?></span></td>
                        <td><strong>Promotion Code</strong></td>
                        <td>
                            <small id="responsi" style="color:red;"></small><input id="promotion" type="text" class="form-control" style="width:100%;background-color:yellow;color:blue;font-size:large;" name="promotion"><a onclick="return useCode();" class="label label-success"><span class="glyphicon glyphicon-ok"></span> Use Code</a>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr class="alert alert-info">
                        <th>Cost</th>
                        <td colspan="3">
                            <span style="font-size:large;font-weight:bolder;" class="">Deposit Amount: <?php echo e(number_format((($order->amount*$order->currency->usd_rate)*0.3),2).' '.$order->currency->abbrev); ?></span>
                            <p>
                            The copy of your completed paper will be sent to you; after which the remaining <strong>70%</strong> will be paid.
                            </p>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endif; ?>
                    <input id="final_total" type="hidden" name="total" value="<?php echo $order->amount; ?>">
                    <tr>
                        <td><strong>Order Topic</strong></td>
                        <td colspan="3"><?php echo $order->topic; ?></td>

                    </tr>
                    <tr></tr>
                    <tr>
                        <td><strong>Preferred WriterID<small>(optional)</small></strong></td>
                        <td colspan="3">
                            <small id="preffered_status"></small>
                            <input type="text" onchange="return setPreferred();" name="writer_id" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Subject</strong></td>
                        <td><?php echo e($order->subject->label); ?></td>
                        <td><strong>Doc. Type</strong></td>
                        <td><?php echo e($order->document->label); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Language</strong></td>
                        <td><?php echo $order->language->label; ?></td>
                        <td><strong>Style</strong></td>
                        <td><?php echo e($order->style->label); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Academic Level</strong></td>
                        <td><?php echo e($order->academic->level); ?></td>
                        <td><strong>Sources</strong></td>
                        <td><?php echo e((int)$order->sources); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Pages</strong></td>
                        <td><?php echo e($order->pages); ?></td>
                        <td><strong>Spacing</strong></td>
                        <td><?php
                            if($order->spacing==1){
                                echo "Single Spaced";
                            }else{
                                echo "Double Spaced";
                            }?></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>Under Preview</td>
                        <td><strong>Deadline</strong></td>
                        <td><?php echo e(date('M d, Y H:i',strtotime($deadline))); ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3"><strong>Order Instructions</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo e($order->instructions); ?></td>
                    </tr>
                </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        checkLogin();
        function checkLogin(){
            <?php if(!Auth::user()): ?>
        $("#register_login").modal({
                backdrop: 'static',
                keyboard: true
            });
            return false;
            <?php endif; ?>
       }


        function useCode(){
            var code = $("#promotion").val();
            var order_id = "<?php echo e($order->id); ?>";
            var url = "<?php echo e(URL::to('promotions/search')); ?>";
            $.get(url,{code:code,order_id:order_id},function(data){
                var response = JSON.parse(data);
                $("#responsi").html('processing.. ');
                if(response.status){
                    $("#responsi").html('');
                    var total = parseInt($("#ttl").text());
                    var dis = 100-parseInt(response.percent);
                    var newtot = dis/100*total;
                    $("#final_total").val(newtot);
                    $("#pricediv").html('<td><strong>Total Cost</strong></td><td colspan="3" style="color:green;font-size:large;">Success! You have been awarded  <span style="color:red;">'+response.percent+'%</span> promotion on your order total.New cost is <span style="color:red;">$'+newtot.toFixed(2)+'</span> from <span style="color:red;">$'+total+'</span></td>')

                }else{
                    $("#responsi").html(response.error);
              }
            });
        }

        function goBack() {
            window.history.back();
        }

        function setPreferred(){
            $("#preffered_status").html('<span style="color:green;">Processing...</span>');
            var id = $("input[name='writer_id']").val();
            var data = {writer_id:id};
            var url = '<?php echo e(URL::to('stud/preferred_writer')); ?>';
            $.get(url,data,function(response){
                if(response=='true'){
                    $("#preffered_status").html('<span style="color:green;">Writer Found<i class="fa fa-check"></i></span>');
                }else{
                    $("#preffered_status").html('<span style="color:red;">Writer not found!<i class="fa fa-times"></i></span>');
                    $("input[name='writer_id']").val('');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>