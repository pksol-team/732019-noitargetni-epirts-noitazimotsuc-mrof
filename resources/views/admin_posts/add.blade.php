 @extends(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'))
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ 'Create post'}} <a class="btn btn-success pull-right" href="{{ URL::to("posts") }}" style="margin:-6px">All post </a></div>
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                {{ csrf_field() }}


                 <div class="form-group">
                    <label class="control-label col-md-3">Page Url first Segment</label>
                    <div class="col-md-8">
                             <select name="first_url_segment" class="form-control">
                <option value="0">Home</option>
                <option value="essay-writer">essay-writer</option>
                <option value="case-study">case-study</option>
                <option value="dissertation">dissertation</option>
                <option value="homework">homework</option>
                <option value="coursework">coursework</option>
                <option value="research-papers">research-papers</option>
                <option value="thesis">thesis</option>
                <option value="us">us</option>
                </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Page Url second Segment</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="" name="page_name" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Title</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="" name="title" class="form-control" autocomplete="off">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="" name="description" class="form-control" autocomplete="off">
                    </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Main Heading</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="" name="main_heading" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                     <label class="control-label col-md-3">Main Content</label>
                    <div class="col-md-8">
                        <textarea name="main_content" cols="15" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                
                  <div class="form-group">
                     <label class="control-label col-md-3"></label>
                    <div class="col-md-8">
                       <input type="checkbox" value="1" id="myCheck" name="order_custom_section" ><span>Show order custom Section</span>
                    </div>
                </div>
                    <div class="form-group">
                     <label class="control-label col-md-3">Secondry Content</label>
                    <div class="col-md-8">
                        <textarea name="second_content" cols="15" rows="10" class="form-control"></textarea>
                    </div>
                </div>

                  <div class="form-group">
                     <label class="control-label col-md-3"></label>
                    <div class="col-md-8">
                       <input class="field"type="checkbox" value="1" id="myCheck" name="confidentiality_authenticity_section"><span>Show Confidentiality & Authenticity Guaranteed!</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-lg"><i class=""></i> Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            height: 300,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
@endsection