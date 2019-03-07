@extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <?php
    $get_data = Request:: all();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Project Details</div>
        </div>
        <div class="panel-body">
            {{--<div style="margin: 0px !important;" class="col-md-3 pull-right row">--}}
            {{--<img style="pading: 0px;margin: 0px;" src="http://www.homeworkmake.com/wp-content/uploads/2016/07/banner-6.png">--}}
            {{--</div>--}}
            <div style="margin: 0px !important;" class="col-md-13">
                <form method="post" action="{{ URL::to('/stud/new') }}" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="preview" value="1">
                    <div class="form-group">
                        <label class="control-label col-md-3">Topic</label>
                        <div class="col-md-8">
                            <input placeholder="Project Title" value="" type="text" name="topic" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Field</label>
                        <div class="col-md-8">
                            <select onchange="setDocument();" name="subject_id" class="form-control">
                                @foreach($subjects as $subject)
                                    <option {{ @$get_data['subject_id']==$subject->id ? "selected":"" }} value="{{ $subject->id }}">{{ $subject->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" partial="1">
                    <div class="form-group">
                        <label class="control-label col-md-3">Project Type</label>
                        <div class="col-md-8">
                            <select required onchange="" name="document_id" class="form-control">
                                @foreach($documents as $document)
                                    <option {{ @$get_data['document_id']==$document->id ? "selected":"" }} value="{{ $document->id }}">{{ $document->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Date Due</label>
                        <div class="col-md-8">
                            <input type="text" name="deadline" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Instructions</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="instructions"></textarea>
                        </div>
                    </div>

                    <div class="form-group" style="">
                        <label class="control-label col-md-3">&nbsp</label>
                        <div class="col-md-8">
                            <p>*Project files will be uploaded in the order page</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">&nbsp;</label>
                        <div class="col-md-8">
                            <a class="btn btn-warning" href="{{ URL::to('/order') }}"><i class="fa fa-times"></i> Cancel</a>&nbsp;
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Preview</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
//        tinymce.init({
//            selector: 'textarea',
//            height: 500,
//            theme: 'modern',
//            plugins: [
//                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
//                'searchreplace wordcount visualblocks visualchars code fullscreen',
//                'insertdatetime media nonbreaking save table contextmenu directionality',
//                'emoticons template paste textcolor colorpicker textpattern imagetools'
//            ],
//            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
//            toolbar2: 'print preview media | forecolor backcolor emoticons',
//            image_advtab: true,
//            templates: [
//                { title: 'Test template 1', content: 'Test 1' },
//                { title: 'Test template 2', content: 'Test 2' }
//            ],
//            content_css: [
//                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
//                '//www.tinymce.com/css/codepen.min.css'
//            ]
//        });
        setDocument();
        function setDocument(){
            var documents = <?php echo $documents ?>;
            var subject_id =  $("select[name='subject_id']").val();
            $("select[name='document_id']").text('');
            $("select[name='document_id']").append('<option value="">Select ... </option>');
            for(var i=0;i<documents.length;i++){
                var document = documents[i];
                if(document.subject_id == subject_id){
                    $("select[name='document_id']").append('<option value="'+document.id+'">'+document.label+'</option>');
                }
            }
        }
</script>
    <style type="text/css">
        .form-group{
            margin-right:0px !important;
            padding-right: 0px !important;
        }
    </style>
@endsection