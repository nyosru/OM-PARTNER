<?php

namespace frontend\widgets;

use common\models\PartnersNews;
use common\traits\Trim_Tags;
use Yii;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/*
 * Виджет новостей для Fabia
 */
class NewsBlockFabia extends \yii\bootstrap\Widget
{
    use Trim_Tags;

    private $newsprovider;

    public function init()
    {
        $x = PartnersNews::find()->select('MAX(`date_modified`) as last_modified ')->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->asArray()->one();
        $key = Yii::$app->cache->buildKey('partner-' . Yii::$app->params['constantapp']['APP_ID'] . '-newspage-' . (integer)(Yii::$app->request->post('page')) . '-set-' . (integer)(Yii::$app->params['partnersset']['newsonindex']['value']));
        if (($newsprovider = Yii::$app->cache->get($key)) == FALSE || $x['last_modified'] !== $newsprovider['lastupdate']) {
            $newsprovider = new \yii\data\ActiveDataProvider([
                'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]),
                'pagination' => [
                    'defaultPageSize' => 3//(integer)(Yii::$app->params['partnersset']['newsonindex']['value']),
                ],
            ]);
            $this->newsprovider = $newsprovider->getModels();
            Yii::$app->cache->set($key, ['data' => $this->newsprovider, 'lastupdate' => $x['last_modified']]);
        } else {
            $this->newsprovider = $newsprovider['data'];
        }
    }
    public function run()
    {

        return $this->render('news-block-fabia/news',['news'=>$this->newsprovider]);
    }
}
