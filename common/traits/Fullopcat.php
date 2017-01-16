<?php
namespace common\traits;

use Yii;
use common\models\PartnersCategories;
use common\models\PartnersCatDescription;

trait Fullopcat
{
    public function full_op_cat()
    {
        $key = Yii::$app->cache->buildKey('fullopcatcategories-2345' . Yii::$app->params['constantapp']['APP_ID'].Yii::$app->params['customcat']);
        $data = Yii::$app->cache->get($key);
        if ($data['data'] == FALSE) {
            // $checks = Yii::$app->params['constantapp']['APP_CAT'];
            $categoriess = new PartnersCategories();
            $categoriesd = new PartnersCatDescription();
            if(Yii::$app->params['customcat']){
                $f = $this->customCatalog()['cat'];
            }else{
                $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0 and categories_id NOT IN (327,1354) and parent_id NOT IN(327,1354)')->createCommand()->queryAll();

            }
            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->createCommand()->queryAll();
            if(Yii::$app->params['customcat'] && isset($s) && ($customname = $this->customCatalog()['name']) == TRUE){
                foreach ($s as $skey=>$sname){
                    if(in_array($customname, $sname['categories_id'])){
                        $s[$skey]['categories_name'] = $customname[$skey];
                        unset($customname[$skey]);
                    }
                }
                if($customname) {
                    foreach ($customname as $customnamekey => $customnamevalue) {
                        $s[] = [
                            'categories_id'=>$customnamekey,
                            'categories_name'=>$customnamevalue];
                    }
                }
            }
            $catdataallow = $f;
            foreach ($s as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            for ($i = 0; $i < count($catdataallow); $i++) {
                $row = $catdataallow[$i];
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = $row;
                }
                $arr_cat[$row['parent_id']][] = $row;
                if(!$catnamearr[$row['categories_id']]){
                    $catnamearr[$row['categories_id']] = 'NoName'.$row['categories_id'];
                }
            }

            Yii::$app->cache->set($key, ['data' => ['cat' => $arr_cat, 'name' => $catnamearr]], 1800);
        } else {
            $arr_cat = $data['data']['cat'];
            $catnamearr = $data['data']['name'];
        }
        return ['cat' => $arr_cat, 'name' => $catnamearr];
    }
}

?>