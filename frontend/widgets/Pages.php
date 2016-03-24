<?php

namespace frontend\widgets;

use common\models\PartnersComments;
use common\models\PartnersPage;
use common\models\PartnersUsersInfo;
use common\traits\Trim_Tags;
use Yii;
use yii\helpers\Html;

class Pages extends \yii\bootstrap\Widget
{
    use Trim_Tags;
    public $options = [];
    private $id;
    private $name;
    private $type;
    private $tags;
    private $content;
    private $partners_id;
    private $active;
    private $viewed;
    private $date_modify;
    private $date_add;
    public function init()
    {



    }

    private function load(){
        $this->active       =   $this->options['active'];
        $this->content      =   $this->options['content'];
        $this->date_add     =   $this->options['date_add'];
        $this->date_modify  =   $this->options['date_modify'];
        $this->name         =   $this->options['name'];
        $this->partners_id  =   $this->options['partners_id'];
        $this->tags         =   $this->options['tags'];
        $this->type         =   $this->options['type'];
        $this->viewed       =   $this->options['viewed'];
    }
}
