<?php
use yii\filters\AccessControl;
use yii\web\User;
use Yii;
/* @var $this yii\web\View */
?>
<?php  
$brands = \common\models\SpecificationValues::find()->where(['specification_id'=>'77'])->asArray()->all();
echo '<pre>';
print_r($brands);
echo '</pre>';