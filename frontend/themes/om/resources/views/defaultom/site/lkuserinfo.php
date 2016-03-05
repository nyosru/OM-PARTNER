<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use \common\models\UserProfile;
use yii\bootstrap\Collapse;
Collapse::widget();
?>


<div id="index-card-4">Мои данные</div>
<div style="margin-bottom: 46px; padding: 0px 20px;">Эта информация никогда не будет доступна третьим лицам</div>

<?
$sorter = '';
$cs = count($tab_order);



for($i=0; $i<$cs; $i++){
    switch($i){
        case '0':
            $addclass = 'first-sorter';
            break;
        case $cs-1:
            $addclass = 'last-sorter';
            break;
        default:
            $addclass = '';
            break;
    }

//    $sorter .=Collapse::widget([
//        'items' => [
//            [
//                'label' => $tab_order[$i],
//                'content' => 's',
//                'contentOptions' => ['class' => 'user-order-row-expand'],
//                'options' => ['class' => 'user-order-row', 'style'=>'']
//            ],
//
//        ],
//        'id'=>'expanded-tab-user-'.$i,
//        'options'=>['style'=>'margin:0px;width:calc(100% /5)', 'class'=>'collapse-toggle header-sort-item active '.$addclass]
//    ]);
   // $sorter .=  '<a class="sort"  ><a aria-expanded="true"  href="#expanded-tab-user'.$i.'" data-toggle="collapse" data-parent="#expanded-tab-user'.$i.'" style="width:calc(100% /5)" class="'.$addclass. '  ">'..'</a></a>';
}

?>


<div id="sort-order" style="width: 100%;padding: 0px 20px;">
    <div aria-expanded="true" id="expanded-tab-user-0" class="collapse-toggle header-sort-item active first-sorter panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a aria-expanded="false" class="collapse-toggle collapsed" href="#expanded-tab-user-0-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-0">Мои данные</a>
                </h4></div>
            <div  aria-expanded="false" id="expanded-tab-user-0-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div  style="background: #f5f5f5;margin: 0px -100%; position: relative; left: 100%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                   <?
                   $form = ActiveForm::begin();
                   echo $form->field($cust, 'email' );
                   echo $form->field($cust['userinfo'], 'name' );
                   echo $form->field($cust['userinfo'], 'secondname' );
                   echo $form->field($cust['userinfo'], 'lastname' );
                   echo $form->field($cust['userinfo'], 'adress' );
                   echo $form->field($cust['userinfo'], 'city' );
                   echo $form->field($cust['userinfo'], 'state' );
                   echo $form->field($cust['userinfo'], 'country' );
                   echo $form->field($cust['userinfo'], 'postcode' );
                   echo $form->field($cust['userinfo'], 'telephone' );
                   echo $form->field($cust['userinfo'], 'pasportser' );
                   echo $form->field($cust['userinfo'], 'pasportdate' );
                   echo $form->field($cust['userinfo'], 'pasportwhere' );
                   echo '<div class="form-group">';
                   echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']);
                   echo '</div>';
                   ActiveForm::end();
                   ?>
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-1" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-1-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-1">Данные плательщика</a>
                </h4></div>
            <div style="" id="expanded-tab-user-1-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -100%; position: relative; left: 0%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    s
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-2" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-2-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-2">Данные грзополучателя</a>
                </h4></div>
            <div style="" id="expanded-tab-user-2-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -100%; position: relative; left: -100%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    s
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-3" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-3-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-3">Адресная книга</a>
                </h4></div>
            <div style="" id="expanded-tab-user-3-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -100%; position: relative; left: -200%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    s
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-4" class="collapse-toggle header-sort-item active last-sorter panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-4-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-4">Сменить пароль</a>
                </h4></div>
            <div style="" id="expanded-tab-user-4-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -100%; position: relative; left: -300%; text-align: left; padding: 10px 0px;" class="panel-body">
                    s
                </div>
            </div></div>
    </div>
</div>


<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user0" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло0-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user1" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло1-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user2" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло2-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user3" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло3-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user4" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло4-->
<!--    </div>-->
<!--</div>-->
<!--<div style="height: 0px;" aria-expanded="false" id="#expanded-tab-user5" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло5-->
<!--    </div>-->
<!--</div>-->