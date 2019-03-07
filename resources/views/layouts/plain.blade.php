<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>


  <link href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet">

  <link href="{{ URL::to('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('css/animate.min.css') }}" rel="stylesheet">
  <script src="{{ URL::to('tinymce/tinymce.min.js') }}"></script>

  <script src="{{ URL::to('js/local.js') }}"></script>

  <!-- Custom styling plus plugins -->
  <link href="{{ URL::to('magicsuggest/magicsuggest.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ URL::to('css/maps/jquery-jvectormap-2.0.3.css') }}" />
  <link href="{{ URL::to('css/icheck/flat/green.css') }}" rel="stylesheet" />
  <link href="{{ URL::to('css/floatexamples.css') }}" rel="stylesheet" type="text/css" />

  <script src="{{ URL::to('js/jquery.min.js') }}"></script>
  <script src="{{ URL::to('js/nprogress.js') }}"></script>


  <script src="{{ URL::to('magicsuggest/magicsuggest.js') }}"></script>
  <script src="{{ URL::to('rating/jquery.MetaData.js') }}"></script>
  <link href="{{ URL::to('rating/jquery.rating.css') }}" rel="stylesheet">
  <link href="{{ URL::to('css/range.css') }}" rel="stylesheet">
  <script src="{{ URL::to('rating/jquery.rating.js') }}"></script>
  <link rel="stylesheet" href="{{ URL::to('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{ URL::to('css/chat.css') }}" media="all" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{ URL::to('css/throbber.css') }}" media="all" rel="stylesheet" type="text/css"/>
  {{--<script src="{{ URL::to('js/local.js') }}"></script>--}}
  <link href="{{ URL::to('css/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css">

  <link href="{{ URL::to('intl-tel-input-master/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
  <script src="{{ URL::to('intl-tel-input-master/build/js/intlTelInput.js') }}"></script>

  <script src="{{ URL::to('js/star-rating.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to('js/highcharts/js/highcharts.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to('js/highcharts/js/highcharts-more.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to('js/jquery.toaster.js') }}"></script>
  <script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
<link rel="stylesheet" href="{{ URL::to('chosen/chosen.css') }}">
<script src="{{ URL::to('chosen/chosen.jquery.js') }}" type="text/javascript"></script>
  <script src="{{ URL::to('js/jquery.form.js') }}"></script>

</head>


<body class="nav-md">

<div style="margin-left:3%">
@yield('content')
</div>

  <script src="{{ URL::to('js/progressbar/bootstrap-progressbar.min.js') }}"></script>
  <script src="{{ URL::to('js/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <!-- icheck -->
  <script src="{{ URL::to('js/icheck/icheck.min.js') }}"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="{{ URL::to('js/moment/moment.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::to('js/datepicker/daterangepicker.js') }}"></script>
  <!-- chart js -->
  <script src="{{ URL::to('js/chartjs/chart.min.js') }}"></script>

  <script src="{{ URL::to('js/custom.js') }}"></script>




  <script src="{{ URL::to('js/pace/pace.min.js') }}"></script>

  <!-- skycons -->
  <script src="{{ URL::to('js/skycons/skycons.min.js') }}"></script>


  <!-- dashbord linegraph -->
  <script>



  </script>
  <script>
    NProgress.done();
  </script>
  <!-- /datepicker -->
  <!-- /footer content -->
</body>
<script src="{{ URL::to('js/jquery.datetimepicker.js') }}"></script>
<script type="text/javascript">
  $('a[href="' + window.location.hash + '"]').trigger('click');
  $('input[name="deadline"]').datetimepicker();
</script>
@include('includes.javascript')
</html>
@if(session('notice'))
  <script type="text/javascript">
    $.toaster({ priority : "{{ session('notice')['class'] }}", title : "{{ session('notice')['class'] }}", message : "{{ session('notice')['message'] }}"});
  </script>
  <?php session()->forget('notice'); ?>
@endif
