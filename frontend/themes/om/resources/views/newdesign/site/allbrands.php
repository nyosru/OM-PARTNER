<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */

$this -> title = 'Бренды';
?>
<div class="page-allbrands">
    <div class="container">
        <div class="row">
            <?php foreach ($brands as $brandkey=>$brandvalue){
                if(($result = glob('images/brands/'.$brandvalue['specification_values_id'].'.{jpg,png,gif}', GLOB_BRACE )) == TRUE && $result[0]){
                    $background = 'background: url(/'.$result[0].') no-repeat 50% 50% #FFF ;';
                    $brandvaluespec = '.';
                }else{
                    $background = '';
                    $brandvaluespec = $brandvalue['specification_value'];
                } ?>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <a title="<?=htmlentities($brandvalue['specification_value'])?>" class="brand-label" href="<?=BASEURL?>/catalog?count=60&amp;sfilt[]=<?=$brandvalue['specification_values_id']?>" style="<?=$background?>"></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>