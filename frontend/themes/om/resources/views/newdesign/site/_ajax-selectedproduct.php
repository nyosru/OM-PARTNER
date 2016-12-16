<ul class="products-<?=(int)$_COOKIE['cardview'] == 1?'list':'grid'?>">
    <?php
    foreach ($model as $value) {
        $class = (int)$_COOKIE['cardview'] == 1 ? 'item even':'item col-lg-4 col-md-3 col-sm-4 col-xs-6';

        echo '<li class="'.$class.'" data-product="'.$value['products']["products_id"].'">';
        echo \frontend\widgets\ProductCardFabia::widget([
            'template'=>(int)$_COOKIE['cardview'] == 1?'list':'grid',
            'product'=>$value['products'],
            'description'=>$value['productsDescription'],
            'attrib'=>$value['productsAttributes'],
            'attr_descr'=>$value['productsAttributesDescr'],
            'catpath'=>$catpath,
            'man_time'=>$man_time,
            'category'=>$value['categories_id'],
            'favorites'=> 1,
        ]);
        echo '</li>';
    }
    ?>
</ul>