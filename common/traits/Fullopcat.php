<?
namespace common\traits;
use Yii;
use common\models\PartnersCategories;
use common\models\PartnersCatDescription;

trait Fullopcat
{
    public function full_op_cat()
    {
        $key = Yii::$app->cache->buildKey('fullopcatcategories');
        $data = Yii::$app->cache->get($key);
        if (!isset($data['data'])) {
            $checks = Yii::$app->params['constantapp']['APP_CAT'];
            $categoriess = new PartnersCategories();
            $categoriesd = new PartnersCatDescription();
            $f = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All();
            $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All();
            foreach ($f as $value) {
                if (in_array(intval($value['categories_id']), $checks)) {
                    $catdataallow[] = $value;
                }
            }
            for ($i = 0; $i < count($catdataallow); $i++) {
                $row = $catdataallow[$i];
                if (empty($arr_cat[$row['parent_id']])) {
                    $arr_cat[$row['parent_id']] = $row;
                }
                $arr_cat[$row['parent_id']][] = $row;
            }
            foreach ($s as $value) {
                $catnamearr[$value['categories_id']] = $value['categories_name'];
            }
            Yii::$app->cache->set($key, ['data' => ['cat' => $arr_cat, 'name' => $catnamearr]]);
        } else {
            $arr_cat = $data['data']['cat'];
            $catnamearr = $data['data']['name'];
        }
        return ['cat' => $arr_cat, 'name' => $catnamearr];
    }
}

?>