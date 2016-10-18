<?php
namespace frontend\widgets;

use Yii;

class FlashBanner extends \yii\bootstrap\Widget
{

    public $position = 0;
    public $cookiekey = '';
    public $template = 'top-banner';
    public $template_arr = [
        'top-banner'=>[
            'tpl'=>[
                [
                    'text-position'=>'color:text-position;',
                    'image-position'=>'color:image-position;'
                ]
            ],
            'positions' => [
                [
                    'position-style'=>'color:position-style;',
                    'banner-style'=>'color:banner-style;'
                ],
            ],
        ],
        'side-banner'=>[
            'template'=>'
                <div>
                    {banner}
                </div>',
            'positions' => [
                [
                    'position-style'=>'',
                    'banner-style'=>''
                ],
            ],
        ],
        'circle-banner'=>[
            'template'=>'
                <div>
                    {banner}
                </div>',
            'positions' => [
                [
                    'position-style'=>'',
                    'banner-style'=>''
                ],
            ],
        ]
    ];
    public $img;
    public $color;
    public $text;
    public $id;

    public function init()
    {
        if($this->banerCookie()){
            parent::init();
            echo $this->constructBanner($this->id, $this->template, $this->position, $this->color, $this->img, $this->text);
        }else{
            echo '';
        }


    }

    private function constructTemplate(){
        $template = '
                <div id="{id}"  style="{position-style}">
                    <div id="#flash-banner" style="{banner-style}">
                        {banner}
                    </div>
                </div>';
        return $template;
    }

    private function constructBanner($id = '#flash-banner', $template = 'top-banner' ,$position = '', $color = '#F5F5F5', $img = '', $text = 'Здесь может быть ваша реклама'){
        if($this->template[$template][$position]){
            $template = $this->constructTemplate();
            $patterns = array();
            $patterns[0] = '/{id}/';
            $patterns[1] = '/{banner}/';
            $patterns[2] = '/{position-style}/';
            $patterns[3] = '/{banner-style}/';
            $replacements = array();
            $replacements[0] = $id;
            $replacements[1] = $this->createBannerContent($img, $text);
            $replacements[2] = $this->template_arr[$template][$position]['positions']['position-style'];
            $replacements[3] = $this->template_arr[$template][$position]['positions']['banner-style'];
            $template = preg_replace($patterns, $replacements, $template);
            return $template;
        }else{
            return FALSE;
        }
    }

    private function createBannerContent($img = '', $text = ''){
        $img_style  = $this->template_arr[$this->template]['tpl']['img-position'];
        $text_style =  $this->template_arr[$this->template]['tpl']['text-position'];
        $bannercontent = '
        <div class="banner-content">
        <div class="banner-image" style="'.$img_style.'">'.$img.'</div>
        <div class="banner-text" style="'.$text_style.'">'.$text.'</div>
        </div>
        ';
        return $bannercontent;
    }

    private function banerCookie(){
        $key = md5('flash-banner');
        if (($validcookie = Yii::$app->request->cookies[$key]) == FALSE && $validcookie !== $this->cookiekey) {
            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => $key,
                'value' => $this->cookiekey
            ]));
            return false;
        }else{
            return true;
        }
    }
}
