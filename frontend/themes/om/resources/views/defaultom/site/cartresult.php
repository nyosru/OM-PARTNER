<?php
$this -> title = 'Обработка заказа';

if($result['code'] == 200 && $result['data']['paramorder']['number']){

	?>

	<style>
		.order-info {
			margin: 10px 0;
			padding: 10px;
		}

		.order-number {
			border-bottom: 1px solid rgb(204, 204, 204);
			border-top: 1px solid rgb(204, 204, 204);
			font-size: 24px;
			font-weight: 400;
			margin: 0 10px;
			padding: 10px 0;
		}

		.accent {
			color: #007BC1;
		}

		h3 {
			font-size: 24px;
			font-weight: 400;
			padding: 10px 0;
		}

		.desc-attr {
			padding: 5px 10px;
		}

		.desc-attr .key {
			display: block;
			float: left;
			font-weight: 400;
			width: 20%;
		}

		table.products {
			border: 1px solid #ccc;
			width: 100%;
		}

		table.products tr {
			border-bottom: 1px solid #ccc;
		}

		table.products tr.success-product td,
		table.products tr.fail-product td {
			padding: 10px 0;
		}

		table.products tr.success-product {
			background-color: #DBF5E0;
		}

		table.products tr.fail-product {
			background-color: #FDE8E8;
		}

		table.products tr:last-child {
			border-bottom: 0;
		}

		table.products td:first-child {
			text-align: center;
			width: 25%;
		}

		table.products td p {
			margin: 0;
		}
	</style>

	<div class="code<?=$result['code']?>"><?=$result['text']?></div>
	<div>
		Ваш заказ <span class="accent">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </span>подтвержден автоматически.<br>
		В ближайшее время Вы получите уведомление на электронную почту.<br>
		Отслеживать состояние заказа можно в Вашем <span class="accent"><a href="<?=BASEURL?>/lk/">личном кабинете</a></span><br>
	</div>
	<div class="order-number">
		Номер заказа <span class="accent"><?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></span>
	</div>
	<?php
	$pack['packages']=['name'=>'Полиэтиленовые пакеты', 'price'=>'0'];
	$pack['boxes']=['name'=>'Крафт-коробки', 'price'=>$wrapprice];
	if($result['data']['paramorder']['delivery']) {
		echo '<div class="desc-attr"><span class="key">Вариант упаковки: </span>'.$pack[$result['data']['paramorder']['wrap']]['name'].'</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Вариант доставки: </span>'.$result['data']['paramorder']['delivery'].'</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Итого: </span>'.((float)$result['data']['totalpricesaveproduct']-(float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Упаковка: </span>'.((float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Всего к оплате: </span>'.((float)$result['data']['totalpricesaveproduct']).' Руб.</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">ФИО: </span>'.$result['data']['paramorder']['name'].'</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Телефон: </span>'.$result['data']['paramorder']['telephone'].'</div>';
	}
	if($result['data']['totalpricesaveproduct']) {
		echo '<div class="desc-attr"><span class="key">Емейл: </span>'.$result['data']['paramorder']['email'].'</div>';
	}
	if($result['code']==200) {
		echo '<div style="padding: 10px; margin: 10px 0;">'.
			'Заказанные товары будут Вам отправлены сразу же после проверки и поступления средств от Вас на расчетный счет Одежда-Мастер. <span>Счет будет Вам выслан</span> на указанный адрес электронной почты, а также Вы сможете скачать его в <a href="'.BASEURL.'/lk">личном кабинете</a>'.
			'</br>'.
			'<div class="code'.$result['code'].'" style="padding: 10px;">'.
			'Благодарим вас за покупку!'.
			'</div>'.
			'</div>';
	}
	?>
	<div style="width: 50%;">
		<?php

		if($result['data']['saveproduct']) {
			?>
			<h3>Товары в Вашем заказе:</h3>
			<table class="products"><tbody>
					<?php foreach ($result['data']['saveproduct'] as $key => $value) : ?>
						<tr class="success-product">
							<td colspan="2">Товар доступен</td>
						</tr>
						<tr>
							<td><img width="100" src="<?php echo BASEURL .'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_id']; ?>" /></td>
							<td>
								<p>Код товара: <?php echo $value[0]['products_model']; ?></p>
								<p><?php echo $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name']; ?></p>
								<p>Размер: <?php echo $value[1]['products_options_values']; ?></p>
								<p>Количество: <?php echo $value[0]['products_quantity']; ?> шт.</p>
								<p>Цена: <?php echo round($value[0]['products_price'], 2); ?>Руб.</p>

								<script>
									ga("ec:addProduct", {
										"id": "<?=$value[0]['products_id'];?>",
										"name": "<?=htmlentities($result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name']);?>",
										"category": "<?=htmlentities($result['data']['origprod'][$value[0]['products_id']]['categories_id']);?>",
										"brand": "<?=htmlentities($result['data']['origprod'][$value[0]['products_id']]['manufacturers_id']);?>",
										"variant": "none",
										"price": "<?=round($value[0]['products_price'], 2);?>",
										"coupon": "none",
										"quantity": <?=$value[0]['products_quantity'];?>});
								</script>
							</td>
						</tr>

						<?php
						$delproductattr[$value[0]['products_id']][$value[1]['products_options_values']]= true;
					endforeach;?>
				</tbody></table>

			<?php echo ' 
    <script>
    
   $(window).load(function(){
    ga("ec:setAction", "purchase", {
  "id": "'.$result['data']['paramorder']['number'].'",     
  "affiliation": "NewOM",
  "revenue": "'.$result['data']['totalpricesaveproduct'].'",                 
  "tax": "0",                        
  "shipping": "0",                    
  "coupon": "none"            
});
  ga("send", "event", "purchase");
   });
</script>';
		}
		?>
		<script>
			$(function(){
				$productattr = <?= json_encode($delproductattr)?>;
				$cart = JSON.parse(localStorage.getItem('cart-om')).cart;
				$itemcart = new Object()
				$itemcart.cart = [];
				$.each($cart, function(i, item){
					if(item['6'] != '' && $productattr[item['0']]){
					}else if($productattr[item['0']] && (item['6'] == '' || item['6'] == 'undefined')){
					}else{
						$itemcart.cart.push($cart[i]);
					}
				});
				if($itemcart.cart.length > 0 ){
					$ilocal = JSON.stringify($itemcart);
					localStorage.setItem('cart-om', $ilocal);
					alert('В вашей корзине остались товары которые сейчас недоступны к заказу.');
				}else{
					localStorage.removeItem('cart-om');
					localStorage.removeItem('cart-om-date');
				}
				$('.preload').remove();
			});
		</script>
	</div>

	<?php
}elseif($result['code'] == 0 ){
	?>
	<div style="float:left; width:100%">
		<?php
		echo '<pre>';
		print_r($result['text']);
		echo '</pre>';
		?>
	</div>
	<?php
}
?>