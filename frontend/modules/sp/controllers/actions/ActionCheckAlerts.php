<?php
namespace frontend\modules\sp\controllers\actions;

trait ActionCheckAlerts
{
    /**
     * @return mixed
     */
    public function actionCheckAlerts()
    {
            return $this->render('alerts/alert.php');
    }
}
