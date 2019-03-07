 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
@include('client.order_js')
{{ 'thisisisis' }}
<div class="inner" style="max-width: 800px; !important">
<?php
    $get_data = Request::all();
    ?>
    <link href="{{ URL::to('uvo/css.css') }}" rel="stylesheet" type="text/css">
    <meta name="verify-v1" content="+OUZMNSrPp1iZ3ewCKuNg6XyFkeiiuyIdp13DcECY2U=">
    <link href="{{ URL::to('uvo/gcommon_css.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('uvo/gcustom_css.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::to('chosen/chosen.jquery.js') }}" type="text/javascript"></script>

    <div class="uvo-iso">

    <div style="position: relative;" class="container">
        <div class="inner-content" style="/*width:100% !important;*/">
            <div class="mainInRgt cabinet">

                <article class="box-orderNow">
                    <div class="box-orderNowIn">
                        <h1 class="formtitle" data-finder="form.h1.title">Place an order. <span>It's fast, secure, and confidential.</span>
                        </h1>

                        <div id="potato-form-data-restored-notice" class="form-data-restored-notice"
                             style="display:none;"></div>
                        <form enctype="multipart/form-data" id="order_form" action="{{ URL::to('/stud/new') }}" class="orderform orderform-bordered f uvoform_potato " method="POST">
                        {{ csrf_field() }}
                            <select style="display:none;" name="language_id" onchange="getOrderCost();" class="form-control">
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->label }}</option>
                                @endforeach
                            </select>
                            <div class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="uvoform_tabs">

                                <ul role="tablist"
                                    class="orderform-tabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                                    <li aria-selected="true" aria-labelledby="ui-id-12" aria-controls="tab_services"
                                        tabindex="0" role="tab" id="li_tab_services"
                                        class="uvoform_nav_tab ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-tabs-active">
                                        <a tabindex="-1" role="presentation"
                                           class="input-model large ui-tabs-anchor" onclick="return stepOne();" href="#tab_services"><span
                                                    class="step-number">
                                                1. </span>Paper Details</a>
                                    </li>

                                    <li aria-selected="false" aria-labelledby="ui-id-13" aria-controls="tab_price"
                                        tabindex="-1" role="tab" id="li_tab_price"
                                        class="uvoform_nav_tab ui-state-default ui-corner-top">
                                        <a id="ui-id-13" tabindex="-1" role="presentation"
                                           class="input-model large ui-tabs-anchor" onclick="return stepTwo();" href="#tab_price"
                                        ><span class="step-number">2. </span>Price
                                            Calculation</a>
                                    </li>

                                     <li aria-selected="false" aria-labelledby="ui-id-13" aria-controls="tab_price"
                                        tabindex="-1" role="tab" id="li_tab_payment"
                                        class="uvoform_nav_tab ui-state-default ui-corner-top">
                                        <a id="ui-id-13" tabindex="-1" onclick="return stepThree();" role="presentation"
                                           class="input-model large ui-tabs-anchor" href="#tab_price"
                                        ><span class="step-number">3. </span>Payment Info
                                           </a>
                                    </li>
                                </ul>
                                @include('client.tab_paper')
                                @include('client.tab_price')
                                @include('client.tab_payment')
                            </div>
                        </form>
                    </div>
            </div>
            </article>
        </div>
    </div>
</div>
</div>
<style type="text/css">
    @media screen and (max-width: 580px){
        .visible-in-desktop {
            display: none !important;
        }
        .visible-in-mobile{
            display: block !important;
        }
    }
    .chosen-singl{
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
        font-size: large !important;
        height: height: 38px;
    }
</style>
@endsection

