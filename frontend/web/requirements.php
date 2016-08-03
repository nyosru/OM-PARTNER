<?php
class RequirementChecker
{
    public $result;
    function check($requirements)
    {
        if (is_string($requirements)) {
            $requirements = require($requirements);
        }
        if (!is_array($requirements)) {
            $this->usageError('Requirements must be an array, "' . gettype($requirements) . '" has been given!');
        }
        if (!isset($this->result) || !is_array($this->result)) {
            $this->result = array(
                'summary' => array(
                    'total' => 0,
                    'errors' => 0,
                    'warnings' => 0,
                ),
                'requirements' => array(),
            );
        }
        foreach ($requirements as $key => $rawRequirement) {
            $requirement = $this->normalizeRequirement($rawRequirement, $key);
            $this->result['summary']['total']++;
            if (!$requirement['condition']) {
                if ($requirement['mandatory']) {
                    $requirement['error'] = true;
                    $requirement['warning'] = true;
                    $this->result['summary']['errors']++;
                } else {
                    $requirement['error'] = false;
                    $requirement['warning'] = true;
                    $this->result['summary']['warnings']++;
                }
            } else {
                $requirement['error'] = false;
                $requirement['warning'] = false;
            }
            $this->result['requirements'][] = $requirement;
        }

        return $this;
    }

    function getResult()
    {
        if (isset($this->result)) {
            return $this->result;
        } else {
            return null;
        }
    }

