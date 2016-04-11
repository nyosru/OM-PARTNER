<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

class FiguresDaysProduct extends ActiveRecordExt{

    public static function tableName()
    {
        return 'partners_figures_days_product';
    }

    public function rules()
    {
        return [
            ['description', 'string' ],
            [['description','group_id','product_id'], 'required'],
            [['group_id','product_id'],'integer']
        ];
    }
}