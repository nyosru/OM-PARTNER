<?php
namespace frontend\controllers\actions;

use common\traits\Imagepreviewfile;
use Yii;
use common\models\Zones;

trait ActionTest
{
    public function actionTest()
    {
        $prev = new Imagepreviewfile();
        //   $img = Yii::$app->request->getQueryParam('src');
        $img = $prev->viewpreviewfile('http://odezhda-master.ru/images/', $img, '@webroot/images/');
        if (trim($img) != '') {
            $result_array = array();
            $result_white = array();
            $result_black = array();
            $result_gray = array();
            $result_body = array();
            $return['max_count'] = 0;
            $return['max_rgb'] = '';
            $return['all_px'] = 0;
            $return['proc'] = 0;
            $type = explode('.', $img);
            $count = (integer)count($type) - 1;
            $type = $type[$count];
            switch ($type) {
                case "jpg":
                    $im = imageCreateFromJPEG(Yii::getAlias('@webroot') . $img);
                    break;

                case "gif":
                    $im = imageCreateFromGIF(Yii::getAlias('@webroot') . $img);
                    break;

                case "png":
                    $im = imageCreateFromPNG(Yii::getAlias('@webroot') . $img);
                    break;

                default:
                    die("<p style='color:red;'>Тип файла (" . $img . ") не распознан - " . print_r($type) . "</p>");
            }
            $h = imagesx($im);
            $w = imagesy($im);
            $oh = (integer)$h / 100 * 70;
            $ow = (integer)$w / 100 * 65;
            $rw = (integer)$w / 100 * 17.5;
            $rh = (integer)$h / 100 * 15;
            $x1 = $rh;
            $x2 = ($rh + ($oh / 2)) - ($oh / 100 * 15);
            $x3 = ($rh + $oh) - ($oh / 100 * 30);
            $y1 = $rw;
            $y2 = ($rw + ($ow / 2)) - ($ow / 100 * 15);
            $y3 = ($rw + $ow) - ($ow / 100 * 30);
            $himgp = $oh / 100 * 20;
            $wimgp = $ow / 100 * 20;
            $imdest = imagecreatetruecolor($himgp, $wimgp * 12);
            $bgc = imagecolorallocate($imdest, 255, 255, 255);
            $tc = imagecolorallocate($imdest, 0, 0, 0);
            imagefilledrectangle($imdest, 0, 0, $himgp, $wimgp * 12, $bgc);
            imagecopy($imdest, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 1, $x2, $y1, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 2, $x3, $y1, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 3, $x1, $y2, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 4, $x2, $y2, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 5, $x3, $y2, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 6, $x1, $y3, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 7, $x2, $y3, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 8, $x3, $y3, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 9, $x1, $y3, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 10, $x2, $y2, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 11, $x3, $y1, $himgp, $wimgp);
            imagecopy($imdest, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);

//            $imcheck = imagecreatetruecolor($himgp, $wimgp * 12);
//            $bgcimcheck = imagecolorallocate($imcheck, 255, 255, 255);
//            $tcimcheck = imagecolorallocate($imcheck, 0, 0, 0);
//            imagefilledrectangle($imcheck, 0, 0, $himgp, $wimgp * 3, $bgcimcheck);
//            imagecopy($imcheck, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);
//            imagecopy($imcheck, $im, 0, $wimgp * 1, $x1, $y3, $himgp, $wimgp);
//            imagecopy($imcheck, $im, 0, $wimgp * 2, $x2, $y2, $himgp, $wimgp);


            $h = imagesx($imdest);
            $w = imagesy($imdest);
            $return['all_px'] = $h * $w;
            for ($i = 0; $i < $h; $i++) {
                for ($j = 0; $j < $w; $j++) {
                    $rgb = imagecolorat($imdest, $i, $j);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $hsl = $this->rgbToHsl($r, $g, $b);
//                    if ($hsl[2] <= 0.2 || $hsl[2] >= 0.8 || $hsl[1] <= 0.1 || ($hsl[0] <= 35 && $hsl[0] >= 15)) {

//                    for ($i = 0; $i < $h; $i++) {
//                        for ($j = 0; $j < $w; $j++) {
//                            $rgb = imagecolorat($im, $i, $j);
//                            $r = ($rgb >> 16) & 0xFF;
//                            $g = ($rgb >> 8) & 0xFF;
//                            $b = $rgb & 0xFF;
//                            $hsl = rgbToHsl($r,$g, $b);
//                            if($hsl[2] <=0.2 || $hsl[2] >= 0.8 || $hsl[1] <= 0.1 || ($hsl[0] <= 35 && $hsl[0] >= 15)){
//
//
//                                if ($hsl[2] <=0.2)
//                                {
//                                    $color = "black";
//                                    $result_black[$color]++;
//                                }elseif($hsl[2] >= 0.8){
//                                    $color = "white";
//                                    $result_white[$color]++;
//                                }elseif($hsl[1] <= 0.1){
//                                    $color = "gray";
//                                    $result_gray[$color]++;
//                                }elseif($hsl[0] <= 35 && $hsl[0] >= 15){
//                                    $color = "body";
//                                    $result_body[$color]++;
//                                }
//
//                            } else {
//                                $color = $r . ',' . $g . ',' . $b;
//                                $result_array[$color]++;
//                            }
//                        }
//                    }
                    $color = $r . ',' . $g . ',' . $b;
                    if ($hsl[2] <= 0.2) {
                        $color = "black";
                        $result_black[$color]++;
                    } elseif ($hsl[2] >= 0.8) {
                        $color = "white";
                        $result_white[$color]++;
                    } elseif ($hsl[1] <= 0.1) {
                        $color = "gray";
                        $result_gray[$color]++;
                    } elseif ($hsl[0] <= 35 && $hsl[0] >= 15) {
                        $color = "body";
                        $result_body[$color]++;


                    } else {
                        $result_array[$color]++;
                    }
                }
            }
            foreach ($result_array as $key => $value) {
                if ($value > $return['max_count']) {
                    $return['max_count'] = $value;
                    $return['max_rgb'] = $key;
                }
            }
            $return['proc'] = round(($return['max_count'] * 100) / $return['all_px'], 0);

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo '<pre>';
            print_r($return);
            echo '</pre>';

//            $headers = Yii::$app->response->headers;
//            $headers->add('Content-Type', 'image/jpg');
//            $headers->add('Cache-Control', 'max-age=68200');
//            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
//            echo imagejpeg($imdest);

            //    return $return;
        } else {
            die("<p>Файл не найден! " . $img . "</p>");
        }
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