<?php
namespace common\traits;

use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\ProductImage;
use Yii;

Trait Imagepreviewcrop
{
    public function Imagepreviewcrop($from, $src, $where, $action = 'none', $sub = FALSE)
    {

        $id = (integer)$src;
        if ($id > 0) {

            $namefile = $id.'-'.(integer)$sub;
            $subdir = '';

            for ($i = 0; $i < 3; $i++) {
                $subdir .= '/' . substr($namefile, $i * 2, 2);
            }
            $dir = 'newpreview';
            if (!file_exists(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg') || $action == 'refresh') {
            $keyprod = Yii::$app->cache->buildKey('productn-' . $id);
            if (($dataprod = Yii::$app->cache->get($keyprod)) == TRUE && $sub === FALSE) {
                $src = $dataprod['data']['products']['products_image'];
            } else if($sub !== FALSE) {
                $prodimages = ProductImage::find()->select(['image_file'])
                    ->where(['product_id' => $id])->offset($sub)
                    ->createCommand()->queryOne(7);
                if($prodimages){
                    $src = $prodimages;
                }else{
                    return file_get_contents(Yii::getAlias('@webroot/images/logo/nofoto.jpg'));
                }
            }else{
                $dataprod = PartnersProducts::find()->where(['products_id' => trim($id)])->asArray()->one();
                $src = $dataprod['products_image'];
            }
            if ($src == '' || $src == '/' || $src == '\\') {
                return file_get_contents(Yii::getAlias('@webroot/images/logo/nofoto.jpg'));
            }
            $filename = $src;
                if (!is_dir(Yii::getAlias($where) . $dir . $subdir)) {
                    mkdir(Yii::getAlias($where) . $dir . $subdir, 0777, true);
                }
                if (($image = imagecreatefromstring(file_get_contents($from . $filename))) == FALSE) {
                    return file_get_contents(Yii::getAlias('@webroot/images/logo/nofoto.jpg'));
                }
                $width = imagesx($image);
                $height = imagesy($image);
                $original_aspect = $width / $height;
                if ($original_aspect > 1.3) {
                    $thumb_width = 450;
                    $thumb_height = 300;
                } elseif ($original_aspect < 0.7) {
                    $thumb_width = 300;
                    $thumb_height = 450;
                } else {
                    $thumb_width = 300;
                    $thumb_height = 300;
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
                //  header('Content-Type: image/jpg');
                imagejpeg($thumb, Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . 'jpg', 70);
                return file_get_contents(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg');
            } else {
                $headers = Yii::$app->response->headers;
                $headers->add('ETag',  md5($namefile));

                return file_get_contents(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg');
            }
            //        return $this->render('product', ['product' => $data, 'catpath'=>$catpath, 'spec'=>$spec, 'relprod'=>$relProd]);

        } else {
            return $this->redirect('/');
        }

   
    }

}

?>