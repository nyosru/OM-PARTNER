<?php

namespace frontend\widgets;

use yii\helpers\Html;

class UtmLinker extends \yii\bootstrap\Widget
{
    public $param = [];
    public $contentutm = '';

    public function init()
    {

        if(is_array($this->param)){
            $contentutm = [];
            foreach ($this->param as $sourceskey => $sourcesvalue ){
                $contentutm[] = 'utm_'.$sourceskey.'='.$sourcesvalue;
            }
            $this->contentutm = implode('&amp;',$contentutm);
        }
        return $this->contentutm;
    }
    public function run()
    {
        return $this->contentutm;
    }
}
