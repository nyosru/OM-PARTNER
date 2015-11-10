<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\PartnersConfig;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Login form
 */
class PartnersSettings extends Model
{
    public $mailcounter;
    public $yandexcounter;
    public $template;
    public $minimalordertotalprice;
    public $discount;
    public $yandexmap;
    public $googlemap;
    public $contacts;
    public $logotype;
    /**
     * @inheritdoc
     */
    private function partnersmodel()
    {
        return new PartnersConfig();
    }

    private function loadmodelpartners()
    {
        $id = Yii::$app->params['constantapp']['APP_ID'];
         $set = ArrayHelper::index($this->partnersmodel()->find()->select(['id', 'type', 'value', 'active'])->where(['partners_id' => $id])->asArray()->all(), 'type');
        foreach($set as $key =>$value){
            if(unserialize($value['value'])){
                $inarr = $value;
                unset($inarr['value']);
                $set[$key] = unserialize($value['value']);
                array_merge($set[$key], $inarr);
            }
        }
        return $set;
    }

    public function rules()
    {
        return [
            [['mailcounter', 'discount', 'yandexcounter', 'minimalordertotalprice'], 'integer'],
            [['template', 'googlemap', 'yandexmap', 'logotype'], 'string'],
            [['contacts'], 'ValidateArr']
        ];
    }



    public function ValidateArr()
    {
       if(is_array($this->contacts)){
           return true;
       }else{
           return false;
       }


    }

    public function SaveSet()
    {
        foreach ($this as $key => $value) {

            if ($this->Saveitem($key, $value)) {
                $result[$key] = 'success';
            } else {
                $result[$key] = 'negative';
            }
        }
        return $result;

    }

    public function LoadSet()
    {

        return $this->loadmodelpartners();
    }

    private function Saveitem($type, $value , $active = 1)
    {
        $row = $this->partnersmodel()->findOne(['partners_id' => Yii::$app->params['constantapp']['APP_ID'] , 'type'=> $type]);
        if(!isset($row)){
           $row =  $this->partnersmodel();
        }
        $row->type = $type;
        if(is_array($value)){
            $value= serialize($value);
        }
        $row->value = $value;
        $row->partners_id = Yii::$app->params['constantapp']['APP_ID'];
        $row->active = $active;
     if($row->save()){
         return true;
     }else{
         return false;
     }


    }
}
