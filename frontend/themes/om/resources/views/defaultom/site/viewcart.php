<div class="cart-set-row" style="height: 45px;">
    <div class="cart-set-num" style="line-height: 20px">Номер корзины</div>
    <div class="cart-set-share">Доступна другим</div>
    <div class="cart-set-info" style="text-align: center; margin-top: 10px;">Комментарий к корзине</div>
    <div class="cart-set-control" style="margin-top: 2px">Управление корзиной</div>
</div>
<?php
foreach ($cart as $k=>$v) {
    ?>
    <div class="cart-set-row" data-row="<?=$k?>" data-id="<?=$v->id?>">
        <div class="cart-set-lable">
            <div class="cart-set-num"><?=$v->id?></div>
            <div class="cart-set-share">
                <?php
                if($v->sharing==1){
                    echo '<i class="checkbox-overlay fa fa-check share-set" data-id="'.$v->id.'" style="margin-top:25px;margin-left:40%"></i>';
                }else{
                    echo '<i class="checkbox-overlay fa fa-check chk-unchecked share-set" data-id="'.$v->id.'" style="margin-top:25px;margin-left:40%"></i>';
                }
                ?>
            </div>
            <div class="cart-set-info"><?=$v->comment?></div>
            <div class="cart-set-control">
                <i title="Удалить корзину" class="checkbox-overlay fa fa-times del-cart-set"  data-id="<?=$v->id?>" style="background-color:transparent;color:#ea516d;border-color: #cccccc;"></i>
                <i title="Редактировать корзину" class="checkbox-overlay fa fa-pencil" style="background-color:transparent;color:#007BC1;border-color: #cccccc;"></i>
                <i title="Посмотреть корзину" data-row="<?=$k?>" class="checkbox-overlay fa fa-arrow-down open-set" style="background-color:transparent;color:#00A5A1;border-color: #cccccc;"></i>
            </div>
        </div>
        <div class="cart-set-content" data-row="cont<?=$k?>" style="">

        </div>
    </div>
<?php
}
?>