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
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        '\\yii\\materialicons\\AssetBundle',
        'vova07\imperavi\Asset'

    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public function LoadCssRes($asset = '', $side)
    {
        return $this->ThemeResourcesload($asset, $side)['css'];
    }

    public function LoadJsRes($asset = '', $side)
    {
        return $this->ThemeResourcesload($asset, $side)['js'];
    }

    public function LoadAssets($asset = 'defaultom', $side = 'site')
    {
        $this->css = $this->LoadCssRes($asset, $side);
        $this->js = $this->LoadJsRes($asset, $side);
        $this->jsOptions = ['position' => \yii\web\View::POS_END];
       return $this;

    }
}

?>