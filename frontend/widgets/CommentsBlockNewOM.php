<?php

namespace frontend\widgets;

use common\models\PartnersComments;
use common\models\PartnersUsersInfo;
use common\traits\Trim_Tags;
use Yii;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

class CommentsBlockNewOM extends \yii\bootstrap\Widget
{
    use Trim_Tags;
    public $nameblock = [
        '0' => 'ОТЗЫВЫ О МАГАЗИНЕ',
        '1' => 'ОТЗЫВЫ О ТОВАРЕ',
        '2' => 'КОММЕНТАРИИ'
    ];
    public $relateID;
    public $category;

    public function run()
    {
        $commentsprovider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\PartnersComments::find()->where(['relate_id' => $this->relateID, 'category' => $this->category, 'partners_id' => Yii::$app->params['constantapp']['APP_ID'],
                'status' => '1'])->orderBy(['date_modified' => SORT_DESC, 'id' => SORT_DESC]),
            'pagination' => [
                'defaultPageSize' => 2,
            ],
        ]);
        $pagination = $commentsprovider->getPagination();
        $commentsprovider = $commentsprovider->getModels();
        $comments = [];
        if ($commentsprovider) {
            foreach ($commentsprovider as $key => $valuecomments) {
                $userinfoview = PartnersUsersInfo::findOne($valuecomments->user_id);
                if (isset($userinfoview->name) && isset($userinfoview->lastname)) {
                    $name_comments = $userinfoview->name . ' ' . $userinfoview->lastname;
                } else {
                    $name_comments = 'Роман Колпаков';
                }
                $comments[] = [
                    'date' => $valuecomments->date_modified,
                    'name' => $name_comments,
                    'text' => $this->trim_tags_text($valuecomments->post, 400),
                ];
            }
        }
        if (!Yii::$app->user->isGuest) {
            $modelform = new \common\models\PartnersComments();
            $userinfo = PartnersUsersInfo::findOne(['id' => Yii::$app->user->id]);
            if (!$userinfo) {
                $userinfo = new PartnersUsersInfo();
            }
        }
        return $this->render('comments-block-new-om/main',[
            'nameblock' => $this->nameblock[$this->category],
            'pagination' => $pagination,
            'comments' => $comments,
            'modelform' => $modelform,
            'userinfo' => $userinfo,
            'relateID' => $this->relateID,
            'category' => $this->category,
        ]);
    }
}
