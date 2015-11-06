<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;
use common\traits\ThemeResources;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    use ThemeResources;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public function LoadCssRes($asset = ''){
            return $this->ThemeResourcesload($asset)['css'];
    }
    public function LoadJsRes($asset = ''){
            return $this->ThemeResourcesload($asset)['js'];
    }
    public function LoadAssets( $asset = 'default2'){
        $this->css = $this->LoadCssRes($asset);
        $this->js = $this->LoadJsRes($asset);
        $this->jsOptions = ['position' => \yii\web\View::POS_END];
       return $this;

    }
}
