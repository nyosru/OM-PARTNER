<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use common\models\Partners;
/* @var $this \yii\web\View */
/* @var $content string */


echo $this->beginPage();
echo $this->beginBody();
echo $content;
echo $this->endBody();
echo $this->endPage();
