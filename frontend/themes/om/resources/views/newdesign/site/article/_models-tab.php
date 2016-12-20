<?php foreach($models as $i=>$model) {?>
    <?=($i % 2) ? '':'<div class="row">';?>
    <div class="col-md-6" style="margin-bottom: 15px;">
        <div class="row">
            <div class="col-xs-6">
                <img class="img-thumbnail" src="<?=$model['img']?>">
            </div>
            <div class="col-xs-6">
                <h4 align="center"><?=$model['num']?></h4>
                <table class="table">
                    <?php foreach($model as $key=>$item) {?>
                        <?php if($key=='img' || $key=='num') continue; ?>
                        <tr>
                            <td><?=$param[$key]?></td>
                            <td><?=$item?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <?=($i % 2) || count($models)==$i+1 ? '</div>':'';?>
<?php } ?>