<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use common\models\PartnersOrders;
use yii\data\ActiveDataProvider;
$this -> title = 'Заказы';
$this -> registerCssFile('/css/partners.css');

?>
<table id="orders-table" class="admin-table cell-border responsive hover"></table>
