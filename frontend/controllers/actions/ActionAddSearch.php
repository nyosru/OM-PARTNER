<?php
namespace frontend\controllers\actions;

use common\models\PartnersComments;
use common\models\PartnersUsersInfo;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;


trait ActionAddSearch
{
    public function actionAddsearch()
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
                <OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
                    <ShortName>Поиск по товарам</ShortName>
                    <Description>Use Example.com to search the Web.</Description>
                    <Tags>example web</Tags>
                    <Contact>admin@example.com</Contact>
                    <Url type="text/html"
                    template="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/catalog?cat=0&amp;count=20&amp;start_price=&amp;end_price=1000000&amp;prod_attr_query=&amp;page=0&amp;sort=0&amp;searchword={searchTerms}"/>
                    <LongName>Example.com Web Search</LongName>
                    <Image height="64" width="64" type="image/png">http://example.com/websearch.png</Image>
                    <Image height="16" width="16" type="image/vnd.microsoft.icon">http://example.com/websearch.ico</Image>
                    <Query role="example" searchTerms="searchword" />
                    <Developer>Example.com Development Team</Developer>
                    <Attribution>
                        Search data Copyright 2005, Example.com, Inc., All Rights Reserved
                    </Attribution>
                    <SyndicationRight>open</SyndicationRight>
                    <AdultContent>false</AdultContent>
                    <Language>ru-ru</Language>
                    <OutputEncoding>UTF-8</OutputEncoding>
                    <InputEncoding>UTF-8</InputEncoding>
                </OpenSearchDescription>';
    }
}

?>