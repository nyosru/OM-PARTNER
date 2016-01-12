<?php

namespace frontend\modules\admin\versions\v1;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\admin\controllers\v0';

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/modules/admin/views/layouts');
        $this->setViewPath('@frontend/modules/admin/views');
        // custom initialization code goes here
    }
}
