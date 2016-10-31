<?php
namespace frontend\controllers\actions;

use common\models\PartnersNews;
use Yii;
use common\traits\Trim_Tags;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\widgets\LinkPager;

trait ActionNews
{
    public function actionNews()
    {
        $id = (integer)Yii::$app->request->getQueryParam('id');
        if(isset($id)){
          $query =  \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1', 'id'=>$id]);
        }else{
            $query =  \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]);

        }
        $x = PartnersNews::find()->select('MAX(`date_modified`) as last_modified ')->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->asArray()->one();
        $key = Yii::$app->cache->buildKey('partner-' . Yii::$app->params['constantapp']['APP_ID'] . '-newspa-' . (integer)(Yii::$app->request->post('page')) . '-set-' .
            (integer)(Yii::$app->params['partnersset']['newsonindex']['value']).'-ud'.$id);
        if (($newsprovider = Yii::$app->cache->get($key)) == FALSE || $x['date_modified'] == $newsprovider['lastupdate']) {
            $newsprovider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'defaultPageSize' => 10,
                ],
            ]);

            $pagination = $newsprovider->getPagination();
            $newsprovider = $newsprovider->getModels();
            Yii::$app->cache->set($key, ['data' => $newsprovider, 'pagination' => $pagination, 'lastupdate' => $x['date_modified']]);
        } else {
            $newsprovider = $newsprovider['data'];
            $pagination = $newsprovider['pagination'];
        }
            return $this->render('newsprovider', ['newsprovider' => $newsprovider, 'pagination' => $pagination]);
    }
}