    function render()
    {
        if (!isset($this->result)) {
            $this->usageError('Nothing to render!');
        }
        $summary = $this->result['summary'];
        $requirements =  $this->result['requirements'];
        $result = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Проверка конфигурации сервера</title>
    <style type="text/css">
        *{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
        :before,:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}
        html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0)}
        body{margin:0;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}
        header,main,footer{display:block}
        a{background-color:transparent;color:#337ab7;text-decoration:none}
        a:hover,a:focus{color:#23527c;text-decoration:underline}
        a:focus{outline:thin dotted;outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}
        a:active,a:hover{outline:0}
        abbr[title]{border-bottom:1px dotted}
        abbr[title],abbr[data-original-title]{cursor:help;border-bottom:1px dotted #777}
        strong{font-weight:700}
        h1{font-size:36px;margin:.67em 0}
        h3{font-size:24px}
        h1,h3{font-family:inherit;font-weight:500;line-height:1.1;color:inherit}
        h1,h3{margin-top:20px;margin-bottom:10px}
        hr{box-sizing:content-box;height:0;margin-top:20px;margin-bottom:20px;border:0;border-top:1px solid #eee}
        code{font-family:Menlo,Monaco,Consolas,"Courier New",monospace;padding:2px 4px;font-size:90%;color:#c7254e;background-color:#f9f2f4;border-radius:4px}
        table{border-collapse:collapse;border-spacing:0}
        td,th{padding:0}
        p{margin:0 0 10px}
        .container{margin-right:auto;margin-left:auto;padding-left:15px;padding-right:15px}
        table{background-color:transparent}
        th{text-align:left}
        .table{width:100%;max-width:100%;margin-bottom:20px}
        .table>tbody>tr>th,.table>tbody>tr>td{padding:8px;line-height:1.42857143;vertical-align:top;border-top:1px solid #ddd}
        .table>tr>th{vertical-align:bottom;border-bottom:2px solid #ddd}
        .table>tr:first-child>th,.table>tr:first-child>td{border-top:0}
        .table>tbody+tbody{border-top:2px solid #ddd}
        .table .table{background-color:#fff}
        .table-bordered{border:1px solid #ddd}
        .table-bordered>tbody>tr>th,.table-bordered>tbody>tr>td{border:1px solid #ddd}
        .table-bordered>tr>th,.table-bordered>tr>td{border-bottom-width:2px}
        table td[class*=col-],table th[class*=col-]{position:static;float:none;display:table-cell}
        .table tr>td.active,.table tr>th.active,.table tr.active>td,.table tr.active>th{background-color:#f5f5f5;border-color:#e8e8e8}
        .table tr>td.success,.table tr>th.success,.table tr.success>td,.table tr.success>th{background-color:#dff0d8;border-color:#d6e9c6}
        .table tr>td.info,.table tr>th.info,.table tr.info>td,.table tr.info>th{background-color:#d9edf7;border-color:#c4ebf3}
        .table tr>td.warning,.table tr>th.warning,.table tr.warning>td,.table tr.warning>th{background-color:#fcf8e3;border-color:#faebcc}
        .table tr>td.danger,.table tr>th.danger,.table tr.danger>td,.table tr.danger>th{background-color:#f2dede;border-color:#ebccd1}
        .alert{padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px}
        .alert>p{margin-bottom:0}.alert>p+p{margin-top:5px}
        .alert-success{background-color:#dff0d8;border-color:#d6e9c6;color:#3c763d}
        .alert-info{background-color:#d9edf7;border-color:#bce8f1;color:#31708f}
        .alert-warning{background-color:#fcf8e3;border-color:#faebcc;color:#8a6d3b}
        .alert-danger{background-color:#f2dede;border-color:#ebccd1;color:#a94442}
        @media (min-width:768px){.container{width:750px}}
        @media (min-width:992px){.container{width:970px}}
        @media (min-width:1200px){.container{width:1170px}}
        @media print{
            *,:before,:after{background:transparent!important;color:#000!important;box-shadow:none!important;text-shadow:none!important}
            a,a:visited{text-decoration:underline}
            a[href]:after{content:" (" attr(href) ")"}
            abbr[title]:after{content:" (" attr(title) ")"}
            a[href^="#"]:after,a[href^="javascript:"]:after{content:""}
            tr{page-break-inside:avoid}
            p,h3{orphans:3;widows:3}
            h3{page-break-after:avoid}
            .table{border-collapse:collapse!important}
            .table td,.table th{background-color:#fff!important}
            .table-bordered th,.table-bordered td{border:1px solid #ddd!important}
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Проверка конфигурации сервера</h1>
    </header>'.
    $this->getServerInfo() . '/ '.PHP_VERSION
    .'<hr>
    <main>';
        if ($summary['errors'] > 0) {
            $result.=   '<div class="alert alert-danger" > <strong >Конфигурация сервера не соответствует рекомендуемой</strong > </div >';
        }elseif ($summary['warnings'] > 0){
            $result.=    '<div class="alert alert-info">  <strong>Конфигурация сервера соответствует, минимальным. Есть рекомендации по улучшению производительности</strong>  </div>';
        }else{
            $result.= '<div class="alert alert-success" >  <strong >Конфигурация сервера соответствует, минимальным. Рекомендаций к улучшению нет</strong >  </div >';
        }
$result.= '
        <table class="table table-bordered">
            <tr><th>Конфигурация</th><th>Результат</th><th>Требуется для</th><th>Доп инфо</th></tr>';
            foreach ($requirements as $requirement){
               $class =  $requirement['condition'] ? "success" : ($requirement["mandatory"] ? "danger" : "warning") ;
                $classreq =  $requirement['condition'] ? 'Passed' : ($requirement['mandatory'] ? 'Failed' : 'Warning');
                $result .= '<tr class="'. $class .'">
                    <td>'. $requirement['name'] .' </td>
                    <td><span class="result">'. $classreq.'</span>  </td>
                    <td>   '.$requirement['by'].' </td>
                    <td>    '.$requirement['memo'].'</td>
                    </tr>';
            }
$result .='
        </table>
    </main>
    <hr>
    <footer>
    
    </footer>
</div>
</body>
</html>';
return $result;

}

    function checkPhpExtensionVersion($extensionName, $version, $compare = '>=')
    {
        if (!extension_loaded($extensionName)) {
            return false;
        }
        $extensionVersion = phpversion($extensionName);
        if (empty($extensionVersion)) {
            return false;
        }
        if (strncasecmp($extensionVersion, 'PECL-', 5) === 0) {
            $extensionVersion = substr($extensionVersion, 5);
        }

        return version_compare($extensionVersion, $version, $compare);
    }

    function checkPhpIniOn($name)
    {
        $value = ini_get($name);
        if (empty($value)) {
            return false;
        }

        return ((int) $value === 1 || strtolower($value) === 'on');
    }

    function checkPhpIniOff($name)
    {
        $value = ini_get($name);
        if (empty($value)) {
            return true;
        }

        return (strtolower($value) === 'off');
    }

    function compareByteSize($a, $b, $compare = '>=')
    {
        $compareExpression = '(' . $this->getByteSize($a) . $compare . $this->getByteSize($b) . ')';

        return $this->evaluateExpression($compareExpression);
    }

    function getByteSize($verboseSize)
    {
        if (empty($verboseSize)) {
            return 0;
        }
        if (is_numeric($verboseSize)) {
            return (int) $verboseSize;
        }
        $sizeUnit = trim($verboseSize, '0123456789');
        $size = str_replace($sizeUnit, '', $verboseSize);
        $size = trim($size);
        if (!is_numeric($size)) {
            return 0;
        }
        switch (strtolower($sizeUnit)) {
            case 'kb':
            case 'k':
                return $size * 1024;
            case 'mb':
            case 'm':
                return $size * 1024 * 1024;
            case 'gb':
            case 'g':
                return $size * 1024 * 1024 * 1024;
            default:
                return 0;
        }
    }

    function checkUploadMaxFileSize($min = null, $max = null)
    {
        $postMaxSize = ini_get('post_max_size');
        $uploadMaxFileSize = ini_get('upload_max_filesize');
        if ($min !== null) {
            $minCheckResult = $this->compareByteSize($postMaxSize, $min, '>=') && $this->compareByteSize($uploadMaxFileSize, $min, '>=');
        } else {
            $minCheckResult = true;
        }
        if ($max !== null) {
            $maxCheckResult = $this->compareByteSize($postMaxSize, $max, '<=') && $this->compareByteSize($uploadMaxFileSize, $max, '<=');
        } else {
            $maxCheckResult = true;
        }

        return ($minCheckResult && $maxCheckResult);
    }


    function normalizeRequirement($requirement, $requirementKey = 0)
    {
        if (!is_array($requirement)) {
            $this->usageError('Requirement must be an array!');
        }
        if (!array_key_exists('condition', $requirement)) {
            $this->usageError("Requirement '{$requirementKey}' has no condition!");
        } else {
            $evalPrefix = 'eval:';
            if (is_string($requirement['condition']) && strpos($requirement['condition'], $evalPrefix) === 0) {
                $expression = substr($requirement['condition'], strlen($evalPrefix));
                $requirement['condition'] = $this->evaluateExpression($expression);
            }
        }
        if (!array_key_exists('name', $requirement)) {
            $requirement['name'] = is_numeric($requirementKey) ? 'Requirement #' . $requirementKey : $requirementKey;
        }
        if (!array_key_exists('mandatory', $requirement)) {
            if (array_key_exists('required', $requirement)) {
                $requirement['mandatory'] = $requirement['required'];
            } else {
                $requirement['mandatory'] = false;
            }
        }
        if (!array_key_exists('by', $requirement)) {
            $requirement['by'] = 'Unknown';
        }
        if (!array_key_exists('memo', $requirement)) {
            $requirement['memo'] = '';
        }

        return $requirement;
    }

    function usageError($message)
    {
        echo "Error: $message\n\n";
        exit(1);
    }

    function evaluateExpression($expression)
    {
        return eval('return ' . $expression . ';');
    }

    function getServerInfo()
    {
        $info = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';

        return $info;
    }

    /**
     * Returns the now date if possible in string representation.
     * @return string now date.
     */
    function getNowDate()
    {
        $nowDate = @strftime('%Y-%m-%d %H:%M', time());

        return $nowDate;
    }
}

$requirementsChecker = new RequirementChecker();
if (version_compare(PHP_VERSION, '7.0', '<')) {
    echo 'At least PHP 7.0 is required to run this script!';
    exit(1);
}

$gdMemo = $imagickMemo = 'Either GD PHP extension with FreeType support or ImageMagick PHP extension with PNG support is required for image CAPTCHA.';
$gdOK = $imagickOK = false;

if (extension_loaded('imagick')) {
    $imagick = new Imagick();
    $imagickFormats = $imagick->queryFormats('PNG');
    if (in_array('PNG', $imagickFormats)) {
        $imagickOK = true;
    } else {
        $imagickMemo = 'Imagick extension should be installed with PNG support in order to be used for image CAPTCHA.';
    }
}
if (function_exists('simplexml_load_file')) {
    $SimpleXMLOK = true;
    $SimpleXMLMemo = "Required for correct work with templates";
}else{
    $SimpleXMLMemo = 'SimpleXML extension should be installed';
}

if (extension_loaded('gd')) {
    $gdInfo = gd_info();
    if (!empty($gdInfo['FreeType Support'])) {
        $gdOK = true;
    } else {
        $gdMemo = 'GD extension should be installed with FreeType support in order to be used for image CAPTCHA.';
    }
}
$ini = ini_get_all();
$requirements = array(
    array(
        'name' => 'PHP version',
        'mandatory' => true,
        'condition' => version_compare(PHP_VERSION, '7.0.0', '>='),
        'by' => 'OM-PARTNER',
        'memo' => 'PHP 7.0.0 or higher is required.',
    ),
    array(
        'name' => 'Reflection extension',
        'mandatory' => true,
        'condition' => class_exists('Reflection', false),
        'by' => 'OM-PARTNER',
    ),
    array(
        'name' => 'PCRE extension',
        'mandatory' => true,
        'condition' => extension_loaded('pcre'),
        'by' => 'OM-PARTNER',
    ),
    array(
        'name' => 'SPL extension',
        'mandatory' => true,
        'condition' => extension_loaded('SPL'),
        'by' => 'OM-PARTNER',
    ),
    array(
        'name' => 'Ctype extension',
        'mandatory' => true,
        'condition' => extension_loaded('ctype'),
        'by' => 'OM-PARTNER'
    ),
    array(
        'name' => 'MBString extension',
        'mandatory' => true,
        'condition' => extension_loaded('mbstring'),
        'by' => 'OM-PARTNER',
        'memo' => 'Required for multibyte encoding string processing.'
    ),
    array(
        'name' => 'OpenSSL extension',
        'mandatory' => false,
        'condition' => extension_loaded('openssl'),
        'by' => 'OM-PARTNER',
        'memo' => 'Required by encrypt and decrypt methods.'
    ),
    array(
        'name' => 'Fileinfo extension',
        'mandatory' => false,
        'condition' => extension_loaded('fileinfo'),
        'by' => 'OM-PARTNER',
        'memo' => 'Required for files upload to detect correct file mime-types.'
    ),
    array(
        'name' => 'DOM extension',
        'mandatory' => false,
        'condition' => extension_loaded('dom'),
        'by' => 'OM-PARTNER',
        'memo' => 'Required for REST API to send XML responses via <code>yii\web\XmlResponseFormatter</code>.'
    ),
    array(
        'name' => 'PDO extension',
        'mandatory' => true,
        'condition' => extension_loaded('pdo'),
        'by' => 'OM-PARTNER',
    ),
    array(
        'name' => 'PDO MySQL extension',
        'mandatory' => false,
        'condition' => extension_loaded('pdo_mysql'),
        'by' => 'OM-PARTNER',
        'memo' => 'Required for MySQL database.',
    ),
    array(
        'name' => 'APC extension',
        'mandatory' => false,
        'condition' => extension_loaded('apc'),
        'by' => 'OM-PARTNER',
    ),
    // CAPTCHA:
    array(
        'name' => 'GD PHP extension with FreeType support',
        'mandatory' => false,
        'condition' => $gdOK,
        'by' => 'OM-PARTNER',
        'memo' => $gdMemo,
    ),
    array(
        'name' => 'ImageMagick PHP extension with PNG support',
        'mandatory' => false,
        'condition' => $imagickOK,
        'by' => 'OM-PARTNER',
        'memo' => $imagickMemo,
    ),
    array(
        'name' => 'SimpleXML PHP extension',
        'mandatory' => true,
        'condition' => $SimpleXMLOK,
        'by' => 'OM-PARTNER',
        'memo' => $SimpleXMLMemo,
    ),
    'phpSmtp' => array(
        'name' => 'PHP mail SMTP',
        'mandatory' => false,
        'condition' => strlen(ini_get('SMTP')) > 0,
        'by' => 'OM-PARTNER',
        'memo' => 'PHP mail SMTP server required',
    ),
    'phpExposePhp' => array(
        'name' => 'expose_php',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff("expose_php"),
        'by' => 'OM-PARTNER',
        'memo' => '"expose_php" should be disabled at php.ini',
    ),
    'phpMaxInputsVars' => array(
        'name' => 'max_input_vars',
        'mandatory' => true,
        'condition' => ($ini["max_input_vars"]['local_value'] >= 3500),
        'by' => 'OM-PARTNER',
        'memo' => '"max_input_vars" min 3500 ('. $ini["max_input_vars"]['local_value'].')',
    ),
    'phpPostMAxSize' => array(
        'name' => 'post_max_size',
        'mandatory' => true,
        'condition' => ($requirementsChecker->compareByteSize($ini["post_max_size"]['local_value'], '16M', '==') ),
        'by' => 'OM-PARTNER',
        'memo' => '"post_max_size" min 16M ('. $ini["post_max_size"]['local_value'].")",
    ),
    'phpMailExtraForceParams' => array(
        'name' => 'mail.force_extra_parameters',
        'mandatory' => true,
        'condition' => key_exists('local_value',$ini["mail.force_extra_parameters"]),
        'by' => 'OM-PARTNER',
        'memo' => '"mail.force_extra_parameters" must be enable' ,
    ),
    'phpAllowUrlInclude' => array(
        'name' => 'allow_url_include',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff("allow_url_include"),
        'by' => 'OM-PARTNER',
        'memo' => '"allow_url_include" should be disabled at php.ini',
    ),
    'phpApcEnabled' => array(
        'name' => 'apc.enabled',
        'mandatory' => true,
        'condition' => $requirementsChecker->checkPhpIniOn("apc.enabled"),
        'by' => 'OM-PARTNER',
        'memo' => '"apc.enabled" should be enebled at php.ini',
    ),
    'apc.entries_hint' => array(
        'name' => 'apc.entries_hint',
        'mandatory' => false,
        'condition' => ($ini["apc.entries_hint"]['local_value'] >= 650000),
        'by' => 'OM-PARTNER',
        'memo' => '"apc.entries_hint" must be set > 650000',
    ),
    'apc.shm_size' => array(
        'name' => 'apc.shm_size',
        'mandatory' => false,
        'condition' => ($requirementsChecker->compareByteSize($ini["apc.shm_size"]['local_value'], '2G', '==') ),
        'by' => 'OM-PARTNER',
        'memo' => '"apc.shm_size" must be set to 2G ',
    ),


);


 echo $requirementsChecker->check($requirements)->render();



