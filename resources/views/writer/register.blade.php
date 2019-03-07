 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Fill in Your Profile Details</div>
        <div class="panel-body">

        </div>
    </div>
@endsection