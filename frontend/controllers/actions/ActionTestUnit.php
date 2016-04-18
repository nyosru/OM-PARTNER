<?php
namespace frontend\controllers\actions;

use common\models\PartnersCategories;
use Yii;
use yii\helpers\ArrayHelper;

trait ActionTestUnit
{
    public function actionTestunit()
    {
        $checks = Yii::$app->params['constantapp']['APP_CAT'];
        $cat_start = '0';
        $static_cat_key = Yii::$app->cache->buildKey('static-cat-'.$cat_start );
        if(($cat = Yii::$app->cache->get($static_cat_key))==TRUE){

        }else{
            $categoriesarr = $this->full_op_cat();
            $cat = $this->load_cat($categoriesarr['cat'], $cat_start, $categoriesarr['name'], $checks);
            Yii::$app->cache->set($static_cat_key, $cat, 3600);
        }
        $x  = PartnersCategories::find()->where(['categories_id'=>$cat])->asArray()->all();
        $x = ArrayHelper::index($x,'last_modified');
        ksort($x,SORT_NATURAL);
      //  $x = end($x);
      echo '<pre>';
       print_r ($x);
        echo '</pre>';
        return '';

    }
}