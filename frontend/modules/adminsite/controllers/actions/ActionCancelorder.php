<?php
namespace frontend\modules\adminsite\controllers\actions;

use Yii;
use common\models\PartnersOrders;
use common\models\User;
trait ActionCancelorder{
    public function actionCancelorder()
    {
        $id = Yii::$app->request->getQueryParam('id');
        $orders = new PartnersOrders();
        $orders_data = $orders->findOne($id);
        if (isset($orders_data) && $orders_data !== 9999) {
            if (Yii::$app->params['constantapp']['APP_ID'] == $orders_data->partners_id) {
                if ($orders_data->orders_id == NULL || $orders_data->orders_id == '') {
                    $orders_data->status = 0;
                    if ($orders_data->update()) {
                        $username = User::findOne($orders_data->user_id)->username;
                        Yii::$app->mailer->compose(['html' => 'order-cancel'], ['order' => $orders_data->order, 'user' => $orders_data->delivery, 'id' => $orders_data->id, 'site' => $_SERVER['HTTP_HOST'], 'site_name' => Yii::$app->params['constantapp']['APP_NAME'], 'date_order' => $orders_data->create_date])
                            ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                            ->setTo($username)
                            ->setSubject('Ваш заказ отменен')
                            ->send();
                        return $this->redirect(Yii::$app->request->referrer);
                    } else {
                        return 'Ошибка обновления статуса заказа';
                    }
                } else {
                    return 'Заказ уже передан в ОМ';
                }
            } else {
                return 'Вы не можете редактировать данный заказ';
            }
        } else {
            return 'Нет такого заказа';
        }

    }
}