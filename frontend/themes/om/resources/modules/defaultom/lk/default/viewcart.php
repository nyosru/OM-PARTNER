<?php
$this->title='Просмотр сохраненных корзин';
$modalsaveset='<div style="height:40px;background-color: #E1F5E1;text-align: center;font-size: 24px;line-height: 1.7;">Сохранение корзины<div style="width:30px;float: right"><i style="cursor:pointer; color:#ea516d;" id="close-cart-save" class="fa fa-times" aria-hidden="true"></i></div></div><div><div style="width:90%;margin-left: 5%; height:40px;line-height:4;">Введите комментарий для сохраняемой корзины:</div><input id="comment-cart-save" class="no-shadow-form-control" style="width:90%; margin-left:5%;"></div><div style="width:90%; margin-left:5%; line-height: 4; height: 40px;">Сделать корзину публичной (вы сможете давать ссылки на нее другим)<i class="checkbox-overlay fa fa-check chk-unchecked" id="save-chk" style="margin-top:15px;margin-right:15px;"></i></div><div id="save-set-btn">Сохранить</div>';
?>
<script>
    $cartset=[];
</script>
<div style="margin-left: 15px"><div id="modal-save-set" style="display:none"><?=$modalsaveset?></div><div id="save-set" style="float: right;">Сохранить текущую корзину</div><form method="get" action="<?=BASEURL?>/showcart" style="margin-bottom:30px;">
        <input type="number" class="no-shadow-form-control" name="cart" min="0" placeholder="Введите номер корзины для просмотра" style="width: 40%; min-width: 300px; float: left;"/>
        <input type="submit" class="btn btn-primary">
    </form></div>
<div class="cart-set-row" style="height: 45px;">
    <div class="cart-set-num" style="line-height: 20px">Номер корзины</div>
    <div class="cart-set-share">Доступна другим</div>
    <div class="cart-set-info" style="text-align: center; margin-top: 10px;">Комментарий к корзине</div>
    <div class="cart-set-info" style="text-align: center; margin-top: 10px;float: left;width: 20%;">Ссылка на корзину</div>
    <div class="cart-set-control" style="margin-top: 2px">Управление корзиной</div>
</div>
<?php
foreach ($cart as $k=>$v) {
    $body=unserialize($v->cart_body);
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
            <div class="cart-set-link" style="float: left;width: 25%;margin-top: 20px;"><input style="width: 95%;" class="no-shadow-form-control" type="text" value="http://<?=$_SERVER['HTTP_HOST']?>/showcart?cart=<?=$v->id?>"></div>
            <div class="cart-set-control">
                <i title="Удалить корзину" class="checkbox-overlay fa fa-times del-cart-set" data-row="<?=$k?>"  data-id="<?=$v->id?>" style="background-color:transparent;color:#ea516d;border-color: #cccccc;"></i>
                <i title="Добавить товары в текущую корзину" data-row="<?=$k?>" class="checkbox-overlay fa fa-cart-arrow-down add-cart-set" style="background-color:transparent;color:#007BC1;border-color: #cccccc;"></i>
                <i title="Посмотреть корзину" data-row="<?=$k?>" class="checkbox-overlay fa fa-arrow-down open-set" style="background-color:transparent;color:#00A5A1;border-color: #cccccc;"></i>
            </div>
        </div>
        <div class="cart-set-content" data-row="<?=$k?>" style="">
            <?=$body?>
        </div>
    </div>
    <script>
        $cartset[<?=$k?>]=<?=$body?>;
    </script>
<?php
}
?>
<script>
    function saveCartSet($cartset){
        $cartset=JSON.stringify($cartset);
        if (JSON.parse(localStorage.getItem('cart-set'))) {
            localStorage.removeItem('cart-set')
            localStorage.setItem('cart-set', $cartset);
        }else{
            localStorage.setItem('cart-set', $cartset);
        }
    }
    saveCartSet($cartset);

    function fixCart($obj){
        $.each($obj.cart,function($k,$v){
            $.each($obj.cart,function ($i,$item) {
                if($k<$i){
                    if($item&&$v) {
                        if ($v[0] == $item[0] && $v[2] == $item[2]) {
                            $obj.cart[$k][4] = parseInt($obj.cart[$i][4]) + parseInt($obj.cart[$k][4]);
                            delete $obj.cart[$i];
                        }

                    }
                }
            })
        });
        $.each($obj.cart,function($k,$v){
            if($v==null) $obj.cart.splice($k);
        })
        return $obj;
    }

    function addSetToCart($row){
        $count=parseInt($('.cart-count')[0].innerHTML);
        $count2=0;
        if(JSON.parse(localStorage.getItem('cart-om'))) {
            $cart = JSON.parse(localStorage.getItem('cart-om'));
            $set = JSON.parse(localStorage.getItem('cart-set'));
            $set = $set[$row];
            if($cart!=null) {
                $.each($set.cart, function ($i, $item) {
                    if ($cart.cart.length > 0) {
                        $.each($cart.cart, function ($k, $v) {
//                            if ($item[0] == $v[0] && $item[2] == $v[2]) {
//                                $cart.cart[$k][4] = parseInt($item[4]) + parseInt($cart.cart[$k][4]);
//                                $count2+=parseInt($item[4])
//                            } else {
                                $cart.cart.push($item);
                                $count2+=parseInt($item[4])
//                            }
                            return false;
                        })

                    } else {
                        $cart.cart.push($item);
                        $count2+=parseInt($item[4])
                    }
                })
            }else{
                $cart.cart=[];
                $cart.cart.push($item);
                $count2+=parseInt($item[4])
            }
            $cart=fixCart($cart);
            $cart = JSON.stringify($cart);
            localStorage.removeItem('cart-om');
            localStorage.setItem('cart-om', $cart);
        }else {
            console.log('Отсутствует корзина');
            $set = JSON.parse(localStorage.getItem('cart-set'));
            $.each($set[$row]['cart'],function($i,$item){
                $count++;
            })
            $set = JSON.stringify($set[$row]);
            localStorage.setItem('cart-om', $set);
            console.log('Корзина сохранена');
        }
        $count+=$count2;
        $('.cart-count').html($count);
    }

    $(document).on('click','.add-cart-set',function(){
        $row=$(this).data('row')
        addSetToCart($row);
    })
</script>
