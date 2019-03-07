 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Subjects <a href="{{ URL::to("settings/add/subject") }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD</a></div>
        </div>
        <div class="panel-body">
            <table id="rates_table" class="table table-bordered table-striped">
                <tr class="tabular">
                    <th>ID</th>
                    <th>Label</th>
                    <th>Inc. Type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>

                @foreach($subjects as $subject)
                    <?php
                    ?>
                    <tr class="tabular">
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->label  }}</td>
                        <td>{{ $subject->inc_type  }}</td>
                        <td>{{ $subject->amount  }}</td>
                        <td>
                            <a class="btn btn-info btn-xs" onclick="" href="{{ URL::to("settings/add/subject?id=$subject->id") }}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="{{ URL::to("settings/delete/subject/$subject->id") }}"><i class="fa fa-remove"></i> Delete</a>
                        </td>
                    </tr>
                    <div class="row"></div>
                    <div class="well well-lg col-md-12 gridular" style="padding-top: 10px;padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-sm-7"><strong>ID: </strong>{{ $subject->id  }}</div>
                            <div class="dropdown pull-right">
                                <a class="btn btn-info btn-xs" onclick="" href="{{ URL::to("settings/add/subject?id=$subject->id") }}"><i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" href="{{ URL::to("settings/delete/subject/$subject->id") }}"><i class="fa fa-remove"></i> Delete</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Label: </strong>{{ $subject->label  }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><strong>Inc. Type: </strong>{{ $subject->inc_type }}</div>
                            <div class="col-sm-2"><strong>Amount: </strong>{{ $subject->amount }}</div>
                        </div>

                    </div>
                @endforeach
            </table>
            {{ $subjects->links() }}
        </div>
    </div>
    </div>
@endsection
