 
<?php $__env->startSection('content'); ?>
<?php if(\Session::has('success')): ?>
    <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong><?php echo \Session::get('success'); ?></strong>
    </div>
<?php endif; ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e('Edit post'); ?></div>
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                <?php echo e(csrf_field()); ?>


<?php $split = explode("/", $posts[0]->page_name);
echo $split[0];?>
                  <div class="form-group">
                    <label class="control-label col-md-3">Page Url first Segment</label>
                    <div class="col-md-8">
                             <select name="first_url_segment" class="form-control">
                <option value="0">Home</option>
                <option value="essay-writer"  <?php if($split[0]=='essay-writer') echo "selected" ?>>essay-writer</option>
                <option value="case-study" <?php if($split[0]=='case-study') echo "selected" ?>>case-study</option>
                <option value="dissertation"  <?php if($split[0]=='dissertation') echo "selected" ?>>dissertation</option>
                <option value="homework"<?php if($split[0]=='homework') echo "selected" ?>>homework</option>
                <option value="coursework"<?php if($split[0]=='coursework') echo "selected" ?>>coursework</option>
            <option value="research-papers"<?php if($split[0]=='research-papers') echo "selected" ?>>research-papers</option>
                <option value="thesis"<?php if($split[0]=='thesis') echo "selected" ?>>thesis</option>
                <option value="us"<?php if($split[0]=='us') echo "selected" ?>>us</option>


                </select>
                    </div>
                </div>
                 
                           <div class="form-group">
                    <label class="control-label col-md-3">Page current Url Segment</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="<?php echo e($posts[0]->page_name); ?>" name="" class="form-control" autocomplete="off" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Page Url second Segment</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="<?php $split = explode("/", $posts[0]->page_name);
echo $split[count($split)-1];?>" name="page_name" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Title</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="<?php echo e($posts[0]->title); ?>" name="title" class="form-control" autocomplete="off">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-3">Description</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="<?php echo e($posts[0]->description); ?>" name="description" class="form-control" autocomplete="off">
                    </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Main Heading</label>
                    <div class="col-md-8">
                        <input type="text" required="" value="<?php echo e($posts[0]->main_heading); ?>" name="main_heading" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                     <label class="control-label col-md-3">Main Content</label>
                    <div class="col-md-8">
                        <textarea name="main_content" cols="15" rows="10" class="form-control"><?php echo e($posts[0]->main_content); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                     <label class="control-label col-md-3"></label>
                    <div class="col-md-8">
                       <input type="checkbox" value="1" id="myCheck" name="order_custom_section" <?php if($posts[0]->order_custom_section=='1') echo "checked" ?>><span>Show order custom Section</span>
                    </div>
                </div>
                
                    <div class="form-group">
                     <label class="control-label col-md-3">Secondry Content</label>
                    <div class="col-md-8">
                        <textarea name="second_content" cols="15" rows="10" class="form-control"><?php echo e($posts[0]->second_content); ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                     <label class="control-label col-md-3"></label>
                    <div class="col-md-8">
                       <input class="field"type="checkbox" value="1" id="myCheck" name="confidentiality_authenticity_section"  <?php if($posts[0]->confidentiality_authenticity_section=='1') echo "checked" ?>><span>Show Confidentiality & Authenticity Guaranteed!</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-lg"><i class=""></i> Update</button>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make(@Auth::user()->role=='admin' ? 'layouts.gentella':'layouts.'.env('LAYOUT'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>