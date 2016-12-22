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
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        if(($user = Yii::$app->user->getId()) == FALSE){
            $user = 'nologin';
        }
        if ($cookies->has($this->cockie_name)){
            $this->cockie_value = $cookies->getValue($this->cockie_name);
            $value_cache_key = Yii::$app->cache->buildKey($this->cockie_value);
            $row = Yii::$app->cache->get($value_cache_key);
            $row[] = [
                'user' =>$user,
                'ip'=>$ipaddress,
                'uri'=>$_SERVER['REQUEST_URI']
            ];
            Yii::$app->cache->set($value_cache_key, $row, 0);
        }else{
            if(($sources = Yii::$app->request->getQueryParam('utm_sources')) == TRUE
                &&
                ($campaign = Yii::$app->request->getQueryParam('utm_campaign')) == TRUE
            ){
                $sources = $sources.'-'.$campaign;
            }else{
                if(!preg_match('/^(http:\/\/)*'.$_SERVER['HTTP_HOST'].'/iu',$_SERVER['HTTP_REFERER'])){
                    if($_SERVER['HTTP_REFERER']){
                        $sources = $_SERVER['HTTP_REFERER'];
                    }else{
                        $sources = 'none';
                    }
                }

            }
            if(isset($sources)){
                $this->cockie_value =  md5(microtime() . rand(0, 9999));
                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name'=> $this->cockie_name,
                    'value'=> $this->cockie_value,

                ]));
                $stat_set = Yii::$app->cache->buildKey('statistics_bd');
                $stat_codes = Yii::$app->cache->get($stat_set);
                $stat_codes[] = [
                    'seed'=> $this->cockie_value,
                    'user' =>$user,
                    'ip'=>$ipaddress,
                    'sources'=>$sources
                ];

                Yii::$app->cache->set($stat_set, $stat_codes, 0);

                $value_cache_key = Yii::$app->cache->buildKey($this->cockie_value);
                $row = Yii::$app->cache->get($value_cache_key);
                $row[] = [
                    'user' =>$user,
                    'ip'=>$ipaddress,
                    'uri'=>$_SERVER['REQUEST_URI']
                ];
                Yii::$app->cache->set($value_cache_key, $row, 0);
            }
        }
    }


}