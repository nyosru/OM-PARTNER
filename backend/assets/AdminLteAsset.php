<?php
namespace backend\assets;

use yii\base\Exception;
use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/';
    public $css = [
        'almasaeed2010/adminlte/dist/css/AdminLTE.min.css',
        'almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.css',
        'almasaeed2010/adminlte/plugins/fullcalendar/fullcalendar.min.css'
    ];
    public $js = [
        'almasaeed2010/adminlte/dist/js/app.min.js',
        'almasaeed2010/adminlte/plugins/fullcalendar/moment.min.js',
        'almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.js',
        'almasaeed2010/adminlte/plugins/fullcalendar/fullcalendar.min.js',

    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',


    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = '_all-skins';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('almasaeed2010/adminlte/dist/css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }
}
