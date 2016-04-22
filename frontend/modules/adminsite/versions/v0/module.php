<?php

namespace frontend\modules\adminsite\versions\v0;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\adminsite\controllers\v0';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/modules/adminsite/views/layouts');
        $this->setViewPath('@frontend/modules/adminsite/views');
    }
}
