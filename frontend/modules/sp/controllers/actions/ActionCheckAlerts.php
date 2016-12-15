<?php
namespace frontend\modules\sp\controllers\actions;

trait ActionCheckAlerts
{
    /**
     * @return mixed
     */
    public function actionCheckAlerts()
    {
        if(\Yii::$app->request->isPjax) {
            return $this->render('alerts/alert.php');
        }

        return false;
    }
}
