<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionCatalog
{
    public function actionCatalog()
    {
        $this->getView()->params['Chpu'] = '';
        $state = $this->CasheUserStateGet();
        return $this->render('catalog', ['state' => $state]);
    }

}