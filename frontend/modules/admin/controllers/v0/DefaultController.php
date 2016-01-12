<?php

namespace frontend\modules\admin\controllers\v0;

use common\traits\Categories_for_partner;
use common\traits\Imagepreviewcrop;
use common\traits\ThemeResources;
use common\traits\Trim_Tags;
use frontend\modules\admin\controllers\actions\ActionCancelorder;
use frontend\modules\admin\controllers\actions\ActionCommentscontrol;
use frontend\modules\admin\controllers\actions\ActionCommentspage;
use frontend\modules\admin\controllers\actions\ActionDelegate;
use frontend\modules\admin\controllers\actions\ActionDocuments;
use frontend\modules\admin\controllers\actions\ActionIndex;
use frontend\modules\admin\controllers\actions\ActionMainpageset;
use frontend\modules\admin\controllers\actions\ActionNewspage;
use frontend\modules\admin\controllers\actions\ActionNewsupdate;
use frontend\modules\admin\controllers\actions\ActionOrderRevert;
use frontend\modules\admin\controllers\actions\ActionOrderUpdate;
use frontend\modules\admin\controllers\actions\ActionPartnersCategories;
use frontend\modules\admin\controllers\actions\ActionRequestnews;
use frontend\modules\admin\controllers\actions\ActionRequestorders;
use frontend\modules\admin\controllers\actions\ActionRequestpage;
use frontend\modules\admin\controllers\actions\ActionRequestupdate;
use frontend\modules\admin\controllers\actions\ActionRequestusers;
use frontend\modules\admin\controllers\actions\ActionSavesettings;
use frontend\modules\admin\controllers\actions\ActionTemplateimage;
use frontend\modules\admin\controllers\actions\ActionUserControl;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    use Imagepreviewcrop,
        ThemeResources,
        ActionIndex,
        ActionSavesettings,
        ActionRequestnews,
        ActionCancelorder,
        ActionRequestusers,
        ActionTemplateimage,
        ActionRequestorders,
        ActionDelegate,
        ActionNewspage,
        ActionRequestpage,
        ActionCommentspage,
        ActionNewsupdate,
        ActionRequestupdate,
        ActionCommentscontrol,
        ActionOrderUpdate,
        ActionPartnersCategories,
        ActionUserControl,
        Categories_for_partner,
        ActionDocuments,
        ActionOrderRevert,
        ActionMainpageset,
        Trim_Tags;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'orderupdate', 'mainpageset', 'orderrevert', 'usercontrol', 'newspage', 'documents', 'requestpage', 'commentspage', 'commentscontrol', 'newsupdate', 'savesettings',
                            'requestusers', 'requestnews', 'requestupdate', 'requestorders', 'delegate', 'cancelorder', 'templateimage', 'partnerscategories'],
                        'allow' => true,
                        'roles' => ['admin'],

                    ],
                ]
            ]
        ];
    }


    private function id_partners()
    {
        return Yii::$app->params['constantapp']['APP_ID'];
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Админка';
    }
}
