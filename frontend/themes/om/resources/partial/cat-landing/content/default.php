<div class="o-container col-95">

    <div id="lend_products">
        <div class="row-e">
            <div class="col-1 center">
                <!--                <div id="owl_lend_products_product-card" class="owl-carousel owl-theme">-->
                <?php foreach ($content_list_products as $value) : ?>
                    <!--                        <div class="item">-->
                    <?= \frontend\widgets\ProductCard::widget([
                        'product'     => $value,
                        'description' => $value['productsDescription'],
                        'attrib'      => $value['productsAttributes'],
                        'attr_descr'  => $value['productsAttributesDescr'],
                    ]); ?>
                    <!--                        </div>-->
                <?php endforeach; ?>
                <!--                </div>-->
            </div>
        </div>
    </div>
    <div class="row-e">
        <div class="col-1">
            <?= $special_offer ?>
        </div>
    </div>
</div>
<?php
$script = <<< JS

        $("#owl_lend_products_product-card").owlCarousel({
          items : 4 //10 изображений на 1000px 
        });

JS;
$this->registerJs($script, yii\web\View::POS_END);
?>