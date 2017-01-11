<div class="special_header">
    <h1>Отобранные товары</h1>
</div>

<div id="lend_products" style="">
    <div class="row-e">
        <div class="col-9-10 center">
            <div id="owl_lend_products_product-card" class="owl-carousel owl-theme">
                <?php foreach ($content_list_products as $value) : ?>
                    <div class="item">
                        <?= \frontend\widgets\ProductCard::widget([
                            'product'     => $value,
                            'description' => $value['productsDescription'],
                            'attrib'      => $value['productsAttributes'],
                            'attr_descr'  => $value['productsAttributesDescr'],
                        ]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="special_header">
        <h1>Специальное предложение на сегодня!</h1>
    </div>

    <div class="row-e" style="box-shadow: 0px 3px 6px -2px rgba(0,0,0,0.75);">
        <div class="col-1-3">
            <div class="img-block">
                <img src="http://remdta.ru/des/specpredlozhenie.png" alt="">
            </div>
        </div>
        <div class="col-2-3">
            <div class="offer-body" style="padding-right: 25px">
                <?= $special_offer ?>
            </div>
        </div>
    </div>

<?php
$script = <<< JS
    $(document).ready(function () {

        $("#owl_lend_products").owlCarousel({
          items : 4, //10 изображений на 1000px 
          itemsDesktop : [1000,4], //5 изображений на ширину между 1000px и 901px
          itemsDesktopSmall : [900,3], // 3 изображения между 900px и 601px
          itemsTablet: [600,2], //2 изображения между 600 и 0;
          itemsMobile : false,
          navigation : true
        });

    });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>