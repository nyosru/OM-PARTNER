<?php
namespace frontend\controllers\actions;

use Yii;

trait LayOutVar
{

    public function SetChpu($data)
    {
        $this->getView()->params['Chpu'] = $data;
    }
}