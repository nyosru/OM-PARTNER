<?php
use yii\helpers\Html;
?>
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
    <div class="pull-left" style="margin-bottom: 5px;margin-top: -4px;">
        <div class="custom pull-left">
            <button id="del-count" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
            <?=Html::textInput('','',['data'=>$sizes['sizes']['data_attr'], 'class'=>'input-text qty','id'=>'input-count','placeholder'=>0])?>
            <button id="add-count" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
        </div>
    </div>
<?php } ?>