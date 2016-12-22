<?php

namespace frontend\widgets;

use Yii;
use yii\base\Security;

class StatWidget extends \yii\bootstrap\Widget
{
    public $cockie_name = 'genstat';
    public $cockie_value = '';

    public function run()
    {

        $cookies = Yii::$app->request->cookies;
        if ($cookies->has($this->cockie_name)){
            $this->cockie_value = $cookies->getValue($this->cockie_name);
        }else{
            if(($sources = Yii::$app->request->getQueryParam('utm_sources')) == TRUE
                &&
                ($campaign = Yii::$app->request->getQueryParam('utm_campaign')) == TRUE
            ){
                $sources = $sources.'-'.$campaign;
            }else{
                if(!preg_match('/^(http://)*'.$_SERVER['HTTP_HOST'].'/iu',$_SERVER['HTTP_REFERER'])){
                    $sources = $_SERVER['HTTP_REFERER'];
                }

            }
            $this->cockie_value =  md5(microtime() . rand(0, 9999));
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                $this->cockie_name => $this->cockie_value,
            ]));
        }




    }


}