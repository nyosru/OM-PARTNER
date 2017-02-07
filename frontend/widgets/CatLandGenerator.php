<?php

namespace frontend\widgets;
use common\traits\Products\AggregateProductsData;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\Referrals;
use yii\helpers\ArrayHelper;
use common\traits\CatPath;
use common\traits\Categories_for_partner;
use common\traits\RecursCat;
class CatLandGenerator extends \yii\bootstrap\Widget
{
    use CatPath, Categories_for_partner, RecursCat, AggregateProductsData;
    /**
     * @var string
     */
    public $header_tpl = '';
    public $header_config = [];

    /**
     * @var string
     */
    public $content_tpl = '';
    public $content_config = [];
    public $visible_name;
    /**
     * @var string
     */
    public $footer_tpl = '';


    public function init()
    {
        parent::init();
        $default_tpl_file = 'default';

        $scandir_header_tpl = array_diff(scandir(\Yii::getAlias('@partial') . '/cat-landing/header'), ['..', '.']);
        $scandir_content_tpl = array_diff(scandir(\Yii::getAlias('@partial') . '/cat-landing/content'), ['..', '.']);
        $scandir_footer_tpl = array_diff(scandir(\Yii::getAlias('@partial') . '/cat-landing/footer'), ['..', '.']);

        if (empty($this->header_tpl) || $this->header_tpl === null || !in_array($this->header_tpl.'.php',
                $scandir_header_tpl)
        ) {
            $this->header_tpl = $default_tpl_file;
        }
        if (empty($this->content_tpl) || $this->content_tpl === null || !in_array($this->content_tpl.'.php',
                $scandir_content_tpl)
        ) {
            $this->content_tpl = $default_tpl_file;
        }
        if (empty($this->footer_tpl) || $this->footer_tpl === null || !in_array($this->footer_tpl.'.php',
                $scandir_footer_tpl)
        ) {
            $this->footer_tpl = $default_tpl_file;
        }
    }

    public function run()
    {
        echo $this->renderHeader();

        echo $this->renderContent();

        echo $this->renderFooter();
    }

    /**
     * @return string
     */

    public function renderHeader()
    {
        $template = $this->header_config['banner_config']['template'];
        if($template) {
            $data = [
                'custom_path' => '/images/cat/',
                'template'    => $template,
            ];
            foreach ($this->header_config['banner_config']['images'] as $i_key => $image) {
                $data['template']['positions'][$image['position']]['items'][0]['image' ]= $image['img'];
                $data['template']['positions'][$image['position']]['items'][0]['referal' ]= $image['url'];
                $data['template']['positions'][$image['position']]['items'][0]['alttext' ]= $image['desc'];
            }
        } else {
            $data = [];
        }
        return $this->render('@partial/cat-landing/header/' . $this->header_tpl, [
            'banner_config' => $data,
            'header_title'  => ($this->header_config['header_title']) ? $this->header_config['header_title'] : '',
        ]);
    }

    /**
     * @return string
     */
    public function renderContent()
    {
        $products = explode(',', $this->content_config['content_list_products']);
        $prod = PartnersProducts::find()
            ->where(['products.products_id' => $products])
            ->andWhere('products_status = 1')
            ->andWhere('death_reason = ""')
            ->andWhere('products.products_quantity > 0 ')
            ->andWhere('products.products_price != 0')
            ->distinct()->orderBy('products_date_added');
        $data = $this->aggregateProductsData($prod, $cachekey ='productn', $cachetime = 86400);
        return $this->render('@partial/cat-landing/content/' . $this->content_tpl, [
            'content_list_products' => $data,
            'special_offer'         => ($this->content_config['special_offer']) ? $this->content_config['special_offer'] : '',
        ]);
    }

    /**
     * @return string
     */
    public function renderFooter()
    {
        return $this->render('@partial/cat-landing/footer/' . $this->footer_tpl);
    }
}