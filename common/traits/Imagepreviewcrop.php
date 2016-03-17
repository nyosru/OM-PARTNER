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
        $spec=PartnersProductsToCategories::find()
            ->where(['products_to_categories.products_id'=>$id])
            ->joinWith('productsSpecification')
            ->joinWith('specificationValuesDescription')
            ->joinWith('specificationDescription')
            ->asArray()->groupBy('products_specifications.products_id')->all();
        if ($id > 0) {
            $x = PartnersProducts::find()->select('`products_last_modified` as last_modified, products_date_added as add_date')->where(['products_id' => trim($id)])->asArray()->all();
            $x=end($x);
            if(!$x['last_modified']){
                $x['last_modified'] = $x['add_date'] ;
            }

                $keyprod = Yii::$app->cache->buildKey('product-' . $id);
                $data = Yii::$app->cache->get($keyprod);
                if (!$data || ($x['last_modified'] != $data['last'])) {
                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->all();
                    $data = end($data);
                    Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $x['last_modified']]);
                } else {
                    $data = $data['data'];
                }
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                    $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

                }


            $src = $data['products']['products_image'];
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

            if (!file_exists(Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0]) || $action == 'refresh') {
                if (!is_dir(Yii::getAlias($where) . $dir . $subdir)) {
                    mkdir(Yii::getAlias($where) .$dir. $subdir, 0777,  true);
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
                imagejpeg($thumb, Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0], 100);
            }
            // return Yii::getAlias($where) . $dir .$subdir. $namefile . '.' . $ras[0];
            return file_get_contents(Yii::getAlias($where) . $dir . $subdir . $namefile . '.' . $ras[0]);
        //        return $this->render('product', ['product' => $data, 'catpath'=>$catpath, 'spec'=>$spec, 'relprod'=>$relProd]);

        } else {
            return $this->redirect('/');
        }

    }
}
?>