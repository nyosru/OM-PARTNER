<?php

namespace frontend\widgets;

use Yii;
use yii\base\Security;

class StatWidget extends \yii\bootstrap\Widget
{
    public $cockie_name = 'stat-om';
    public $cockie_value = '';
    public $filter = [
        'ip' =>[
            '5.9.90.106',       //V zakupke
            '141.8.132.75',     //Yandex
            '141.8.132.28',
            '130.193.50.23',
            '93.158.152.78',
            '141.8.142.145',
            '207.46.13.33',     //BingBot
            '207.46.13.181',
            '207.46.13.39',
            '157.55.39.55',
            '163.172.65.119',   // AhrefsBot
            '163.172.65.125',
            '163.172.65.19',
            '163.172.66.67',
            '163.172.65.216',
            '163.172.66.6',
            '163.172.65.11',
            '163.172.66.107',
            '163.172.66.10',
            '163.172.66.159',
            '163.172.64.249',
            '163.172.65.118',
            '163.172.65.180',
            '163.172.65.200',
            '163.172.66.159',
            '163.172.66.3',
            '163.172.65.69',
            '163.172.66.86',
            '163.172.64.232',
            '163.172.65.231',
            '163.172.66.180',
            '163.172.65.31',
            '163.172.65.50',
            '163.172.66.118',
            '163.172.66.76',
            '163.172.65.187',
            '163.172.66.38',
            '163.172.66.146',
            '163.172.66.108',
            '163.172.64.244',
            '163.172.66.143',
            '163.172.64.181',
            '163.172.66.129',
            '163.172.65.15',
            '163.172.65.126',
            '163.172.66.95',
            '163.172.66.28',
            '163.172.66.74',
            '163.172.66.39',
            '163.172.66.179',
            '66.249.66.246',    //Google
            '66.249.76.8',
            '66.249.66.242',
            '66.249.76.6',
            '217.20.153.217',   //OK
            '68.180.229.40',     //Yahoo
           // '62.76.102.224'     //CURL
        ],
        'ua'=>[
            'ahrefs\.com',
            'yandex\.com',
            'google\.com',
            'Mail\.RU',
            'vk\.com',
            'bing\.com',
            'mj12bot\.com',
            'deusu\.de',
            'majestic12\.co\.uk',
            'odnoklassniki\.ru'

        ]
    ];
    public function run()
    {

        $cookies = Yii::$app->request->cookies;
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        if (($user = Yii::$app->user->getId()) == FALSE) {
            $user = 'nologin';
        }
        if (!in_array($ipaddress, $this->filter['ip']) &&
            !preg_match('/('.implode('|',$this->filter['ua']).')+/iu',$_SERVER ['HTTP_USER_AGENT'])) {
            if ($cookies->has($this->cockie_name)  ) {


                if (($sources = Yii::$app->request->getQueryParam('utm_source')) == TRUE
                    &&
                    ($campaign = Yii::$app->request->getQueryParam('utm_campaign')) == TRUE
                ) {
                    $sources = $sources . '-' . $campaign;
                } else {
                    if (!preg_match('/^(http:\/\/)*' . $_SERVER['HTTP_HOST'] . '/iu', $_SERVER['HTTP_REFERER'])) {
                        if ($_SERVER['HTTP_REFERER']) {
                            $sources = $_SERVER['HTTP_REFERER'];
                        } else {
                            $sources = '';
                        }
                    }

                }


                $this->cockie_value = $cookies->getValue($this->cockie_name);
                $value_cache_key = Yii::$app->cache->buildKey($this->cockie_value);
                $row = Yii::$app->cache->get($value_cache_key) ;
                $row[] = [
                    'user' => $user,
                    'ip' => $ipaddress,
                    'sources' => $sources,
                    'time' => date('Y-m-d H:i:s'),
                    'uri' => $_SERVER['REQUEST_URI'],
                    'agent'=>$_SERVER ['HTTP_USER_AGENT']
                ];
                Yii::$app->cache->set($value_cache_key, $row, 0);
            } else {
                if (($sources = Yii::$app->request->getQueryParam('utm_source')) == TRUE
                    &&
                    ($campaign = Yii::$app->request->getQueryParam('utm_campaign')) == TRUE
                ) {
                    $sources = $sources . '-' . $campaign;
                } else {
                    if (!preg_match('/^(http:\/\/)*' . $_SERVER['HTTP_HOST'] . '/iu', $_SERVER['HTTP_REFERER'])) {
                        if ($_SERVER['HTTP_REFERER']) {
                            $sources = $_SERVER['HTTP_REFERER'];
                        } else {
                            $sources = 'none';
                        }
                    }

                }
                if (isset($sources)) {
                    $this->cockie_value = md5(microtime() . rand(0, 9999));
                    $cookies = Yii::$app->response->cookies;
                    $cookies->add(new \yii\web\Cookie([
                        'name' => $this->cockie_name,
                        'value' => $this->cockie_value,

                    ]));
                    $stat_set = Yii::$app->cache->buildKey('statistics_bd');
                    $stat_codes = Yii::$app->cache->get($stat_set);
                    $stat_codes[] = [
                        'seed' => $this->cockie_value,
                        'user' => $user,
                        'ip' => $ipaddress,
                        'time' => date('Y-m-d H:i:s'),
                        'sources' => $sources,
                        'agent'=>$_SERVER ['HTTP_USER_AGENT']
                    ];

                    Yii::$app->cache->set($stat_set, $stat_codes, 0);

                    $value_cache_key = Yii::$app->cache->buildKey($this->cockie_value);
                    $row = Yii::$app->cache->get($value_cache_key);
                    $row[] = [
                        'user' => $user,
                        'ip' => $ipaddress,
                        'sources' => $sources,
                        'time' => date('Y-m-d H:i:s'),
                        'uri' => $_SERVER['REQUEST_URI'],
                        'agent'=>$_SERVER ['HTTP_USER_AGENT']
                    ];
                    Yii::$app->cache->set($value_cache_key, $row, 0);
                }
            }
        }
    }


}