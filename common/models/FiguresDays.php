<?php
namespace common\models;

use common\patch\ActiveRecordExt;
use Yii;

class FiguresDays extends ActiveRecordExt{

    public static function tableName()
    {
        return 'partners_figures_days';
    }
    
    public function rules()
    {
        return [
            [['description','image','tags'], 'string' ],
            [['description','image','tags','date_added'], 'required']
        ];
    }
    public function getProducts(){
        return $this->hasMany(FiguresDaysProduct::className(),['group_id'=>'id']);
    }
}