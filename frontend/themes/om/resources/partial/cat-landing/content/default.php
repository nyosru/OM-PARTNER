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

    <div class="cat-info-about-us">
        <div class="cat-info-about-us_b_h3">
            <h3>С нами работают и зарабатывают более 34464 клиентов по всей России и СНГ</h3>
        </div>
        <div class="cat-info-about-us_btn">
            <div class="cat-info-about-us_btn__btn">
                <span>Подробные условия работы и частные вопросы</span>
            </div>
        </div>
    </div>


<!--    <div class="cat_customer_reviews">-->
<!--        <div class="row-e">-->
<!--            <div class="col-1-2">-->
<!--                123-->
<!--            </div>-->
<!--            <div class="col-1-2">-->
<!--                123-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row-e">-->
<!--            <div class="col-1-2">-->
<!--                123-->
<!--            </div>-->
<!--            <div class="col-1-2">-->
<!--                123-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

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