<?
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



echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">



    <?php

    use Yii;
    use frontend\controllers\ExtFunc;

    $application->layout = false;
    $function = new ExtFunc();
    $urlarr = $function->categories_for_partners()[0];
    foreach($urlarr as $value)
    {
        $url = 'http://'.$_SERVER['HTTP_HOST'].'/site/catalog?_escaped_fragment_=cat='.$value[categories_id].'%26count=20%26start_price=%26end_price=1000000%26prod_attr_query=%26page=undefined%27sort=undefined%26searchword=';
        echo   '<url>';
        echo   '   <loc>'.$url.'</loc>';
        echo   '  <changefreq>hourly</changefreq>';
        echo   ' </url>';
    }
    ?>
</urlset>

