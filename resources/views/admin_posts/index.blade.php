 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{!! \Session::get('success') !!}</strong>
    </div>
@endif


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">All Post  <a class="btn btn-success pull-right" href="{{ URL::to("posts/add") }}" style="margin:-6px">Add New Post </a></div>

        </div>
        <div class="panel-body">
            <table class="table table-stripped" >
                <tr>
                    <th>Page Url</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date & Time</th>
                    <th>Aciton</th>
                </tr>
                @foreach($posts as $post)
                   <tr>
                        <td style="width: 267px;">{{ $post->page_name }}</td>
                        <td style="width: 267px;">{{ $post->title }}</td>
                        <td style="width: 267px;">{{ $post->description }}</td>
                        <td style="width: 267px;">{{ $post->createdOn}}</td>
                        <td style="width: 300px;">
                         <span><a class="btn btn-info" target="_blank" href="{{ URL::to("$post->page_name") }}" >View</a></span>
                         <a class="btn btn-info" href="{{ URL::to("posts/view/$post->id") }}">Edit</a>
                        
                         <!--  <span><a class="btn btn-info" href="{{ URL::to("posts/view/$post->id") }}">Delete</a></span>
 -->
 <a href="{{'#'}}" class="delete-mdoal btn btn-danger" data-value='{{ URL::to("posts/delete/$post->id") }}' data-toggle="modal" data-target="#myModal">Delete</a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $posts->links() }}
        </div>
    </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                </div>
                <form method="post">
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 5px;">Cancel</a>
                    <a id="delete" href="" class="btn btn-primary" name="delete_dividend" value="">Delete</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(document).ready(function (e) {
    $(document).on("click", ".delete-mdoal", function (e) {
        var delete_id = $(this).attr('data-value');
        $('#delete').attr("href", delete_id)
    });
});

</script>
@endsection


