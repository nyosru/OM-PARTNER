<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 08.06.16
 * Time: 12:39
 */

namespace frontend\controllers\actions\om;

use common\models\Orders;
use common\models\OrdersReportsOrdersFiles;
use common\models\User;
use Yii;
use common\models\OrdersReportsOrders;

trait ActionTcncopy
{
    public function actionTcncopy()
    {
        if(($orderid = (int)Yii::$app->request->getQueryParam('id')) == TRUE ){
            if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->one()) == FALSE || !isset($cust['customers']['customers_id'])) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            if(($order = Orders::find()->where(['orders_id'=>$orderid, 'customers_id'=>$cust['customers']['customers_id']])->asArray()->one()) == TRUE){
                $otchet = OrdersReportsOrders::find()->where(['orders_id' => $orderid])->asArray()->one();
                $accountingReportOrderID = (int)$otchet['orders_id'];
                $accountingReportID = (int)$otchet['orders_reports_id'];
                $accountingReportGroupID = (int)$otchet['groups_id'];
                $orderFiles = OrdersReportsOrdersFiles::find()->where('(orders_reports_id = '.$accountingReportID.' AND orders_reports_id > 0 AND orders_id = '.$accountingReportOrderID.' AND groups_id = 0) OR (orders_reports_id = '.$accountingReportID.' AND orders_reports_id > 0 AND groups_id > 0 AND groups_id = '.$accountingReportGroupID.')')->orderBy('files_time')->asArray()->all();
                foreach ($orderFiles as $key=>$value){
                    $orderFilesID = $value['id'];
                    $fn = explode('.', $value['filex_servername']);
                    $ext = strtoupper(end($fn));
                    echo "<div data-imid=\"$orderFilesID\" class=\"PhotoList\">" . '<a href="Load_Files_catalog.php?tab=repf&fid=' . $orderFilesID . '"><img src="' . $_SERVER['HTTP_SERVER'] . '/images/File_Icons/' . $ext . '.png" width="50"><br>копия&nbsp;накладной&nbsp;ТК</a></div>';

                }
            }else{
                echo 'print';
            }


        }else{
            return $this->redirect(Yii::$app->request->referrer);
        }

    }
}