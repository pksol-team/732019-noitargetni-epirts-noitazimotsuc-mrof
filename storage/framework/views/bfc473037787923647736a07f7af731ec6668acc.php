 
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e('Create Announcement for '.ucwords($role)); ?></div>
        <div class="panel-body">
            <form class="form-horizontal" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <div class="col-md-8">
                        <textarea name="message" cols="15" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">&nbsp;</label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-bullhorn"></i> Announce</button>
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