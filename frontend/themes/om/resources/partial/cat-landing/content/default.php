<div class="o-container col-95">

    <div id="lend_products">
        <div class="row-e">
            <div class="col-1">
                <!--                <div id="owl_lend_products_product-card" class="owl-carousel owl-theme">-->
                <?php foreach ($content_list_products as $value) : ?>
                    <!--                        <div class="item">-->
                    <?php
                    $spec = $value['productsSpecification']['74']['specification_values_id'];
                    $spec_code = $value['specificationValuesDescription'][$spec]['specification_value'];
                    ?>
                    <?= \frontend\widgets\ProductCard::widget([
                        'product'     => $value['products'],
                        'description' => $value['productsDescription'],
                        'attrib'      => $value['productsAttributes'],
                        'attr_descr'  => $value['productsAttributesDescr'],
                        'showdiscount'=> true,
                        'season'=>$spec_code,
                        'subpreview'=>$value['subImage'],
                        'catpath'=>$catpath,
                        'man_time'=>$man_time
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
<div id="modal-product" style="min-height: 300px; top: 297px; margin:auto; left:0; right:0">
    <span id="modal-close"><i class="fa fa-times"></i></span>
</div>
<div id="overlay"></div>
