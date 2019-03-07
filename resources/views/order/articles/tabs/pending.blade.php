
@if($articles)
    <a href="#publish_modal" onclick="publishAll();" class="btn btn-info" data-toggle="modal">Publish All</a>
@endif
<table class="table">
    <tr>
        <th>ID</th>
        <th>Article</th>
        <th>Date Published</th>
        <th>By</th>
        <th>Action</th>
    </tr>
    @foreach($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>
                <a href="{{ URL::to("order/articles/$article->id") }}"><strong>{{ $article->title }}</strong></a>
                <p>{!! strip_tags(substr($article->content,0,150)) !!}...</p>
            </td>
            <td>{{ date('d,M Y H:i',strtotime($article->created_at)) }}</td>
            <td><a href="{{ URL::to("user/view/client")."/".$article->user->id }}">{{ $article->user->name }}</a> </td>
            <td>
                <a onclick="publish({{ $article->id }});" class="btn btn-success " data-toggle="modal" href="#publish_modal"><i class="fa fa-thumbs-up"></i> Publish</a>

                <a class="btn btn-primary btn-sm" href="{{ URL::to("order/articles/$article->id") }}"><i class="fa fa-eye"></i> View</a>
                <a class="btn btn-danger btn-sm" onclick="deleteItem('{{ URL::to("order/article/delete") }}',{{ $article->id }})"><i class="fa fa-times"></i> Delete</a>
            </td>
        </tr>
    @endforeach
</table>
{!! $articles->links() !!}

<div class="modal fade" role="dialog" id="publish_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Publish Article<button class="btn btn-danger pull-right" data-dismiss="modal">&times; </button> </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal ajax-post post_publish" method="post" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-4">Blog(s)</label>
                        <div class="col-md-6">
                            @foreach(\App\PostWebsite::get() as $wb)
                                <input type="checkbox" name="websites[]" value="{{ $wb->id }}"> {{ $wb->name }}<br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Publish Date</label>
                        <div class="col-md-6">
                            <input type="date" name="deadline" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">&nbsp;</label>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function publish(id){
        jQuery(".post_publish").attr('action','{{ url("order/articles") }}/'+id);
    }

    function publishAll(){
        jQuery(".post_publish").attr('action','{{ url("order/articles?tab=pending") }}');
    }
</script>

