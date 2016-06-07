<?php
namespace common\traits;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use Yii;
Trait Imagepreviewcrop
{
    public function Imagepreviewcrop($from, $src, $where, $action = 'none')
    {
        $id = (integer)$src;
        if ($id > 0) {



            if(($dataprod = Yii::$app->cache->get('product-'.$id)) == TRUE){
                $src = $dataprod['data']['products']['products_image'];
            }else{
                $dataprod = PartnersProducts::find()->where(['products_id' => trim($id)])->asArray()->one();
                $src = $dataprod['products_image'];
            }


            if($src == '' || $src == '/' || $src == '\\'){
                return file_get_contents(Yii::getAlias('@webroot/images/logo/nofoto.jpg'));
            }
            $filename = $src;

            $split = explode('/', $src);
            if (count($split) > 1) {
                $file = array_splice($split, -1, 1);
                $file = explode('.', $file[0]);
                $ras = array_splice($file, -1, 1);
                $ras[0] = strtolower($ras[0]);
                $namefile = base64_encode(implode('', $file));
                $dir = implode('/', $split);
            } else {
                $file = $split[0];
                $file = explode('.', $file);
                $ras = array_splice($file, -1, 1);
                $namefile = base64_encode(implode('', $file));
                $dir = 'rope';
            }
            $dirfile = md5($namefile);
            $subdir = '';

            for($i=0; $i<5; $i++){
                $subdir .= '/'.substr($dirfile, $i*2 , 2);
            }
            if (!file_exists(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg') || $action == 'refresh') {
                if (!is_dir(Yii::getAlias($where) . $dir . $subdir)) {
                    mkdir(Yii::getAlias($where) .$dir. $subdir, 0777,  true);
                }


                   if(( $image  = imagecreatefromstring(file_get_contents($from . $filename)))== FALSE){
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
            }else {
                return file_get_contents(Yii::getAlias($where) . $dir . $subdir . $namefile . '.jpg');
            }
        //        return $this->render('product', ['product' => $data, 'catpath'=>$catpath, 'spec'=>$spec, 'relprod'=>$relProd]);

        } else {
            return $this->redirect('/');
        }

    }
}
?>