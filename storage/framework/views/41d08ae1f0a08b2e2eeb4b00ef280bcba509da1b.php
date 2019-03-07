    <div class="row"></div>
<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><?php echo e($article->title); ?></div>
            </div>
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Published To
                    </div>
                    <div class="panel-body"></div>
                    <div class="col-md-13">
                        <a class="btn btn-success " data-toggle="modal" href="#publish_modal"><i class="fa fa-thumbs-up"></i> Publish</a>
                        <a class="btn btn-info" href="<?php echo e(URL::to("order/article/$article->id/edit")); ?>"><i class="fa fa-edit"></i> Edit</a>
                        <a class="btn btn-primary" onclick="return checkSimilarity();" href="#"><i class="fa fa-percent"></i> Check Similarity</a>
                    </div>
                          <div class="row"></div>
                            <ol>
                                <?php foreach($article->publishes as $publish): ?>
                                    <li><a href="<?php echo e($publish->link); ?>?visitor=no" target="_blank"><?php echo e($publish->link); ?> <i class="fa fa-external-link"></i> </a></li>
                                <?php endforeach; ?>

                            </ol>

               </div>
                <?php echo $article->content; ?>

            </div>
        </div>
    </div>
   
    <?php if($article->isApproved()): ?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"> Hits/Analytics</div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Link</th>
                        <th>IP</th>
                        <th>Country</th>
                        <th>Date</th>
                        <th>Points</th>
                    </tr>
                    <?php foreach($stats = $article->statistics()->orderBy('id','desc')->paginate(10) as $stat): ?>
                        <?php
                            $date = \Carbon\Carbon::createFromTimestamp(strtotime($stat->created_at));
                                ?>
                        <tr>
                            <td><?php echo e($stat->id); ?></td>
                            <td><?php echo e($stat->getLink()); ?></td>
                            <td><?php echo e($stat->ip_address); ?></td>
                            <td><?php echo e($stat->country); ?></td>
                            <td><?php echo e($date->diffForHumans()); ?></td>
                            <td><?php echo e($stat->points); ?></td>
                        </tr>
                        <?php endforeach; ?>
                </table>
                <?php echo e($stats->links()); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row"></div>
    <div class="modal fade" role="dialog" id="publish_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Publish Article<button class="btn btn-danger pull-right" data-dismiss="modal">&times; </button> </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal ajax-post" method="post" action="<?php echo e(URL::to("order/articles/$article->id")); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="control-label col-md-4">Blog(s)</label>
                            <div class="col-md-6">
                                <?php foreach(\App\PostWebsite::get() as $wb): ?>
                                    <input type="checkbox" name="websites[]" value="<?php echo e($wb->id); ?>"> <?php echo e($wb->name); ?><br/>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Order Link</label>
                            <div class="col-md-6">
                                <select name="link" class="form-control">
                                    <option value="http://intel-writers.com">intel-writers.com</option>
                                    <option value="http://intel-writers.us">intel-writers.us</option>
                                    <option value="http://myacademic-support.com/">myacademic-support.com</option>
                                </select>
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
    <div class="modal fade" role="dialog" id="similarity_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title"> Article Similarity <a class="btn btn-danger pull-right" data-dismiss="modal">&times;</a> </div>
                </div>
                <div id="similar_modal_body" class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function checkSimilarity(){
            $("#similarity_modal").modal('show');
            $("#similar_modal_body").html('<div class="alert alert-success"><img style="" class="loading_img" src="<?php echo e(URL::to("img/ajax-loader.gif")); ?>"></div>')
            var url = '<?php echo e(URL::to("order/articles/$article->id/similarity")); ?>';
            $.get(url,null,function(response){
                $("#similar_modal_body").html(response);
            });
            return false;
        }
    </script>
