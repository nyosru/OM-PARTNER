<?php
namespace frontend\modules\adminsite\controllers\actions;
;

use common\models\PartnersOrders;
use Yii;
use yii\data\ActiveDataProvider;


trait ActionDocuments
{
    public function actionDocuments()
    {
        switch (Yii::$app->request->getQueryParam('type')) {

            case 'pdf'      : {
                $this->layout = 'pdf';
                $docformat = 'pdf';
                break;
            }
            case 'excel'    : {
                $this->layout = 'excel';
                $docformat = 'excel';
                break;
            }
            case 'word'     : {
                $this->layout = 'word';
                $docformat = 'word';
                break;
            }
            default: {
                $this->goBack();
            }
        }

        switch (Yii::$app->request->getQueryParam('doc')) {
            case 'torg_12'      : {
                $order = PartnersOrders::find()->where(['partners_orders.id' => (integer)Yii::$app->request->getQueryParam('id'), 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->asArray()->one();
                return $this->render('@frontend/modules/adminsite/views/default/doc/torg_12/' . $docformat, ['order' => $order]);
            }
            case 'nakladnaya_vozvrat'    : {
                $order = PartnersOrders::find()->where(['partners_orders.id' => (integer)Yii::$app->request->getQueryParam('id'), 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->asArray()->one();
                return $this->render('@frontend/modules/adminsite/views/default/doc/nakladnaya_vozvrat/' . $docformat, ['order' => $order]);
            }
            case 'schet'    : {
                $order = PartnersOrders::find()->where(['partners_orders.id' => (integer)Yii::$app->request->getQueryParam('id'), 'partners_orders.partners_id' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('user')->joinWith('userDescription')->joinWith('oMOrders')->joinWith('oMOrdersProducts')->joinWith('oMOrdersProductsSP')->joinWith('oMOrdersProductsAttr')->groupBy('id')->asArray()->one();
                return $this->render('@frontend/modules/adminsite/views/default/doc/schet/' . $docformat, ['order' => $order]);
            }
            default: {
                return $this->goBack();
            }

        }

    }
}

?>