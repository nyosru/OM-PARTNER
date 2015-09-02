<?php
/* @var $this yii\web\View */
use common\models\Partners;
use common\models\User;
use common\models\PartnersOrders;
$this->title = 'Главная';
?>
<div class="site-index">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-aqua">
            <div class="inner">
                    <h3><?=Partners::find()->count()?></h3>
                    <p>Партнеров</p>
            </div>
            <div class="icon">
                    <i class="ion ion-person"></i>
            </div>
                <a href="/partners/" class="small-box-footer">Больше информации <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=User::find()->count()?></h3>
                <p>Пользователей</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="/users/" class="small-box-footer">Больше информации <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=PartnersOrders::find()->count()?></h3>
                <p>Заказов</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="/orders/" class="small-box-footer">Больше информации <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=PartnersOrders::find()->where(['!=','orders_id','NULL'])->count()?></h3>
                <p>Переданно заказов в систему ОМ</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="/orders/" class="small-box-footer">Больше информации <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12" id="calendar">

    </div>
                <script>
                    $(document).ready(function() {

                        // page is now ready, initialize the calendar...

                        $('#calendar').fullCalendar({
                            // put your options and callbacks here
                        })

                    });
                    </script>
</div>