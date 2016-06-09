<?php
namespace frontend\controllers\actions\om;

use common\models\ClaimForm;
use common\models\OrdersProducts;
use common\models\OrdersProductsPriten;
use common\models\OrdersProductsPritenPhoto;
use common\models\PartnersPage;
use common\models\PartnersUsersInfo;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

trait ActionLoadClaim
{
    public function actionLoadclaim()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $claim = new ClaimForm();
        $opid = (integer)Yii::$app->request->post('opid');
        if (
            ($customer = PartnersUsersInfo::find()->select('customers_id')->where(['id' => Yii::$app->user->id])->createCommand()->queryOne()) == TRUE
            && ($products_value = \common\models\Orders::find()->select(['customers_id', 'priten'])->joinWith('products')->where(['orders_products_id' => $opid])->asArray()->one()) == TRUE
            && $products_value['customers_id'] == $customer['customers_id']
        )
            $photo = OrdersProductsPritenPhoto::find()->select(['image_name_server', 'image_name'])->where(['orders_products_id' => $opid, 'customer_id' => $customer['customers_id']])->createCommand()->queryAll();
        $comments = OrdersProductsPriten::find()->select(['type', 'orders_products_priten', 'date_add'])->where(['orders_products_id' => $opid])->createCommand()->queryAll();

        return ['photo' => $photo, 'comments' => $comments, 'opid' => $opid];

    }
}