<!-- <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet"> -->
<link href="{{ URL::to('css/ianbootstrap.css') }}" rel="stylesheet">
<link href="{{ URL::to('css/font-awesome.min.css') }}" rel="stylesheet">
<script src="{{ URL::to('js/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ URL::to('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link href="{{ URL::to('intl-tel-input-master/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ URL::to('intl-tel-input-master/build/js/intlTelInput.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script> -->
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script src="{{ URL::to('js/jquery.toaster.js') }}"></script>
<script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('js/local.js') }}"></script>
<link rel="stylesheet" href="{{ URL::to('css/chat.css') }}" media="all" rel="stylesheet" type="text/css"/>
<script src="{{ URL::to('js/star-rating.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('rating/jquery.MetaData.js') }}"></script>
<link href="{{ URL::to('rating/jquery.rating.css') }}" rel="stylesheet">
<script src="{{ URL::to('rating/jquery.rating.js') }}"></script>
<script src="{{ URL::to('js/star-rating.js') }}" type="text/javascript"></script>
<link href="{{ URL::to('intl-tel-input-master/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ URL::to('intl-tel-input-master/build/js/intlTelInput.js') }}"></script>
<script src="{{ URL::to('chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::to('js/highcharts/js/highcharts.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('js/highcharts/js/highcharts-more.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ URL::to('chosen/chosen.css') }}">
<div style="margin:7px;" class="bootstrap-iso">
    <h3>Order Panel</h3>
    @include('layouts.speedy.menus')
    <div class="col-md-8" style="width:75% float:right;">        
        @yield('content')
    </div>
</div>
<div class="bootstrap-iso">
@include('includes.javascript')
@include('includes.messages')
</div>





<script type="text/javascript">
    function getForPage(url){
        window.location = url;
    }
</script>
<style type="text/css">
    .bootstrap-iso .container {
        width: 1170px;
        width: 100% !important;
    }
    body:not(.template-slider) #Header {
    min-height: 120px;
}
</style>
@if(session('notice'))
    <script type="text/javascript">
        $.toaster({ priority : "{{ session('notice')['class'] }}", title : "{{ session('notice')['class'] }}", message : "{{ session('notice')['message'] }}"});
    </script>
    <?php session()->forget('notice'); ?>
@endif