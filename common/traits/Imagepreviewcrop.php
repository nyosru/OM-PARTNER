<?php
namespace common\traits;
use Yii;
Trait Imagepreviewcrop
{
    public function Imagepreviewcrop($from, $src, $where, $action = 'none')
    {
        $src = urldecode($src);
        $filename = str_replace('[[[[]]]]', ' ', $src);
        $filename = str_replace('[[[[', '(', $filename);
        $filename = str_replace(']]]]', ')', $filename);
        $split = explode('/', $src);
        if (count($split) > 1) {
            $file = array_splice($split, -1, 1);
            $file = explode('.', $file[0]);
            $ras = array_splice($file, -1, 1);
            $ras[0] = strtolower($ras[0]);
            $namefile = base64_encode(implode('', $file));
            $dir = implode('/', $split) . '/';
        } else {
            $file = $split[0];
            $file = explode('.', $file);
            $ras = array_splice($file, -1, 1);
            $namefile = base64_encode(implode('', $file));
            $dir = '';
        }

        if (strlen($namefile) > 7) {
            $split[] = $subdir = substr($namefile, 0, 2);
            $split[] = substr($namefile, 2, 2);
            $subdir .= '/' . substr($namefile, 2, 2) . '/';
            $split[] = substr($namefile, 4, 2);
            $subdir .= '/' . substr($namefile, 4, 2) . '/';
            $split[] = substr($namefile, 6, 2);
            $subdir .= '/' . substr($namefile, 6, 2) . '/';
        } elseif (strlen($namefile) > 5) {
            $split[] = $subdir = substr($namefile, 0, 2);
            $split[] = substr($namefile, 2, 2);
            $subdir .= '/' . substr($namefile, 2, 2) . '/';
            $split[] = substr($namefile, 4, 2);
            $subdir .= '/' . substr($namefile, 4, 2) . '/';
        } elseif (strlen($namefile) > 3) {
            $split[] = $subdir = substr($namefile, 0, 2);
            $split[] = substr($namefile, 2, 2);
            $subdir .= '/' . substr($namefile, 2, 2) . '/';
        } else {
            $subdir = '';
        }
        if (!file_exists(Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0]) || $action == 'refresh') {
            if (!is_dir(Yii::getAlias($where) . $dir . $subdir)) {
                $new_dir = '';
                foreach ($split as $value) {
                    $new_dir .= $value . '/';
                    mkdir(Yii::getAlias($where) . $new_dir);
                }
            }
            if ($ras[0] == 'jpg' || $ras[0] == 'jpeg') {
                $image = imagecreatefromjpeg($from . $filename);
            } elseif ($ras[0] == 'png') {
                $image = imagecreatefrompng($from . $filename);
            } else {
                $image = imagecreatefromjpeg($from . $filename);
            }
            $width = imagesx($image);
            $height = imagesy($image);
            $original_aspect = $width / $height;
            if ($original_aspect > 1.3) {
                $thumb_width = 300;
                $thumb_height = 180;
            } elseif ($original_aspect < 0.7) {
                $thumb_width = 180;
                $thumb_height = 300;
            } else {
                $thumb_width = 200;
                $thumb_height = 200;
            }
            $thumb_aspect = $thumb_width / $thumb_height;
            if ($original_aspect >= $thumb_aspect) {
                $new_height = $thumb_height;
                $new_width = $width / ($height / $thumb_height);
            } else {
                $new_width = $thumb_width;
                $new_height = $height / ($width / $thumb_width);
            }
            $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
            imagecopyresampled($thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2,
                0 - ($new_height - $thumb_height) / 2,
                0, 0,
                $new_width, $new_height,
                $width, $height);
            imagejpeg($thumb, Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0], 80);
        }

        return file_get_contents(Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0]);
    }
}
?>