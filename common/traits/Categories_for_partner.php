<?php
namespace common\traits;

use Yii;
use common\models\PartnersCategories;
use common\models\PartnersCatDescription;

Trait Categories_for_partner
{
    public function categories_for_partners()
    {
        $categoriess = new PartnersCategories();
        $categoriesd = new PartnersCatDescription();
        $key = Yii::$app->cache->buildKey('categories-api-key-56-'.Yii::$app->params['customcat']);
        $data = Yii::$app->cache->get($key);
        if ($data['data'] == FALSE) {

            $custom_category_tree = file_get_contents(\Yii::getAlias('@frontend') . '/runtime/category-tree/custom_tree.json');
            if($custom_category_tree) {
                $custom_category_tree = (array)json_decode($custom_category_tree, true);
            }

            if(Yii::$app->params['customcat']){
                if($custom_category_tree) {
                    $f = $custom_category_tree['cat'];
                } else {
                    $f = $this->customCatalog()['cat'];
                }
            }else{
                $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0 and categories_id NOT IN (327,1354) and parent_id NOT IN(327,1354)')->createCommand()->queryAll();
            }

            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->createCommand()->queryAll();
            if(Yii::$app->params['customcat'] && isset($s) && ($customname = $custom_category_tree['name']) == TRUE){
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
            $data = array($f, $s);
            Yii::$app->cache->set($key, ['data' => $data], 3600);
        } else {
            $data = $data['data'];
        }
        return $data;
    }
}

?>