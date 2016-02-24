<?php
namespace frontend\controllers\actions;

use common\models\Test;
use common\patch\ActiveRecordExt;
use common\traits\Imagepreviewfile;
use Yii;
use common\models\Zones;
use common\models\Customers;
use yii\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\widgets\GridView;

trait ActionTest
{
    public function actionTest()
    {
//        $plain = Yii::$app->request->getQueryParam('pass');
//        $password = '';
//        $customers = new Customers();
//        for ($i = 0; $i < 10; $i++) {
//            $password .= $customers->customer_migrate_rand();
//            }
//
//        $salt = substr(md5($password), 0, 2);
//
//        $password = md5($salt . $plain) . ':' . $salt;
//
//        echo $password;
//        die();
        $model = new Test();
        if($model->load(Yii::$app->request->post())){
            $model->save();
        }
        $form =  ActiveForm::begin();
        echo $form->field($model, 'tt');
        ActiveForm::end();

       $out = $model->find()->asArray()->all();

        echo '<pre>';
        print_r(Yii::$app->params['log']);
        print_r($out);
        echo '</pre>';
    }

    public function rgbToHsl($r, $g, $b)
    {
        $oldR = $r;
        $oldG = $g;
        $oldB = $b;

        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);

        $h;
        $s;
        $l = ($max + $min) / 2;
        $d = $max - $min;

        if ($d == 0) {
            $h = $s = 0; // achromatic
        } else {
            $s = $d / (1 - abs(2 * $l - 1));

            switch ($max) {
                case $r:
                    $h = 60 * fmod((($g - $b) / $d), 6);
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;

                case $g:
                    $h = 60 * (($b - $r) / $d + 2);
                    break;

                case $b:
                    $h = 60 * (($r - $g) / $d + 4);
                    break;
            }
        }

        return array(round($h, 2), round($s, 2), round($l, 2));
    }

}