<?php

namespace frontend\modules\cat\versions\v0;

use common\patch\ModuleExt;

class module extends ModuleExt
{

    public function init()
    {
        $this->controllersDir = basename(__DIR__);
        parent::init();
    }
}
