<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use common\models\Specifications;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;

trait ActionAllBrands
{
    public function actionAllbrands()
    {
        $brandsallow = [3852, 9695,2685,3930,2590,3712,9378,9660,2797,2586, 2776, 3762, 2684, 3370, 2645, 2698, 10672, 2743,
            3430, 3391,3344,3397,9325,3407,3379,9330,2948,3362,2588,3820,9247,15162,2949,2751,2696,3100,2594,3724,9694,
            2781,3259, 9346, 15184, 2799, 3076, 3072, 10669, 2428, 2794, 2796, 3256, 2795, 15196, 3818, 2785, 3303, 2767, 2768,
            3756, 2587, 9253, 9261, 9427, 10689, 5305, 9363, 9365 ,2920 , 2915, 9326, 2922, 9354, 3000, 2736, 3377, 9331, 2914, 2592,
            9269, 9539];
        $brands =  Specifications::find()->select('specification_values_description.specification_values_id, specification_values_description.specification_value')->joinWith('specificationValuesDescription')->where(['specification_values.specifications_id'=>'77', 'specification_values.specification_values_id'=>$brandsallow])->asArray()->all();
        $unsetbrands = [3033,10653,10659,9649,9237,2699,3304,2577,9242,9254,4018,2596,3011,3743,3023,9480,3355,2999,3173,9685,2584,9677,2791,9258,3874,5317,3389,9255,9631,3233,2810,9689,2683,3002,3382,3015,2779,4207,3017,2942,3386,2804,3004,9683,3351,2630,3396,
            2947,2628,2919,3232,3260,10661,3101,9458,3375,3302,2582,3019,3001,5143,2953,9251,3876,3009,2927,3025,3003,3381,
            2802,3020,3028,3029,2782,3012,2800,3972,15160,9259,2801,2682,3024,9271,2766,5109,2789,2808,2792,9596,2793,
            2602,15163,3026,3877,9614,2784,2798,3733,9260,5294,3392,9373,15200,9256,3103,3030,3027,3352,4981,2807,3018,9267,
            9249,9652,2944,9262,9351,3010,9263,5300,9510,3006,9623,9246,9264,9243,9600,9600,9265,3008,9266,5308,9272,3022,9239,2945,9240,
            9250,3014,10711,5318,3380,2811,9268,9236,5321,9274,3361,9245,5315,2576,2647,5310,3102,9275,9270,5307,9276,2925,
            3007,9687];
        $brands = \yii\helpers\ArrayHelper::index($brands, 'specification_value');
        ksort($brands,SORT_NATURAL);
        foreach ($brands as $brandskey=>$brandsvalue){
            if(!in_array($brandsvalue['specification_values_id'], $unsetbrands)){
                $resultbrands[$brandskey] =  $brandsvalue;
            }

       }


        return $this->render('allbrands', ['brands'=>$resultbrands]);
    }
}