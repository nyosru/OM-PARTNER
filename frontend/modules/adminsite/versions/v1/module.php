<?php

namespace frontend\modules\adminsite\versions\v1;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\adminsite\controllers\v1';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/modules/adminsite/views/layouts');
        $this->setViewPath('@frontend/modules/adminsite/views');
        // custom initialization code goes here
    }
}
