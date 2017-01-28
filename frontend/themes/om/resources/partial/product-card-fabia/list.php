<?php
use yii\bootstrap\Html;
?>
    <div class="product-image">
        <a href="product_detail.html" title="<?=$name?>">
            <div style="display: block;width: 100%;height: <?=$css['imageHeight']?>;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
        </a>
    </div>
    <div class="product-shop catalog-product-item">
        <h2 class="product-name"><a href="<?=$product_link?>" title="<?=$name?>"><?=$name?></a></h2>
        <div class="desc std"><?=Html::encode($description['products_description'])?></div>
        <?=$this->render('_price',[
            'price' => $product['products_price'],
            'old_price' => $product['products_old_price'],
        ])?>
        <div class="product-variants">
            <?php if($sizes['isset_variants']) {?>
                <label>Размеры</label>
                <div class="row add-to-cart-inputs">
                    <?php foreach($sizes['sizes'] as $item){ ?>
                        <div class="col-lg-6">
                            <div class="label-product"><?=$item['label']?></div>
                            <div class="custom">
                                <button id="del-count" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                                <?=Html::textInput('','',['data'=>$item['data_attr'], 'class'=>'input-text qty','id'=>'input-count','placeholder'=>0])?>
                                <button id="add-count" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="pull-left" style="margin-right: 10px;">
                    <div class="custom pull-left">
                        <button id="del-count" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                        <?=Html::textInput('','',['data'=>$sizes['sizes']['data_attr'], 'class'=>'input-text qty','id'=>'input-count','placeholder'=>0])?>
                        <button id="add-count" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="actions">
            <button class="button btn-cart ajx-cart" title="В корзину" type="button"><span>В корзину</span></button>
            <span class="add-to-links">
                <?php if($favorites){ ?>
                    <a class="btn del-products" title="Удалить" data-product="<?=$product['products_id']?>" href="#" style="color: #ffffff;border-color: #ffffff;"><span>Удалить</span></a>
                <?php } else { ?>
                    <a title="В избранное" class="button link-wishlist selected-product" data-product="<?=$product['products_id']?>" href="#"><span>В избранное</span></a>
                <?php } ?>
            </span>
        </div>
    </div>
