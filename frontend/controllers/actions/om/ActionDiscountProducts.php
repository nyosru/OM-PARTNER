<?php
namespace frontend\controllers\actions\om;

use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

trait ActionDiscountProducts
{
    public function actionDiscountproducts()
    {

        $actionproducts = [
            961055378,
            961055416,
            961078342,
            961055417,
            961055420,
            961055421,
            960736695,
            961078343,
            960736703,
            961078344,
            961055430,
            961078345,
            961055444,
            961056237,
            961056239,
            961056241,
            961056242,
            961078346,
            961078347,
            961055513,
            961055514,
            961055931,
            961055932,
            961056061,
            961078348,
            961078349,
            961078350,
            961078351,
            961078352,
            961078353,
            961078354,
            961056062,
            961056063,
            961056064,
            961056065,
            961078355,
            961078356,
            961056066,
            961078357,
            961056067,
            961078358,
            961056068,
            961056069,
            961078359,
            961078360,
            961078361,
            961056070,
            961056071,
            961078362,
            961078363,
            961056072,
            961078364,
            961078365,
            961078366,
            961078367,
            961078368,
            961078369,
            961055515,
            961055518,
            961055521,
            961055522,
            961055523,
            961055524,
            961055525,
            961055528,
            961055529,
            961055531,
            961055532,
            961055535,
            961055536,
            961055537,
            961055539,
            961055540,
            961056073,
            961055543,
            961055544,
            961055547,
            961055549,
            961056074,
            960736362,
            961055556,
            961055561,
            961078370,
            961055562,
            961055940,
            961055594,
            961055961,
            961055962,
            961055964,
            961078371,
            961078372,
            961055617,
            961055619,
            961055621,
            961078373,
            961078374,
            961078375,
            961078376,
            961078377,
            961078378,
            961078379,
            961078380,
            961078381,
            961078382,
            961078383,
            961078384,
            961078385,
            961078386,
            961055319,
            961055323,
            961055324,
            961055325,
            961055326,
            961078387,
            961078388,
            961078389,
            961078390,
            961078391,
            961078392,
            961078393,
            961078394,
            961078395,
            961078396,
            961078397,
            961078398,
            961056200,
            961056219,
            961056099,
            961056123,
            961056246,
            961056321,
            961056322,
            961056325,
            961056326,
            961056329,
            961056330,
            961056331,
            961056334,
            961056335,
            961056275,
            961056245,
            961056290,
            961056292,
            961056304
        ];

        $list = array();
        $hide_man = $this->hide_manufacturers_for_partners();
        foreach ($hide_man as $value) {
            $list[] = $value['manufacturers_id'];
        }

        $hide_man = implode(',', $list);
        $orderedproducts = new ActiveDataProvider([
            'query' => PartnersProducts::find()->select('products.products_id')->where(['products.products_model' => $actionproducts])->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') and products.products_status=1  and products.products_quantity > 0 and products.products_price>0')->groupBy('`products_id` DESC'),
            'pagination' => [
                'defaultPageSize' => 60,
                'pageSizeLimit' => [0, 60]
            ],
        ]);
        $pagination = $orderedproducts->getPagination();
        $orprod = [];
        $gmorprod = $orderedproducts->getModels();
        foreach ($gmorprod as $key => $value) {
            if (!in_array($value['products_id'], $orprod)) {
                $orprod[] = $value['products_id'];
            }
        }

        if ($orprod) {
            $orprodstring = implode(',', $orprod);

            $opprovider = new ActiveDataProvider([
                'query' => PartnersProducts::find()->joinWith('productsDescription')->joinWith('productsAttributes')->joinWith('productsAttributesDescr')->where('products.products_id IN (' . $orprodstring . ')')->distinct(),
                'pagination' => [
                    'defaultPageSize' => 60,
                    'pageSizeLimit' => [0, 60]
                ],
            ]);
            $orderedproducts = $opprovider->getModels();
        } else {
            $orderedproducts = [];
        }

        $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
        $man_time = $this->manufacturers_diapazon_id();

        return $this->render('lkorderedproducts', ['orderedproducts' => $orderedproducts, 'pagination' => $pagination, 'catpath' => $catpath, 'man_time' => $man_time, 'title'=>'Акционные товары']);
    }
}