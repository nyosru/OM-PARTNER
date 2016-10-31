<?php
namespace frontend\controllers\actions;

use common\models\PartnersProducts;
use Yii;

trait ActionSiteSearchword
{
    public function actionSearchword()
    {
        $filt = mb_strtolower(Yii::$app->request->getQueryParam('filt', NULL), mb_detect_encoding(Yii::$app->request->getQueryParam('filt', NULL)));
        if(!preg_match('/^[0-9\s]+/', $filt)){
        $key = Yii::$app->cache->buildKey('searchfullnamnes');
        $key2 = Yii::$app->cache->buildKey('searchfullnamnes-' . $filt);
        $testmain = Yii::$app->cache->get($key2);
        if (!$testmain['data']) {
            $test = Yii::$app->cache->get($key);
            if (isset($test['data'])) {
                $test = $test['data'];
            } else {
                $test = PartnersProducts::find()->select('products_name as name')->where('products_status = 1 and (products_image IS NOT NULL) and ( products.products_quantity > 0 ) ')->JoinWith('productsDescription')->distinct()->orderBy(['products_date_added' => SORT_DESC, 'products.products_id' => SORT_ASC])->asArray()->all();
                Yii::$app->cache->set($key, ['data' => $test], 604800);
            }
            foreach ($test as $value) {
                preg_match('/^[^\ \_\(\)\,\-\.\'\\\;\:\+\/"?]*(' . $filt . ')[^\ \_\(\)\,\-\.\'\\\;\:\+\/"?]*/iu', $value['name'], $output_array);
                $preg[] = mb_strtolower($output_array[0], mb_detect_encoding($output_array[0]));
            }
            $preg = array_unique($preg);
            $testout = implode('/////', $preg);
            Yii::$app->cache->set($key2, ['data' => $testout], 604800);
        } else {
            $testout = $testmain['data'];
        }

        return $testout;

    }else{
            return '';
        }
    }
}

?>