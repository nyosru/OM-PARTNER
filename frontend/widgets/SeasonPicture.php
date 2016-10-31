<?php

namespace frontend\widgets;

use Yii;

class SeasonPicture extends \yii\bootstrap\Widget
{
    public $season = '';
    public $containerStyle = '';
    public $pictureStyle = '';
    public $img_path = '/images/icons/seasons';
    public $season_type = [
        'Лето' => '/summer.png',
        'Зима' => '/winter.png',
        'Весна' => '/spring.png',
        'Осень' => '/autumn.png',
        'Всесезон' => '/allseasons.png',
    ];
    public $template = [
        1 => '
            <div style="position: absolute;top: 0px;left: 40px;">
                <div style="position: absolute;z-index: 10;left: 15px;">{img0}</div>
            </div>
        ',
        2 => '
            <div style="position: absolute;top: 0px;left: 40px;">
                <div style="position: absolute;z-index: 11;left: 15px;">{img0}</div>
                <div style="position: absolute;z-index: 10;left: 30px;">{img1}</div>
            </div>
        ',
        3 => '
            <div style="position: absolute;top: 0px;left: 40px;">
                <div style="position: absolute;z-index: 12;left: 15px;">{img0}</div>
                <div style="position: absolute;z-index: 11;left: 30px;">{img1}</div>
                <div style="position: absolute;z-index: 10;left: 45px;">{img2}</div>
            </div>
        ',
        4 => '
            <div style="position: absolute;top: 0px;left: 40px;">
                <div style="position: absolute;z-index: 13;left: 15px;">{img0}</div>
                <div style="position: absolute;z-index: 12;left: 30px;">{img1}</div>
                <div style="position: absolute;z-index: 11;left: 45px;">{img2}</div>
                <div style="position: absolute;z-index: 10;left: 60px;">{img3}</div>
            </div>
        '
    ];
    private $count = 0;


    public function run()
    {




        parent::init();
        $i = 0;
        $stack = [];
        foreach ($this->season_type as $season_key=>$season_value){
            if(($count = mb_substr_count(mb_strtolower($this->season), mb_strtolower($season_key))) == TRUE && $count > 0){
                $stack[] = '<a style="display: block" href="#"  data-toggle="tooltip" data-placement="top" title="'.$season_key.'"><img style="" src="'.$this->img_path.$season_value.'"></a>';
                $this->count++;
            }
            $i++;
        }
        if($stack){
            return $this->createPicture($stack);
        }else{
            return '';
        }

    }

    public function createPicture($stack){

        $template = $this->template[$this->count];
        foreach ($stack as $stackkey=>$stackvalue){
            $template =  preg_replace('/{img'.$stackkey.'}/iu', $stackvalue, $template);
        }
        return $template;
    }
}