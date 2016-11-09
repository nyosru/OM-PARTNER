<?php

namespace frontend\modules\sp\versions\v0;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\sp\controllers\v0';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/modules/sp/views/layouts');
        $this->setViewPath('@frontend/modules/sp/views');
    }
}
