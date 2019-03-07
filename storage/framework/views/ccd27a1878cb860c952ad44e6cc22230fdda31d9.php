<div style="padding: 0px;display:none;" id="tab_content_3" class="tab_content_form">
<div><!-- react-empty: 4537 -->
        <div>
            <div class="total-price" id="box_total_price">
                <div class="total_price_container">
                    <h3 class="total-price-header light">Grand total price:&nbsp; <span class="total-price-sum  total_price total_price_box total_price_box_full"></span></h3>
                    <input type="hidden" name="total_price" class="total_price_box" value="">
                </div>
            </div>
            <div class="form-group  row"><label class="control-label col-xs-12 col-sm-3 col-md-4 align-left"><span>Choose your writer</span></label>
                <div class="col-xs-12 col-sm-9 col-md-8">
                    <div type="select" value="1" label="Choose your writer"
                         class="ButtonGroup btn-group btn-group-justified">
                        <?php $wtr_id = $writer_categories[0]->id ?>
                        <?php foreach($writer_categories as $writer_category): ?>
                            <a onclick="return setWriterCategory(<?php echo e($writer_category->id); ?>);" href="#" id="writer_category_<?php echo e($writer_category->id); ?>" class="writer-categories btn btn-default <?php echo e($writer_category->id == $wtr_id ? 'active':''); ?>" role="button"><span
                                        style="white-space: normal;">
                                    <span style="font-size: 16px;"><?php echo e($writer_category->name); ?></span><hr
                                            class="border" style="margin: 10px;"><span
                                            style="font-size: 16px; font-weight: 500;"><?php if($writer_category->amount>0): ?>
                                            +<?php echo e($writer_category->inc_type!='percent' ? "$":""); ?><?php echo e($writer_category->amount); ?><?php echo e($writer_category->inc_type=='percent' ? "%":""); ?>

                                        <?php else: ?>

                                    <?php endif; ?>
                                    </span></span>
                            </a>

                        <?php endforeach; ?>
                    <input type="hidden" name="writer_category_id" value="<?php echo e($wtr_id); ?>">
                    </div>
                </div>
            </div>
        </div>
    <?php if(count($additional_features)): ?>
        <div class="form-group row"><label class="control-label col-xs-12 col-sm-3 col-md-4 align-left">Additional
                features</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <?php foreach($additional_features as $feature): ?>
                    <input type="checkbox" name="feature_ids[]"> &nbsp;<?php echo e($feature->name); ?>

                 <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <input type="hidden" name="total_price">
    <input type="hidden" name="discounted">
        <div class="form-group row" style="margin-bottom: 0px;"><label
                    class="control-label col-xs-12 col-sm-3 col-md-4 align-left">Discount</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <div class="row">
                    <div class="col-xs-7 col-sm-8" style="padding-right: 5px;">
                        <div class="form-group" id="pricediv">
                            <small id="responsi" style="color:red;"></small><input onchange="useCode();" placeholder="Promotion Code" id="promotion" type="text" class="form-control" style="" name="promotion"><a style="color:white;font-weight:bolder;" onclick="return useCode();" class="label label-success"><span class="glyphicon glyphicon-ok"></span> Use Code</a>
                            <span class="help-block"></span></div>
                    </div>
                    <div class="col-xs-5 col-sm-4" style="padding-left: 5px;">
                        <button tabindex="0" type="button"
                                style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: default; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); height: 36px; line-height: 36px; min-width: 88px; color: rgba(0, 0, 0, 0.298039); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; border-radius: 2px; user-select: none; position: relative; overflow: hidden; background-color: rgb(255, 255, 255); text-align: center; width: 100%;">
                            <span style="position: relative; padding-left: 16px; padding-right: 16px; vertical-align: middle; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; font-size: 14px;">Apply</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 5px;"></div>
    <div class="form-group row" style="margin-bottom: 0px;"><label
                    class="control-label col-xs-12 col-sm-3 col-md-4 align-left">Preferred Writer ID</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                <div class="row">
                    <div class="col-xs-7 col-sm-8" style="padding-right: 5px;">
                        <div class="form-group" id="dive">
                            <small id="preffered_status"></small>
                            <input type="text" onchange="return setPreferred();"  placeholder="Writer ID" name="writer_id" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 5px;"></div>
        <?php if(Auth::user()): ?>
        <div style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; z-index: 1; overflow: visible;">
            <div style="padding-bottom: 0px;">
                <div id="user-area-card" style="padding: 20px; font-size: 16px; font-weight: 400;">
                    You are logged in as
                    <?php echo e(Auth::user()->email); ?>

                </div>
            </div>
        </div>
        <?php else: ?>
        <div id="tabs_customer_type" style="color: rgba(0, 0, 0, 0.870588); display: none; background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; z-index: 1; overflow: visible;">
            <div style="padding-bottom: 0px;">
                <div class="tabs_customer_type_content" id="user-area-card" style="padding: 20px; font-size: 16px; font-weight: 400;">

                </div>
            </div>
        </div>
    <div id="registration_tab">
        <?php echo $__env->make('client.speedy_tabs.register_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

        <?php endif; ?>
        <div style="margin-top: 20px;"></div>
        <div class="row">
            <div class="col-xs-4">
                <button id="step-3-back" tabindex="0" type="button"
                        style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); height: 36px; line-height: 36px; min-width: 88px; color: rgb(51, 122, 183); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; border-radius: 2px; user-select: none; position: relative; overflow: hidden; background-color: rgb(255, 255, 255); text-align: center; width: 100%;">
                    <div>
                        <span onclick="switchFormTab(2)" style="position: relative; padding-left: 16px; padding-right: 16px; vertical-align: middle; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; font-size: 14px;">&lt; Back</span>
                    </div>
                </button>
            </div>
            <div class="row">
                <div class="nextBurtton">
                    <button onclick="return payLater();" class="btn pull-left btn-xs btn-info orderform-submit" <?php echo e(Auth::user() ? '':'disabled="true"'); ?> tabindex="0" type="submit">
                        <div>
                            <div style="">

                                <span style="font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Pay Later</span>
                            </div>
                        </div>
                    </button>
                    <button class="btn btn-primary pull-right orderform-submit" <?php echo e(Auth::user() ? '':'disabled="true"'); ?> tabindex="0" type="submit">
                        <div>
                            <div style="height: 36px; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">

                                <span style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Proceed to checkout</span>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .total-price{
        display: table;
        margin-bottom: 21px;
        width: 100%;
        border: 1px solid #d6decf;
        border-spacing: 15px;
        border-radius: 3px;
        background-color: #eff6e9;
        color: #63695e;
        text-align: center;
    }
    .step2_total_price_place {
        width: 30%;
        text-align: right;
        white-space: nowrap;
    }

    .step2_total_price_place p {
        font-size: 14px;
        color: inherit;
    }
    .step2_total_price_place p .total-price-sum {
        font-size: 20px;
        color: #5e8c31;
    }
</style>
<script type="text/javascript">
    function payLater(){
        $("input[name='pay_now']").val(0);
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