<?php
namespace frontend\modules\admin\controllers\actions;

use common\models\PartnersCatDescription;
use common\models\PartnersCategories;
use Yii;
use common\models\PartnersSettings;
trait ActionIndex{
    public function actionIndex()
    {
        $model = new PartnersSettings();
        $paramset = Yii::$app->params['partnersset'];
        $contacts = Yii::$app->params['partnersset']['contacts'];
        $model->mailcounter['value'] = $paramset['mailcounter']['value'];
        $model->mailcounter['active'] = $paramset['mailcounter']['active'];
        $model->yandexcounter['value'] = $paramset['yandexcounter']['value'];
        $model->yandexcounter['active'] = $paramset['yandexcounter']['active'];
        $model->discount['value'] = $paramset['discount']['value'];
        $model->discount['active'] = $paramset['discount']['active'];
        $model->minimalordertotalprice['value'] = $paramset['minimalordertotalprice']['value'];
        $model->minimalordertotalprice['active'] = $paramset['minimalordertotalprice']['active'];
        $model->contacts['adress']['value'] = $contacts['adress']['value'];
        $model->contacts['adress']['active'] = $contacts['adress']['active'];
        $model->contacts['telephone']['value'] = $contacts['telephone']['value'];
        $model->contacts['telephone']['active'] = $contacts['telephone']['active'];
        $model->contacts['fax']['value'] = $contacts['fax']['value'];
        $model->contacts['fax']['active'] = $contacts['fax']['active'];
        $model->contacts['email']['value'] = $contacts['email']['value'];
        $model->contacts['email']['active'] = $contacts['email']['active'];
        $model->contacts['graf_work']['activated'] = $contacts['graf_work']['activated'];
        $model->template = $paramset['template']['value'];
        $model->contacts['graf_work']['mon']['active'] = $contacts['graf_work']['mon']['active'];
        $model->contacts['graf_work']['mon']['w']['in'] = $contacts['graf_work']['mon']['w']['in'];
        $model->contacts['graf_work']['mon']['wm']['in'] = $contacts['graf_work']['mon']['wm']['in'];
        $model->contacts['graf_work']['mon']['w']['out'] = $contacts['graf_work']['mon']['w']['out'];
        $model->contacts['graf_work']['mon']['wm']['out'] = $contacts['graf_work']['mon']['wm']['out'];
        $model->contacts['graf_work']['mon']['o']['active'] = $contacts['graf_work']['mon']['o']['active'];
        $model->contacts['graf_work']['mon']['o']['in'] = $contacts['graf_work']['mon']['o']['in'];
        $model->contacts['graf_work']['mon']['om']['in'] = $contacts['graf_work']['mon']['om']['in'];
        $model->contacts['graf_work']['mon']['o']['out'] = $contacts['graf_work']['mon']['o']['out'];
        $model->contacts['graf_work']['mon']['om']['out'] = $contacts['graf_work']['mon']['om']['out'];
        $model->contacts['graf_work']['tue']['active'] = $contacts['graf_work']['tue']['active'];
        $model->contacts['graf_work']['tue']['w']['in'] = $contacts['graf_work']['tue']['w']['in'];
        $model->contacts['graf_work']['tue']['wm']['in'] = $contacts['graf_work']['tue']['wm']['in'];
        $model->contacts['graf_work']['tue']['w']['out'] = $contacts['graf_work']['tue']['w']['out'];
        $model->contacts['graf_work']['tue']['wm']['out'] = $contacts['graf_work']['tue']['wm']['out'];
        $model->contacts['graf_work']['tue']['o']['active'] = $contacts['graf_work']['tue']['o']['active'];
        $model->contacts['graf_work']['tue']['o']['in'] = $contacts['graf_work']['tue']['o']['in'];
        $model->contacts['graf_work']['tue']['om']['in'] = $contacts['graf_work']['tue']['om']['in'];
        $model->contacts['graf_work']['tue']['o']['out'] = $contacts['graf_work']['tue']['o']['out'];
        $model->contacts['graf_work']['tue']['om']['out'] = $contacts['graf_work']['tue']['om']['out'];
        $model->contacts['graf_work']['wed']['active'] = $contacts['graf_work']['wed']['active'];
        $model->contacts['graf_work']['wed']['w']['in'] = $contacts['graf_work']['wed']['w']['in'];
        $model->contacts['graf_work']['wed']['wm']['in'] = $contacts['graf_work']['wed']['wm']['in'];
        $model->contacts['graf_work']['wed']['w']['out'] = $contacts['graf_work']['wed']['w']['out'];
        $model->contacts['graf_work']['wed']['wm']['out'] = $contacts['graf_work']['wed']['wm']['out'];
        $model->contacts['graf_work']['wed']['o']['active'] = $contacts['graf_work']['wed']['o']['active'];
        $model->contacts['graf_work']['wed']['o']['in'] = $contacts['graf_work']['wed']['o']['in'];
        $model->contacts['graf_work']['wed']['om']['in'] = $contacts['graf_work']['wed']['om']['in'];
        $model->contacts['graf_work']['wed']['o']['out'] = $contacts['graf_work']['wed']['o']['out'];
        $model->contacts['graf_work']['wed']['om']['out'] = $contacts['graf_work']['wed']['om']['out'];
        $model->contacts['graf_work']['thu']['active'] = $contacts['graf_work']['thu']['active'];
        $model->contacts['graf_work']['thu']['w']['in'] = $contacts['graf_work']['thu']['w']['in'];
        $model->contacts['graf_work']['thu']['wm']['in'] = $contacts['graf_work']['thu']['wm']['in'];
        $model->contacts['graf_work']['thu']['w']['out'] = $contacts['graf_work']['thu']['w']['out'];
        $model->contacts['graf_work']['thu']['wm']['out'] = $contacts['graf_work']['thu']['wm']['out'];
        $model->contacts['graf_work']['thu']['o']['active'] = $contacts['graf_work']['thu']['o']['active'];
        $model->contacts['graf_work']['thu']['o']['in'] = $contacts['graf_work']['thu']['o']['in'];
        $model->contacts['graf_work']['thu']['om']['in'] = $contacts['graf_work']['thu']['om']['in'];
        $model->contacts['graf_work']['thu']['o']['out'] = $contacts['graf_work']['thu']['o']['out'];
        $model->contacts['graf_work']['thu']['om']['out'] = $contacts['graf_work']['thu']['om']['out'];
        $model->contacts['graf_work']['fri']['active'] = $contacts['graf_work']['fri']['active'];
        $model->contacts['graf_work']['fri']['w']['in'] = $contacts['graf_work']['fri']['w']['in'];
        $model->contacts['graf_work']['fri']['wm']['in'] = $contacts['graf_work']['fri']['wm']['in'];
        $model->contacts['graf_work']['fri']['w']['out'] = $contacts['graf_work']['fri']['w']['out'];
        $model->contacts['graf_work']['fri']['wm']['out'] = $contacts['graf_work']['fri']['wm']['out'];
        $model->contacts['graf_work']['fri']['o']['active'] = $contacts['graf_work']['fri']['o']['active'];
        $model->contacts['graf_work']['fri']['o']['in'] = $contacts['graf_work']['fri']['o']['in'];
        $model->contacts['graf_work']['fri']['om']['in'] = $contacts['graf_work']['fri']['om']['in'];
        $model->contacts['graf_work']['fri']['o']['out'] = $contacts['graf_work']['fri']['o']['out'];
        $model->contacts['graf_work']['fri']['om']['out'] = $contacts['graf_work']['fri']['om']['out'];
        $model->contacts['graf_work']['sat']['active'] = $contacts['graf_work']['sat']['active'];
        $model->contacts['graf_work']['sat']['w']['in'] = $contacts['graf_work']['sat']['w']['in'];
        $model->contacts['graf_work']['sat']['wm']['in'] = $contacts['graf_work']['sat']['wm']['in'];
        $model->contacts['graf_work']['sat']['w']['out'] = $contacts['graf_work']['sat']['w']['out'];
        $model->contacts['graf_work']['sat']['wm']['out'] = $contacts['graf_work']['sat']['wm']['out'];
        $model->contacts['graf_work']['sat']['o']['active'] = $contacts['graf_work']['sat']['o']['active'];
        $model->contacts['graf_work']['sat']['o']['in'] = $contacts['graf_work']['sat']['o']['in'];
        $model->contacts['graf_work']['sat']['om']['in'] = $contacts['graf_work']['sat']['om']['in'];
        $model->contacts['graf_work']['sat']['o']['out'] = $contacts['graf_work']['sat']['o']['out'];
        $model->contacts['graf_work']['sat']['om']['out'] = $contacts['graf_work']['sat']['om']['out'];
        $model->contacts['graf_work']['sun']['active'] = $contacts['graf_work']['sun']['active'];
        $model->contacts['graf_work']['sun']['w']['in'] = $contacts['graf_work']['sun']['w']['in'];
        $model->contacts['graf_work']['sun']['wm']['in'] = $contacts['graf_work']['sun']['wm']['in'];
        $model->contacts['graf_work']['sun']['w']['out'] = $contacts['graf_work']['sun']['w']['out'];
        $model->contacts['graf_work']['sun']['wm']['out'] = $contacts['graf_work']['sun']['wm']['out'];
        $model->contacts['graf_work']['sun']['o']['active'] = $contacts['graf_work']['sun']['o']['active'];
        $model->contacts['graf_work']['sun']['o']['in'] = $contacts['graf_work']['sun']['o']['in'];
        $model->contacts['graf_work']['sun']['om']['in'] = $contacts['graf_work']['sun']['om']['in'];
        $model->contacts['graf_work']['sun']['o']['out'] = $contacts['graf_work']['sun']['o']['out'];
        $model->contacts['graf_work']['sun']['om']['out'] = $contacts['graf_work']['sun']['om']['out'];
        $model->yandexmap['value'] = $paramset['yandexmap']['value'];
        $model->yandexmap['active'] = $paramset['yandexmap']['active'];
        $model->googlemap['value'] = $paramset['googlemap']['value'];
        $model->googlemap['active'] = $paramset['googlemap']['active'];
        $model->logotype['active'] = $paramset['logotype']['active'];
        $model->logotype['value'] = $paramset['logotype']['value'];
        $model->discounttotalorderprice['value'] = $paramset['discounttotalorderprice']['value'];
        $model->discounttotalorderprice['active'] = $paramset['discounttotalorderprice']['active'];
        $model->discounttotalorder['value'] = $paramset['discounttotalorder']['value'];
        $model->discounttotalorder['active'] = $paramset['discounttotalorder']['active'];
        $model->discountgroup['value'] = $paramset['discountgroup']['value'];
        $model->discountgroup['active'] = $paramset['discountgroup']['active'];
        $model->slogan['active'] = $paramset['slogan']['active'];
        $model->slogan['value'] = $paramset['slogan']['value'];
        $model->newsonindex['value'] = $paramset['newsonindex']['value'];
        $model->newsonindex['active'] = $paramset['newsonindex']['active'];
        $model->commentsonindex['value'] = $paramset['commentsonindex']['value'];
        $model->commentsonindex['active'] = $paramset['commentsonindex']['active'];
        $model->transport['value'] = $paramset['transport']['value'];
        $model->transport['active'] = $paramset['transport']['active'];
        $model->paysystem['active'] = $paramset['paysystem']['active'];
        $model->paysystem['value'] = $paramset['paysystem']['value'];
        $model->paysystem['value']['yamoney']['active'] = $paramset['paysystem']['value']['yamoney']['active'];
        $model->paysystem['value']['yamoney']['value'] = $paramset['paysystem']['value']['yamoney']['value'];
        $model->paysystem['value']['webmoney']['active'] = $paramset['paysystem']['value']['webmoney']['active'];
        $model->paysystem['value']['webmoney']['value'] = $paramset['paysystem']['value']['webmoney']['value'];
        $model->paysystem['value']['qiwi']['active'] = $paramset['paysystem']['value']['qiwi']['active'];
        $model->paysystem['value']['qiwi']['value'] = $paramset['paysystem']['value']['qiwi']['value'];
        $model->paysystem['value']['bankpay']['active'] = $paramset['paysystem']['value']['bankpay']['active'];
        $model->paysystem['value']['bankpay']['value']['name'] = $paramset['paysystem']['value']['bankpay']['value']['name'];
        $model->paysystem['value']['bankpay']['value']['inn'] = $paramset['paysystem']['value']['bankpay']['value']['inn'];
        $model->paysystem['value']['bankpay']['value']['kpp'] = $paramset['paysystem']['value']['bankpay']['value']['kpp'];
        $model->paysystem['value']['bankpay']['value']['bankname'] = $paramset['paysystem']['value']['bankpay']['value']['bankname'];
        $model->paysystem['value']['bankpay']['value']['bik'] = $paramset['paysystem']['value']['bankpay']['value']['bik'];
        $model->paysystem['value']['bankpay']['value']['ks'] = $paramset['paysystem']['value']['bankpay']['value']['ks'];
        $model->paysystem['value']['bankpay']['value']['rs'] = $paramset['paysystem']['value']['bankpay']['value']['rs'];
        $model->paysystem['value']['yamoney']['name'] = 'Яндекс деньги';
        $model->paysystem['value']['webmoney']['name'] = 'WebMoney. Рублевый кошелек';
        $model->paysystem['value']['qiwi']['name'] = 'Qiwi';
        $model->paysystem['value']['bankpay']['name'] = 'Банковский перевод';
        $model->paysystem['value']['nalozhplat']['name'] = 'Наложенный платеж';
        $model->paysystem['value']['bankcard']['name'] = 'Банковская карта';
        $model->paymentgate['active']=$paramset['paymentgate']['active'];
        $model->paymentgate['value']=$paramset['paymentgate']['value'];
        $model->paymentgate['activegate']=$paramset['paymentgate']['activegate'];
        $model->requisites['value']=$paramset['requisites']['value'];
        $model->requisites['active']=$paramset['requisites']['active'];
        $model->recomendedwares['value'] = $paramset['recomendedwares']['value'];

        $categoriess = new PartnersCategories();
        $categoriesd = new PartnersCatDescription();
        // Выбираем все категории массива с ролительскими id
        $start_arr = $categoriess->find()->select(['categories_id', 'parent_id'])->where('categories_status != 0')->asArray()->All();
        // выбираем соответствие id названию категории
        $s = $categoriesd->find()->select(['categories_id', 'categories_name'])->asArray()->All();

        // Берем по очереди каждый элемент массива
        for ($i = 0; $i < count($start_arr); $i++) {
            // Сохраняем его в переменную row
            $row = $start_arr[$i];
            // Если в соответствующей строке нет parent_id
            if (empty($arr_cat[$row['parent_id']])) {
                // создаем ячейку для этого элемента
                $arr_cat[$row['parent_id']] = [];// $row;
            }
            // Делаем переменную row дочерним элементом
            $arr_cat[$row['parent_id']][] = $row;
        }
        // Для каждого элемента в массиве s
        foreach ($s as $value) {
            $catnamearr[$value['categories_id']] = $value['categories_name'];
        }


        return $this->render('index', ['model' => $model, 'arr_cat' => $arr_cat, 'catnamearr' => $catnamearr]);
    }
}