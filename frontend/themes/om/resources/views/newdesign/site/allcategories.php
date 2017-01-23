<?php
use frontend\widgets\NewMenuom;
?>
<div style="margin: 20px 0;">
<div class="container page-allcategories">
    <div class="box-content box-category clearfix">
        <?=NewMenuom::widget(['chpu' =>Yii::$app->params['seourls'],'property' =>[ 'target' => '0'],'recursion'=>true]);?>
    </div>
</div>
</div>
<script>
    $(document).on('click','.box-category .subDropdown', function(e) {
        e.preventDefault();
        var parentLink = $(this).parent('a'),
            parentLi = parentLink.parent('li'),
            categoryId = parentLink.attr('data-cat');

        if ($(this).hasClass('plus')) {
            $(this).removeClass('plus').addClass('minus');
            parentLi.children('ul').slideDown();
        } else {
            $(this).removeClass('minus').addClass('plus');
            parentLi.children('ul').slideUp();
        }
    });
    $(document).ready(function(){
        $('.box-category>ul>li>ul').each(function(){
            $(this).slideDown();
            $(this).siblings('a').children('.subDropdown').remove();
        });
    });
</script>