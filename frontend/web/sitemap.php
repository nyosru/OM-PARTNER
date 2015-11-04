<?
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);
$application = new yii\web\Application($config);

use common\models\Partners;

$partner = Yii::$app->db->cache(
    function ($db) {
        $run = new Partners();
        $check = $run->GetId($_SERVER['HTTP_HOST']);
        if ($check == '') {
            die;
        } else {
            return ['APP_CAT' => $run->GetAllowCat($check), 'APP_NAME' => $run->GetNamePartner($check), 'APP_ID' => $run->GetId($_SERVER['HTTP_HOST']), 'APP_THEMES' => $run->GetTemplate($check)];

        }
    }, 3600
);
$application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
$application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
$application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
$application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


    <?php

    use Yii;
    use common\traits\Categories_for_partner;
    use common\traits\Reformat_cat_array;

    $application->layout = false;

    class LoadTraitIndex
    {
        use Categories_for_partner, Reformat_cat_array;
    }

    $load_traits = new LoadTraitIndex();
    //  $urlarr = $function->categories_for_partners()[0];
    $categoriesarr = $load_traits->categories_for_partners();
    $categories = $categoriesarr[0];
    $catdataw = $categoriesarr[1];
    $checks = Yii::$app->params['constantapp']['APP_CAT'];
    $urlarr = $load_traits->reformat_cat_array($categories, $catdataw, $checks);
    foreach ($urlarr['cat'] as $key => $value) {
        for ($i = 0; $i < 5; $i++) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/site/catalog?_escaped_fragment_=cat=' . $key . '%26count=20%26start_price=%26end_price=1000000%26prod_attr_query=%26page=' . $i . '%26sort=undefined%26searchword=';
            echo '<url>';
            echo '   <loc>' . $url . '</loc>';
            echo '  <changefreq>hourly</changefreq>';
            echo ' </url>';
        }
    }
    ?>
</urlset>

