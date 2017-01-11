<?php
//echo '<pre>';
//print_r($pagination);
//echo '<pre>';
//die();
use frontend\widgets\ProductCardFabia;
use yii\widgets\LinkPager;
$this->title=$title;

?>
<div class="container">
    <div class="row" style="margin: 15px 0;">
        <?=$this->render('_navlk',['user'=>$cust])?>
        <div class="col-sm-9">
            <?php //LinkPager::widget(['pagination' => $pagination]); ?>
            <ul class="products-<?=(int)$_COOKIE['cardview'] == 1?'list':'grid'?>" style="margin-top: -30px;">
                <?php
                foreach ($orderedproducts as $val) {
                    if((int)$_COOKIE['cardview'] == 1){
                        echo '<li class="item even">';
                    } else {
                        echo '<li class="item col-md-4 col-xs-6">';
                    }
                    echo ProductCardFabia::widget([
                        'template' => (int)$_COOKIE['cardview'] == 1 ? 'list' : 'grid',
                        'product' => $val,
                        'description' => $val->productsDescription,
                        'attrib' => $val->productsAttributes,
                        'attr_descr' => $val->productsAttributesDescr,
                        'catpath' => $catpath,
                        'category' => $value['categories_id'],
                        'man_time' => $man_time,
                        'showdiscount' => 1,
                    ]);
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>