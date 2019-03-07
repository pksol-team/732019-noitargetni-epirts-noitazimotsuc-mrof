<table class="table">
    <tr>
        <th>ID</th>
        <th>Article</th>
        <th>On</th>
        <th>Action</th>
    </tr>
    <?php foreach($articles as $article): ?>
        <tr>
            <td><?php echo e($article->id); ?></td>
            <td>
                <a href="<?php echo e(URL::to("stud/article/$article->id")); ?>"><strong><?php echo e($article->title); ?></strong></a>
                <p><?php echo strip_tags(substr($article->content,0,150)); ?>...</p>
            </td>
            <td><?php echo e(date('d,M Y',strtotime($article->created_at))); ?></td>
            <td>
                <a href="<?php echo e(URL::to("stud/article/$article->id")); ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View</a>
                <?php if($article->status != 2): ?>
                <?php endif; ?>
                 <?php if(!$article->isApproved()): ?>
                                 <a onclick="deleteItem('<?php echo e(URL::to("stud/article")); ?>',<?php echo e($article->id); ?>)" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</a>

    
                                            <a href="<?php echo e(URL::to('articles/edit/'.$article->id)); ?>" id="article_edit" name="article_edit"
                                                    class="btn btn-primary btn-xs"><i
                                                        class="fa fa-edit"></i> edit
                                            </a>
    <?php endif; ?>
       <?php if($article->isDraft()): ?>
     <a href="<?php echo e(URL::to('articles/submit/'.$article->id)); ?>" id="article_submit" name="article_submit"
                                                    class="btn btn-success btn-xs" ><i
                                                        class="fa fa-tick"></i> submit
                                            </a>
                <a onclick="deleteItem('<?php echo e(URL::to("stud/article")); ?>',<?php echo e($article->id); ?>)" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</a>

    <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php echo $articles->links(); ?>



