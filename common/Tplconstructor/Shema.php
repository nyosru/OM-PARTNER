<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 25.12.15
 * Time: 15:46
 */
namespace common\TPL;

class TplShema
{

    public $gridshm;

    private $shemas;

    private function loadschemas()
    {
        return new ConfigureTplConstructor();
    }
    public function init()
    {
        return implode(',', $this->loadschemas($this->gridshm));
    }

}