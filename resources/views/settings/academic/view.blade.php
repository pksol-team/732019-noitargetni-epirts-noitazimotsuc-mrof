 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{ $academic->level }}</div>
    </div>
    <div class="panel-body">

    </div>
</div>
</div>
@endsection