<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionFaq
{
    public function actionFaq()
    {
        return $this->render('faqpage');
    }

}