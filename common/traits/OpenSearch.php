<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 14.01.16
 * Time: 12:44
 */

namespace common\traits;


trait OpenSearch
{
    public function OpenSearchConstruct()
    {
        return '<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
                    <ShortName>crackfor.me</ShortName>
                    <Contact>service@crackfor.me</Contact>
                    <Image height="16" width="16" type="image/vnd.microsoft.icon">crackfor.me/i/favicon.ico</Image>
                    <InputEncoding>utf-8</InputEncoding>
                    <Url type="text/html" method="POST" template="http://crackfor.me/">
                        <Param name="hash" value="{searchTerms}"/>
                        <Param name="act" value="find"/>
                    </Url>
                </OpenSearchDescription>';
    }

    public function OpenSearchData()
    {

    }

    public function OpenSearchAutoInsert()
    {

    }
}