<?php

namespace frontend\modules\lk\versions\v0;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\lk\controllers\v0';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/modules/lk/views/layouts');
        $this->setViewPath('@frontend/modules/lk/views');
    }
}
