@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Designer Subject/Document Settings</div>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="{{ $tab=='subjects' ? 'active':'' }}"><a href="{{ URL::to("designer?tab=subjects") }}">Subjects</a></li>
                <li class="{{ $tab=='documents' ? 'active':'' }}"><a href="{{ URL::to("designer?tab=documents") }}">Documents</a></li>
            </ul>
            <div class="tab-content">
                <div class="row"></div>
                @include('settings.designer.tabs.'.$tab)
            </div>
        </div>
    </div>
@endsection