<?php

namespace frontend\modules\adminsite\controllers\v0;

use common\traits\Categories_for_partner;
use common\traits\Imagepreviewcrop;
use common\traits\ThemeResources;
use common\traits\Trim_Tags;
use frontend\modules\adminsite\controllers\actions\ActionCancelorder;
use frontend\modules\adminsite\controllers\actions\ActionCommentscontrol;
use frontend\modules\adminsite\controllers\actions\ActionCommentspage;
use frontend\modules\adminsite\controllers\actions\ActionDelegate;
use frontend\modules\adminsite\controllers\actions\ActionDocuments;
use frontend\modules\adminsite\controllers\actions\ActionIndex;
use frontend\modules\adminsite\controllers\actions\ActionMainpageset;
use frontend\modules\adminsite\controllers\actions\ActionNewspage;
use frontend\modules\adminsite\controllers\actions\ActionNewsupdate;
use frontend\modules\adminsite\controllers\actions\ActionOrderRevert;
use frontend\modules\adminsite\controllers\actions\ActionOrderUpdate;
use frontend\modules\adminsite\controllers\actions\ActionPartnersCategories;
use frontend\modules\adminsite\controllers\actions\ActionRequestnews;
use frontend\modules\adminsite\controllers\actions\ActionRequestorders;
use frontend\modules\adminsite\controllers\actions\ActionRequestpage;
use frontend\modules\adminsite\controllers\actions\ActionRequestupdate;
use frontend\modules\adminsite\controllers\actions\ActionRequestusers;
use frontend\modules\adminsite\controllers\actions\ActionSavesettings;
use frontend\modules\adminsite\controllers\actions\ActionTemplateimage;
use frontend\modules\adminsite\controllers\actions\ActionUserControl;
use frontend\modules\adminsite\controllers\actions\ActionCoupons;
use frontend\modules\adminsite\controllers\actions\cat\ActionConfigure;
use frontend\modules\adminsite\controllers\actions\cat\ActionDeleteConfig;
use frontend\modules\adminsite\controllers\actions\cat\ActionListUploadedImages;
use frontend\modules\adminsite\controllers\actions\cat\ActionUpdateConfig;
use frontend\modules\adminsite\controllers\actions\cat\ActionConfigList;
use frontend\modules\adminsite\controllers\actions\cat\ActionUploadOneCatPhoto;
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
        ActionCoupons,
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
        Trim_Tags,
        ActionConfigure,
        ActionConfigList,
        ActionUpdateConfig,
        ActionUploadOneCatPhoto,
        ActionListUploadedImages,
        ActionDeleteConfig;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles'   => [

                            'admin',

                        ],
                        'actions' => [
                            'index',
                            'coupons',
                            'orderupdate',
                            'mainpageset',
                            'orderrevert',
                            'usercontrol',
                            'newspage',
                            'documents',
                            'requestpage',
                            'commentspage',
                            'commentscontrol',
                            'newsupdate',
                            'savesettings',
                            'requestusers',
                            'requestnews',
                            'requestupdate',
                            'requestorders',
                            'delegate',
                            'cancelorder',
                            'templateimage',
                            'partnerscategories',
                            'configure',
                            'config-list',
                            'update-config',
                            'delete-config',
                            'upload-one-cat-photo',
                            'list-uploaded-images',
                        ],
                        'allow'   => true,
                    ],
                    [
                        'roles'   => [

                            'author',

                        ],
                        'actions' => [
                            'index',
                            'requestusers',
                            'newspage',
                            'requestorders',
                            'commentspage',
                            'requestpage',
                        ],
                        'allow'   => true,
                    ],

                ],
            ],
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
