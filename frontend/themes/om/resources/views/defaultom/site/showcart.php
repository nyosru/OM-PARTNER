<form method="get" style="margin-bottom:30px;">
    <input type="number" class="no-shadow-form-control" name="cart" placeholder="Введите номер набора" style="width: 40%; min-width: 300px; float: left;"/>
    <input type="submit" class="btn btn-primary">
</form>

<?php
if(isset($success)){
    if($success==0){
        echo '<div>Корзины с таким номером не обнаружено, попробуйте ввести другой</div>';
    }elseif($success==1){
        $body=unserialize($cart->cart_body);
        $cartset=[];
        $carset[]=$body;
        echo '<script>$body='.$body.'</script>';
        ?>
        <div class="cart-set-row" data-row="0" data-id="<?=$cart->id?>">
            <div class="cart-set-lable">
                <div class="cart-set-num" style="font-size:24px; width: 250px; line-height: 3;">Корзина № <?=$cart->id?></div>
                <div class="cart-set-info" style="font-size: 18px;"><?=$cart->comment?></div>
                <div class="cart-set-control">
                    <i title="Добавить товары в текущую корзину" data-row="0" class="checkbox-overlay fa fa-cart-arrow-down add-cart-set" style="background-color:transparent;color:#007BC1;border-color: #cccccc;"></i>
                    <i title="Посмотреть корзину" data-row="0" class="checkbox-overlay fa fa-arrow-down open-set" style="background-color:transparent;color:#00A5A1;border-color: #cccccc; display: none"></i>
                </div>
            </div>
            <div class="cart-set-content" data-row="0" style="">
                <?=$body?>
            </div>
        </div>
<?php
    }
}
?>
<script>
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
    $(document).on('ready', function () {
        $('.open-set').trigger('click');
    })
</script>

