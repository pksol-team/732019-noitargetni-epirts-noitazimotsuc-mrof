@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">

        <div class="panel-body">

        </div>
    </div>
    <script type="text/javascript">

    </script>
@endsection