<?php
use yii\helpers\Url;

$link = Url::to(['/news','id'=>$model->id]);
?>
<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
    <div class="blog_inner">
        <div class="blog-img"> <img src="/images/new/blog-img1.jpg" alt="">
            <div class="mask">
                <a class="info" href="<?=$link?>">Читать полностью</a>
            </div>
        </div>
        <h3><a href="<?=$link?>"><?=$model->name;?></a></h3>
        <div class="post-date">
            <i class="icon-calendar"></i>
            <?=date('Y-m-d', strtotime($model->date_modified))?>
        </div>
        <p><?=mb_substr(strip_tags($model->post),0,145,'UTF-8')?>...</p>
        <a class="readmore" href="<?=$link?>">Читать полностью</a>
    </div>
</div>