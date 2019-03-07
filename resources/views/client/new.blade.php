@section('header')
@include('front.sub_parts.header')
@endsection
@show
@section('content')
@extends(@Auth::user()->role=='admin'|| (@Auth::user()->role=='client') ? 'layouts.gentella':'front.layouts.master')
<div class="container-fluid paper-info">
<div  id="content"> 
    <div id="_master"  data-reactroot="" data-reactid="1" data-react-checksum="-1300440954">
        <!-- react-empty: 2 --><!-- react-empty: 3 -->
        <div  data-reactid="4">
            <div id="home"  class="parent" data-reactid="6">
                <div class="st-container wrapper " data-reactid="7">
                    <div class="st-pusher bjGoIs">
                        <div class="st-content">
                            <div><!-- react-empty: 818 -->
                                <div style="padding-top: 10px;"></div>
                                <div id="order-page"><span></span>

                                    <div class="row">
                                    <div class="container"
                                         style="overflow: hidden; padding-top: 3px; padding-bottom: 20px;">
									<div class="row">
									 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
									  <div class="row">
									    <div class="col-sm-9 col-md-8 col-xs-12 left">
                                        <div>
                                            <form enctype="multipart/form-data" id="main_order_form" method="post" action="{{ url("stud/new") }}">
                                                {!! csrf_field() !!}
                                                <div class=""
                                                     style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; padding-right: 0px; padding-left: 0px;">
                                                    {{-- @include('client.speedy_tabs.tabs_header') --}}
                                                    <div style="padding: 20px;">
                                                    @include('client.speedy_tabs.paper_info')
                                                        
                                                    @include('client.speedy_tabs.price_calculation')
                                                    @include('client.speedy_tabs.extra_features')
                                                    </div>
                                                    <input type="hidden" name="pay_now" value="1">
                                                </div>
                                            
                                            </form>
                                           </div>
                                        </div>
                                        <?php if(@Auth::user()->role !='admin') {?>
										<div class="col-sm-3 col-md-4 col-xs-12 right-box">
										  <div class="row">
										    <div class="col-xs-12 box-main">
										    <div class="row">
											    <div class="col-xs-12 head-box">
												   <h1>Price: <span class="total_price_box_full">$10.00</span></h1>
												</div>
											</div>
										<div class="row">
											<div class="col-xs-12 contents">
											   <ul>
											    <!-- <li><img src="https://d13yqfbidbuu4k.cloudfront.net/dwfnvjkfnqF31pc/visa.jpg" alt="card"></li> -->
											    <li><img src="{{URL::asset('assets/images/mastercard.jpg') }}" alt="card"></li>
											    <li><img src="{{URL::asset('assets/images/paypal.jpg') }}" alt="card"></li>
											    <li><img src="{{URL::asset('assets/images/amex.jpg') }}" alt="card"></li>
											    <!-- <li><img src="https://d13yqfbidbuu4k.cloudfront.net/dwfnvjkfnqF31pc/visa.jpg" alt="card"></li> -->
											    <!-- <li><img src="https://d13yqfbidbuu4k.cloudfront.net/dwfnvjkfnqF31pc/visa.jpg" alt="card"></li> -->
											   </ul>
											</div>
											</div>
											</div>
											</div>
										</div>
                                        <?php }?>
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
</div>
</div>
</div>
</div>




<link rel="stylesheet" href="https://www.essayprint.com/front/css/style.css">
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
{{-- <script src="https://www.essayprint.com/js/jquery.min.js"></script> --}}
<script src="assets/js/jquery.min.js"></script>

@include('client.speedy_tabs.javascript')
@endsection
@section('footer')
@include('front.sub_parts.footer')
@endsection

@show   