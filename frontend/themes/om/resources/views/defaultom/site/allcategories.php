<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */
$keyCache = Yii::$app->cache->buildKey('Right-allcategories-'.Yii::$app->params['seourls'].'-'.Yii::$app->params['customcat'].'-'.Yii::$app->params['constantapp']['APP_ID'].'-'.implode('/',Yii::$app->params['layoutset']['opencat']));
if(($cache = Yii::$app->cache->get($keyCache)) == FALSE) {
    $cache .= ''.\frontend\widgets\Menuom::widget(['property' => ['id' => 'all-categories', 'target' => '0', []]]);
    Yii::$app->cache->set($keyCache, $cache, 86400);
    echo $cache;
}else{
    echo $cache;
}