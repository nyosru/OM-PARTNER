<?php
namespace common\traits;

use Yii;


trait DominantCol
{
    function dominant_color($img)
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
            $white = 0;
            $black = 0;
            $body = 0;
            $gray = 0;
            $return['max_count'] = 0;
            $return['max_rgb'] = '';
            $return['all_px'] = 0;
            $return['proc'] = 0;
            $type = explode('.', $img);
            $count = (integer)count($type) - 1;
            $type = $type[$count];
            switch (strtolower($type)) {
                case ('jpg' || 'jpeg'):
                    $im = imageCreateFromJPEG(Yii::getAlias('@webroot') . $img);
                    break;

                case 'gif':
                    $im = imageCreateFromGIF(Yii::getAlias('@webroot') . $img);
                    break;

                case 'png':
                    $im = imageCreateFromPNG(Yii::getAlias('@webroot') . $img);
                    break;

                default:
                    die("<p style='color:red;'>Тип файла (" . $img . ") не распознан - " . print_r($type) . "</p>");
            }
            $h = imagesx($im);
            $w = imagesy($im);
            $oh = $h / 100 * 70;
            $ow = $w / 100 * 65;
            $rw = $w / 100 * 17.5;
            $rh = $h / 100 * 15;
            $x1 = (integer)$rh;
            $x2 = (integer)(($rh + ($oh / 2)) - ($oh / 100 * 15));
            $x3 = (integer)(($rh + $oh) - ($oh / 100 * 30));
            $y1 = (integer)$rw;
            $y2 = (integer)(($rw + ($ow / 2)) - ($ow / 100 * 15));
            $y3 = (integer)(($rw + $ow) - ($ow / 100 * 30));
            $himgp = (integer)($oh / 100 * 20);
            $wimgp = (integer)($ow / 100 * 20);

            $xr1 = range($x1, $x1 + $himgp);
            $xr2 = range($x2, $x2 + $himgp);
            $xr3 = range($x3, $x3 + $himgp);
            $xrange = array_merge($xr1, $xr2, $xr3);
            $yr1 = range($y1, $y1 + $wimgp);
            $yr2 = range($y2, $y2 + $wimgp);
            $yr3 = range($y3, $y3 + $wimgp);
            $yrange = array_merge($yr1, $yr2, $yr3);


            $weight = [
                '00' => 0,
                '11' => 2,
                '12' => 1,
                '13' => 2,
                '21' => 1,
                '22' => 2,
                '23' => 1,
                '31' => 1,
                '32' => 1,
                '33' => 2
            ];

            $weightcheck = [
                '00' => 0,
                '11' => 2,
                '12' => 2,
                '13' => 1,
                '21' => 0,
                '22' => 1,
                '23' => 1,
                '31' => 2,
                '32' => 2,
                '33' => 1
            ];
            $countx = count($xrange);
            $countw = count($yrange);
            $return['all_px'] = $countx * $countw;
            for ($i = 0; $i < $countx; $i++) {
                for ($j = 0; $j < $countw; $j++) {
                    if (in_array($xrange[$i], $xr1)) {
                        $xt = 1;
                    } elseif (in_array($xrange[$i], $xr2)) {
                        $xt = 2;

                    } elseif (in_array($xrange[$i], $xr3)) {
                        $xt = 3;
                    } else {
                        $xt = 0;
                    }
                    if (in_array($yrange[$j], $yr1)) {
                        $yt = 1;
                    } elseif (in_array($yrange[$j], $yr2)) {
                        $yt = 2;

                    } elseif (in_array($yrange[$j], $yr3)) {
                        $yt = 3;
                    } else {
                        $yt = 0;
                    }
                    $weight_index = "$xt$yt";
                    $weightfor = $weight[$weight_index];
                    $weightforcheck = $weightcheck[$weight_index];
                    $rgb = imagecolorat($im, $xrange[$i], $yrange[$j]);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $hsl = $this->rgbToHsl($r, $g, $b);
                    $color = $r . ',' . $g . ',' . $b;
                    if ($hsl[2] <= 0.2) {
                        for ($wfor = 0; $wfor < $weightforcheck; $wfor++) {
                            $result_black[$color]++;
                            $black++;
                        }
                    } elseif ($hsl[2] >= 0.8) {
                        for ($wfor = 0; $wfor < $weightforcheck; $wfor++) {
                            $color = $r . ',' . $g . ',' . $b;
                            $result_white[$color]++;
                            $white++;
                        }
                    } elseif ($hsl[1] <= 0.1) {

                        $result_gray[$color]++;
                        for ($wfor = 0; $wfor < $weightforcheck; $wfor++) {
                            $color = $r . ',' . $g . ',' . $b;
                            $result_gray[$color]++;
                            $gray++;
                        }
                    } elseif ($hsl[0] <= 40 && $hsl[0] >= 10) {

                        for ($wfor = 0; $wfor < $weightforcheck; $wfor++) {
                            $result_body[$color]++;
                            $body++;
                        }
                    } else {
                        for ($wfor = 0; $wfor < $weightfor; $wfor++) {
                            $result_array[$color]++;
                        }
                    }

                }
            }
            if ($return['all_px'] / $black * 2 / 3 > 0.40) {
                array_merge($result_array, $result_black);
            }
            if ($return['all_px'] / $white * 2 / 3 > 0.40) {
                array_merge($result_array, $result_white);
            }
            if ($return['all_px'] / $body * 2 / 3 > 0.98) {
                array_merge($result_array, $result_body);
            }
            if ($return['all_px'] / $gray * 2 / 3 > 0.98) {
                array_merge($result_array, $result_gray);
            }
            foreach ($result_array as $key => $value) {
                if ($value > $return['max_count']) {
                    $return['max_count'] = $value;
                    $return['max_rgb'] = $key;
                }
            }
            $return['proc'] = round(($return['max_count'] * 100) / $return['all_px'], 0);

//  Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//            $headers = Yii::$app->response->headers;
//            $headers->add('Content-Type', 'image/jpg');
//            $headers->add('Cache-Control', 'max-age=68200');
//            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
//            echo imagejpeg($imdest);

            return $return;
        } else {
            die("<p>Файл не найден! " . $img . "</p>");
        }
    }

    function rgbToHsl($r, $g, $b)
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
