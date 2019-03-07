<div style="padding: 0px;" id="tab_content_3" class="tab_content_form">
    <h1 style="margin-bottom: 45px;margin-top: 0 !important;">Extra Features</h1>

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
                        @foreach($writer_categories as $writer_category)
                            <a onclick="return setWriterCategory({{ $writer_category->id }});" href="#" id="writer_category_{{ $writer_category->id }}" class="writer-categories btn btn-default {{ $writer_category->id == $wtr_id ? 'active':'' }}" role="button"><span
                                        style="white-space: normal;">
                                    <span style="font-size: 16px;">{{ $writer_category->name }}</span><hr
                                            class="border" style="margin: 10px;"><span
                                            style="font-size: 16px; font-weight: 500;">@if($writer_category->amount>0)
                                            +{{ $writer_category->inc_type!='percent' ? "$":"" }}{{ $writer_category->amount }}{{ $writer_category->inc_type=='percent' ? "%":"" }}
                                        @else

                                    @endif
                                    </span></span>
                            </a>

                        @endforeach
                    <input type="hidden" name="writer_category_id" value="{{ $wtr_id }}">
                    </div>
                </div>
            </div>
        </div>
    @if(count($additional_features))
        <div class="form-group row"><label class="control-label col-xs-12 col-sm-3 col-md-4 align-left">Additional
                features</label>
            <div class="col-xs-12 col-sm-9 col-md-8">
                @foreach($additional_features as $feature)
                    <input type="checkbox" name="feature_ids[]"> &nbsp;{{ $feature->name }}
                 @endforeach
            </div>
        </div>
    @endif
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
        @if(Auth::user())
        <div style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; z-index: 1; overflow: visible;">
            <div style="padding-bottom: 0px;">
                <div id="user-area-card" style="padding: 20px; font-size: 16px; font-weight: 400;">
                    You are logged in as
                    {{ Auth::user()->email }}
                </div>
            </div>
        </div>
        @else
        <div id="tabs_customer_type" style="color: rgba(0, 0, 0, 0.870588); display: none; background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; z-index: 1; overflow: visible;">
            <div style="padding-bottom: 0px;">
                <div class="tabs_customer_type_content" id="user-area-card" style="padding: 20px; font-size: 16px; font-weight: 400;">

                </div>
            </div>
        </div>
    <div id="registration_tab">
        @include('client.speedy_tabs.register_form')
    </div>

        @endif
        <div style="margin-top: 20px;"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group row" style="margin-bottom: 0px;">
                    <label class="control-label col-xs-12 col-sm-3 col-md-4 align-left">Select Payment Method</label>
                    <div class="col-xs-12 col-sm-9 col-md-8">
                        <div class="row">
                            <div class="col-xs-7 col-sm-8" style="padding-right: 5px;">
                                <div class="form-group" id="dive">
                                   <input type="radio" name="payment_method_" value="paypal" id="paypal">
                                    <label for="paypal">Paypal</label>
                                    <input type="radio" name="payment_method_" value="stripe" id="stripe">
                                     <label for="stripe">Stripe</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="row strip_data" style=" display: none;">
            <div class="col-sm-12">
                <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''}}"> 
                </div>


              <h1><img src="https://stripe.com/favicon.ico"><svg width="62" height="25"><title>Stripe</title><path d="M5 10.1c0-.6.6-.9 1.4-.9 1.2 0 2.8.4 4 1.1V6.5c-1.3-.5-2.7-.8-4-.8C3.2 5.7 1 7.4 1 10.3c0 4.4 6 3.6 6 5.6 0 .7-.6 1-1.5 1-1.3 0-3-.6-4.3-1.3v3.8c1.5.6 2.9.9 4.3.9 3.3 0 5.5-1.6 5.5-4.5.1-4.8-6-3.9-6-5.7zM29.9 20h4V6h-4v14zM16.3 2.7l-3.9.8v12.6c0 2.4 1.8 4.1 4.1 4.1 1.3 0 2.3-.2 2.8-.5v-3.2c-.5.2-3 .9-3-1.4V9.4h3V6h-3V2.7zm8.4 4.5L24.6 6H21v14h4v-9.5c1-1.2 2.7-1 3.2-.8V6c-.5-.2-2.5-.5-3.5 1.2zm5.2-2.3l4-.8V.8l-4 .8v3.3zM61.1 13c0-4.1-2-7.3-5.8-7.3s-6.1 3.2-6.1 7.3c0 4.8 2.7 7.2 6.6 7.2 1.9 0 3.3-.4 4.4-1.1V16c-1.1.6-2.3.9-3.9.9s-2.9-.6-3.1-2.5H61c.1-.2.1-1 .1-1.4zm-7.9-1.5c0-1.8 1.1-2.5 2.1-2.5s2 .7 2 2.5h-4.1zM42.7 5.7c-1.6 0-2.5.7-3.1 1.3l-.1-1h-3.6v18.5l4-.7v-4.5c.6.4 1.4 1 2.8 1 2.9 0 5.5-2.3 5.5-7.4-.1-4.6-2.7-7.2-5.5-7.2zm-1 11c-.9 0-1.5-.3-1.9-.8V10c.4-.5 1-.8 1.9-.8 1.5 0 2.5 1.6 2.5 3.7 0 2.2-1 3.8-2.5 3.8z"></path></svg></h1>

              

                  <div class="form-group">
                    <input type="text" class="form-control" id="email" placeholder="Card Number" name="number">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="pwd" placeholder="CVC" name="cvc">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" class="form-control" id="pwd" placeholder="Expire Month" name="exp_month">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" class="form-control" id="pwd" placeholder="Expire Year" name="exp_year">
                      </div>          
                    </div>
                  </div>
                      <div class="form-group">
                        <input type="text" class="form-control" id="pwd" placeholder="Name" name="client_name">
                      </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="pwd" placeholder="Phone Number" name="phone">
                  </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <button id="step-3-back" tabindex="0" type="button"
                        style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: inherit; font-weight: inherit; transform: translate(0px, 0px); height: 36px; line-height: 36px; min-width: 88px; color: rgb(51, 122, 183); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; border-radius: 2px; user-select: none; position: relative; overflow: hidden; background-color: rgb(255, 255, 255); text-align: center; width: 100%;">
                    <div>
                        <span onclick="switchFormTab(2)" style="position: relative; padding-left: 16px; padding-right: 16px; vertical-align: middle; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; font-size: 14px;">&lt; Back</span>
                    </div>
                </button>
            </div>

			<div class="col-xs-12 col-sm-8">
            
                <div class="nextBurtton">
              
                    <button class="btn btn-primary pull-right orderform-submit" {{ Auth::user() ? '':'disabled="true"' }} tabindex="0" type="submit" style="width:100%">
                        <div>
                            <div style="height:auto; border-radius: 2px; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;">

                                <span class="payment_stripe" style="position: relative; opacity: 1; font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Proceed to checkout</span>
                            </div>
                        </div>
                    </button>
					      <button onclick="return payLater();" class="btn pull-left btn-xs btn-info orderform-submit" {{ Auth::user() ? '':'disabled="true"' }} tabindex="0" type="submit" style="width:100%;margin-top:10px;height:32px">
                        <div>
                            <div style="">

                                <span style="font-size: 14px; letter-spacing: 0px; text-transform: uppercase; font-weight: 500; margin: 0px; user-select: none; padding-left: 16px; padding-right: 16px; color: rgb(255, 255, 255);">Pay Later</span>
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    function payLater(){
        $("input[name='pay_now']").val(0);
    }
    function setPreferred(){
        $("#preffered_status").html('<span style="color:green;">Processing...</span>');
        var id = $("input[name='writer_id']").val();
        var data = {writer_id:id};
        var url = '{{ URL::to('stud/preferred_writer') }}';
        $.get(url,data,function(response){
            if(response=='true'){
                $("#preffered_status").html('<span style="color:green;">Writer Found<i class="fa fa-check"></i></span>');
            }else{
                $("#preffered_status").html('<span style="color:red;">Writer not found!<i class="fa fa-times"></i></span>');
                $("input[name='writer_id']").val('');
            }
        });
    }


    $( "input" ).on( "click", function() {
      var payment_mehtod = $( "input:checked" ).val()
      // console.log(payment_mehtod);
        if(payment_mehtod == 'stripe'){
        
            $(".strip_data").show();

            $("span.payment_stripe").html('Pay');
            
            Stripe.setPublishableKey('pk_test_fu9pPdhwW3qilZxpvQ1UjF24');

            var $form = $("#main_order_form");

                console.log($form);
            $form.submit(function(event) {
           
              $('#charge-error').addClass('hidden');
              $form.find('button').prop('disabled', true);

              Stripe.card.createToken({
                number: $('input[name="number"]').val(),
                cvc: $('input[name="cvc"]').val(),
                exp_month: $('input[name="exp_month"]').val(),
                exp_year: $('input[name="exp_year"]').val(),
                name: $('input[name="client_name"]').val()
              }, stripeResponseHandler);
              return false;
            });

            function stripeResponseHandler(status, response){
              console.log(response.error);
              if(response.error){
                $('#charge-error').removeClass('hidden');
                $('#charge-error').text(response.error.message);
                $form.find('button').prop('disabled', false);
              }
              else{
                  var token = response.id;
                  $form.append($('<input type="hidden" name="stripe_token" >').val(token));

                  $form.get(0).submit();

              }
            }

        }else{
            $(".strip_data").hide();
            $("span.payment_stripe").html('Proceed to checkout');            
        }
    
    });
</script>