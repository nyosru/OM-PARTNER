<?php
use yii\helpers\Url;

$this->title='Просмотр сохраненных корзин';
$modalsaveset='<div style="height:40px;background-color: #E1F5E1;text-align: center;font-size: 24px;line-height: 1.7;">Сохранение корзины<div style="width:30px;float: right"><i style="cursor:pointer; color:#ea516d;" id="close-cart-save" class="fa fa-times" aria-hidden="true"></i></div></div><div><div style="width:90%;margin-left: 5%; height:40px;line-height:4;">Введите комментарий для сохраняемой корзины:</div><input id="comment-cart-save" class="no-shadow-form-control" style="width:90%; margin-left:5%;"></div><div style="width:90%; margin-left:5%; line-height: 4; height: 40px;">Сделать корзину публичной (вы сможете давать ссылки на нее другим)<i class="checkbox-overlay fa fa-check chk-unchecked" id="save-chk" style="margin-top:15px;margin-right:15px;"></i></div><div id="save-set-btn">Сохранить</div>';
?>
<style>
    .page-lk .data-table .glyphicon{
        border: 1px solid #eaeaea;
        border-radius: 2px;
        padding: 4px;
        margin: 5px 0;
        cursor: pointer;
        font-size: 12px;
        transition: .5s;
    }
    .page-lk .data-table td,
    .page-lk .data-table th{
        text-align: center;
    }
    .page-lk .data-table .sharing .glyphicon{
        font-size: 18px;
        margin: 0;
    }
    .page-lk .data-table .glyphicon:hover{
        background-color: #08c;
        color: #fff;
    }
    .page-lk .data-table .glyphicon.glyphicon-remove:hover{
        background-color: #ed6663;
        color: #fff;
    }
    #modal-show-cart .panel{
        height: 450px;
        overflow: hidden;
    }
</style>
<script>
    $cartset=[];
</script>
<div class="container page-lk">
    <div class="row" style="margin: 15px 0;">
        <?=$this->render('_navlk',['user'=>$cust])?>
        <div class="col-sm-9">
            <div class="row">
                <div id="modal-save-set" style="display:none"><?=$modalsaveset?></div>
                <div class="col-sm-6">
                    <form method="get" action="<?=BASEURL?>/showcart" style="margin-bottom:10px;">
                        <div class="input-group">
                            <input type="number" class="form-control" name="cart" min="0" placeholder="Введите номер корзины для просмотра"/>
                            <span class="input-group-btn">
                                <button style="line-height: 22px;" type="submit" class="button">Найти</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <button style="line-height: 22px;" class="button pull-right" id="save-set">Сохранить текущую корзину</button>
                </div>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Номер корзины</th>
                        <th>Доступна другим</th>
                        <th>Комментарий к корзине</th>
                        <th>Ссылка на корзину</th>
                        <th>Управление корзиной</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $k=>$v) {
                        $body=unserialize($v->cart_body); ?>
                        <tr data-row="<?=$k?>" data-id="<?=$v->id?>" class="cart-set-row">
                            <td><?=$v->id?></td>
                            <td class="sharing">
                                <?php if($v->sharing==1){ ?>
                                    <span class="glyphicon glyphicon-ok-circle share-set" data-id="<?=$v->id?>"></span>
                                <?php }else{ ?>
                                    <span class="glyphicon glyphicon-remove-circle share-set" data-id="<?=$v->id?>"></span>
                                <?php } ?>
                            </td>
                            <td><?=$v->comment?></td>
                            <td><input class="form-control" style="margin: 0;" type="text" value="<?=Url::to(['/showcart','cart'=>$v->id],true)?>"></td>
                            <td class="action">
                                <span title="Посмотреть корзину" class="glyphicon glyphicon-eye-open open-set" data-row="<?=$k?>" data-toggle="modal" data-target="#modal-show-cart"></span>
                                <span title="Добавить товары в текущую корзину" class="glyphicon glyphicon-shopping-cart add-cart-set" data-row="<?=$k?>"></span>
                                <span title="Удалить корзину" class="glyphicon glyphicon-remove del-cart-set" data-row="<?=$k?>" data-id="<?=$v->id?>"></span>
                                <div class="cart-set-content" data-row="<?=$k?>" style="display: none"><?=$body?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
<div class="modal fade" tabindex="-1" id="modal-show-cart" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Просмотр корзины</h4>
            </div>
            <div class="modal-body">
                <div class="row"></div>
            </div>
        </div>
    </div>
</div>
<script>
    function saveCartSet($cartset){
        $cartset=JSON.stringify($cartset);
        if (JSON.parse(localStorage.getItem('cart-set'))) {
            localStorage.removeItem('cart-set');
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
        });
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
                                $count2+=parseInt($item[4]);
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
        $row=$(this).data('row');
        addSetToCart($row);
    })
</script>
