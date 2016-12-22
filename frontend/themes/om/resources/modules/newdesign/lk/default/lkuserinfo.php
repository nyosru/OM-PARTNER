<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;


$this->title='Данные пользователя';

foreach ($cust->delivery as $key=>$value){
    if($cust->customers_default_address_id==$value['address_book_id']){
        $defid=$key;
    }
    if($cust->pay_adress_id==$value['address_book_id']){
        $payid=$key;
    }
}
$i=-1;
foreach($cust['delivery'] as $key=>$value){
    if($value['address_book_id']===$cust['delivery_adress_id']){
        $i=$key;
        break;
    }
}
if($i!=-1) {
    $renderForm = $this->render('_lkuserinfo-form',['title'=>'Грузополучатель','value'=>'deliv','key'=>$i,'cust'=>$cust]);
} else {
    $renderForm = '<p>Адрес доставки не выбран. Перейдите на вкладку "Адресная книга" и выберите его</p>';
}
?>
<style>
    .page-userinfo .krajee-datepicker{
        margin: 0;
    }
    .page-userinfo input.form-control {
        width: 100%;
    }
    .page-userinfo .dropdown-menu {
        width: 100%;
        padding: 5px 0;
    }
    .page-userinfo .dropdown-menu>li{
        padding: 0 15px;
        cursor: pointer;
    }
    .page-userinfo .dropdown-menu>li:hover{
        background-color: #f5f5f5;
    }
</style>
<div class="container page-userinfo">
    <div class="row" style="margin: 15px 0;">
        <?=$this->render('_navlk',['user'=>$user])?>
        <div class="col-sm-9">
        <div class="page-title">
            <h2>Мои данные</h2>
        </div>
        <p>Эта информация никогда не будет доступна третьим лицам</p>

        <?php if($savelk==true){ ?>
            <div class="alert alert-info">
                <p>Изменения были сохранены</p>
            </div>
        <?php } ?>
        <?php
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
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Мои данные',
                    'content' => $this->render('_lkuserinfo-form',['title'=>'Пользователь','value'=>'user','key'=>$defid,'cust'=>$cust]),
                    'active' => true
                ], [
                    'label' => 'Данные плательщика',
                    'content' => $this->render('_lkuserinfo-form',['title'=>'Плательщик','value'=>'customer','key'=>$payid,'cust'=>$cust]),
                ], [
                    'label' => 'Данные грузополучателя',
                    'content' => $renderForm,
                ], [
                    'label' => 'Адресная книга',
                    'content' => $this->render('_lkuserinfo-address',['cust'=>$cust]),
                ], [
                    'label' => 'Сменить пароль',
                    'content' => $this->render('_lkuserinfo-pass',['cust'=>$cust]),
                ],
            ],
        ]);
        ?>
        </div>
    </div>
</div>
<script>
    $(document).on('ready', function(){
        $cstate = [];
        $idcountry='';
        $('#state-drop').remove();
        $.ajax({
            type: "GET",
            url: "/site/countryrequest",
            data: '',
            async:false,
            dataType: "json",
            success: function (out) {
                $inner = '';
                $.each(
                    out.response.items, function () {
                        $inner += '<li data-country="' + this.id + '" id="country">' + this.title + '</li>';
                    });
                $check = $('[data-name="country"]').attr('value');
                $.each(out.response.items, function () {
                    if (this.title == $check) {
                        $idcountry = this.id;
                    }
                });
                $('[data-name=country]').after('<ul class="dropdown-menu" data-name="' + $(this).attr('id') + '" id="country-drop" aria-labelledby="dropdownMenu1">' + $inner + '</ul>');
                $('[data-name=country]').attr('autocomplete', 'off');
                idnum = '';
                $('.cstate').each(function (i, item) {
                    $check = $(this).find('[data-name=country]').val();
                    $(this).find('[data-name=state]').each(function(index,item){
                        idnum = this.getAttribute('id');
                        $.each(out.response.items, function () {
                            if (this.title == $check) {
                                $idcountry = this.id;
                               
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "/site/zonesrequest",
                            async: false,
                            data: 'id=' + $idcountry,
                            dataType: "json",
                            success: function (out2) {
                                $inner = '';
                                $.each(out2.response.items, function () {
                                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                                });
                                //   
                                $('[id='+idnum+']').after('<ul class="dropdown-menu state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                                $('[id='+idnum+']').attr('autocomplete', 'off');
                            }
                        });
                    });
                });
            }
        });
    });
    $(document).on('click focus', '[data-name=country]', function () {
        $(this).parent().filter('.state-drop').remove();
        $(this).siblings().filter('#country-drop').show();
    });
    $(document).on('click', '#country', function () {
        $inid=$(this).parent().siblings().filter('[data-name=country]').attr('id');
         $('[data-name=state][id='+$inid+']').val('');
        $(this).parent().siblings().filter('[data-name=country]').val($(this).text());
        $('[id='+$inid+']').attr('data-country', this.getAttribute('country'));
        $(this).parent().filter('#country-drop').hide();
        $(this).parent().filter('.state-drop').remove();
        $(this).parent().siblings().filter('.state-drop').remove();
        $(this).siblings().filter('.state-drop').remove();
        $('.state-drop').remove();
        $.ajax({
            type: "GET",
            url: "/site/zonesrequest",
            data: 'id=' + this.getAttribute('data-country'),
            dataType: "json",
            success: function (out2) {
                $inner = '';
                $.each(out2.response.items, function () {
                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                });
                $('.state-drop').remove();
                $(this).parent().filter('.state-drop').remove();
                $(this).parent().siblings().filter('.state-drop').remove();
                $('[id='+$inid+']').after('<ul class="dropdown-menu state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                $('[id='+$inid+']').attr('autocomplete', 'off');
            }
        });
    });
    $(document).on('click focus', '[data-name=state]', function () {
        $(this).siblings().filter('.state-drop').show();
    });
    $(document).on('click', '#state', function () {
        $inid=$(this).parent().siblings().filter('[data-name=state]').attr('id');
        $('[id='+$inid+']').attr('data-state', this.getAttribute('state'));
        $(this).parent().siblings().filter('[data-name=state]').val($(this).text());
        $(this).parent().filter('.state-drop').hide();
        $('.state-drop').hide();
    });
    $(document).on('keyup', '[data-name=country]', function () {
        $filtCountryArr = $(this).siblings('ul').children();
        $search = this.value;
        $.each($filtCountryArr, function () {
            if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $(document).on('keyup', '[data-name=state]', function () {
        $filtCountryArr = $(this).siblings('ul').children();
        $search = this.value;
        $.each($filtCountryArr, function () {
            if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
</script>
