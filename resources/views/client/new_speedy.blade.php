@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
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
                                            <form lpformnum="2" id="main_order_form" method="post" action="{{ url("stud/new") }}">
                                                {!! csrf_field() !!}
                                                <div class="col-sm-12 col-md-8 col-lg-9"
                                                     style="color: rgba(0, 0, 0, 0.870588); background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Roboto, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 6px, rgba(0, 0, 0, 0.117647) 0px 1px 4px; border-radius: 2px; padding-right: 0px; padding-left: 0px;">
                                                    @include('client.speedy_tabs.tabs_header')
                                                    <div style="padding: 20px;">
                                                    @include('client.speedy_tabs.paper_info')
                                                        
                                                    @include('client.speedy_tabs.price_calculation')
                                                    @include('client.speedy_tabs.extra_features')
                                                    </div>
                                                    <input type="hidden" name="pay_now" value="1">
                                                </div>
                                                <div class="hidden-sm hidden-xs col-md-4 col-lg-3">
                                                    <div><div>
                                                            <div class="price_image_div">
                                                                <span>Price: <span class="total_price_box_full"></span></span>
                                                            </div>
                                                            <img class="pricing_image" src="{{ url("img/pricing_image.png") }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

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
@include('client.speedy_tabs.javascript')
@endsection