<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
$param=[
    'height'=>'Рост',
    'size'=>'Размер',
    'size_gr'=>'Обхват груди',
    'size_tl'=>'Обхват талии',
    'size_bed'=>'Обхват бёдер',
    'lenght_front'=>'Длина переда до талии',
    'lenght_back'=>'Длина спины до талии',
    'lenght_arms'=>'Длина руки',
    'age'=>'Возраст'
];
$woman=[
    [
        'num'=>'Модель 0',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/000.jpg',
        'height'=>'174',
        'size'=> '40-42',
        'size_gr'=> 87,
        'size_tl'=> 60,
        'size_bed'=> 87,
        'lenght_front'=> 46,
        'lenght_back'=> 40,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 1',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_002.jpeg',
        'height'=>'163',
        'size'=> '50',
        'size_gr'=> 99,
        'size_tl'=> 81,
        'size_bed'=> 109,
        'lenght_front'=> 44,
        'lenght_back'=> 39,
        'lenght_arms'=> 60
    ],
    [
        'num'=>'Модель 2',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_003.jpeg',
        'height'=>'165',
        'size'=> '40-42',
        'size_gr'=> 75,
        'size_tl'=> 60,
        'size_bed'=> 85,
        'lenght_front'=> 44,
        'lenght_back'=> 41,
        'lenght_arms'=> 55
    ],
    [
        'num'=>'Модель 3',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_004.jpeg',
        'height'=>'167',
        'size'=> '42',
        'size_gr'=> 82,
        'size_tl'=> 65,
        'size_bed'=> 92,
        'lenght_front'=> 40,
        'lenght_back'=> 36,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 4',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/004.jpg',
        'height'=>'162',
        'size'=> '42',
        'size_gr'=> 82,
        'size_tl'=> 59,
        'size_bed'=> 84,
        'lenght_front'=> 44,
        'lenght_back'=> 38,
        'lenght_arms'=> 52
    ],
    [
        'num'=>'Модель 5',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/005.jpg',
        'height'=>'165',
        'size'=> '42-44',
        'size_gr'=> 89,
        'size_tl'=> 62,
        'size_bed'=> 88,
        'lenght_front'=> 42,
        'lenght_back'=> 40,
        'lenght_arms'=> 52
    ],
    [
        'num'=>'Модель 6',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/006.jpg',
        'height'=>'156',
        'size'=> '56-58',
        'size_gr'=> 110,
        'size_tl'=> 98,
        'size_bed'=> 118,
        'lenght_front'=> 47,
        'lenght_back'=> 38,
        'lenght_arms'=> 57
    ],
    [
        'num'=>'Модель 7',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_008.jpeg',
        'height'=>'170',
        'size'=> '40-42',
        'size_gr'=> 78,
        'size_tl'=> 57,
        'size_bed'=> 84,
        'lenght_front'=> 46,
        'lenght_back'=> 42,
        'lenght_arms'=> 55
    ],
    [
        'num'=>'Модель 8',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/008.jpg',
        'height'=>'164',
        'size'=> '42-44',
        'size_gr'=> 84,
        'size_tl'=> 64,
        'size_bed'=> 89,
        'lenght_front'=> 42,
        'lenght_back'=> 40,
        'lenght_arms'=> 56
    ],
    [
        'num'=>'Модель 9',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/009.jpg',
        'height'=>'165',
        'size'=> '46',
        'size_gr'=> 95,
        'size_tl'=> 78,
        'size_bed'=> 99,
        'lenght_front'=> 46,
        'lenght_back'=> 37,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 10',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/010.jpg',
        'height'=>'170',
        'size'=> '44-46',
        'size_gr'=> 86,
        'size_tl'=> 69,
        'size_bed'=> 99,
        'lenght_front'=> 41,
        'lenght_back'=> 40,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 11',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/011.jpg',
        'height'=>'161',
        'size'=> '40-42',
        'size_gr'=> 86,
        'size_tl'=> 64,
        'size_bed'=> 92,
        'lenght_front'=> 36,
        'lenght_back'=> 31,
        'lenght_arms'=> 56
    ],
    [
        'num'=>'Модель 12',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/012.jpg',
        'height'=>'162',
        'size'=> '42',
        'size_gr'=> 85,
        'size_tl'=> 67,
        'size_bed'=> 88,
        'lenght_front'=> 40,
        'lenght_back'=> 37,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 13',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_018.jpeg',
        'height'=>'160',
        'size'=> '56-58',
        'size_gr'=> 121,
        'size_tl'=> 103,
        'size_bed'=> 124,
        'lenght_front'=> 44,
        'lenght_back'=> 40,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 14',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/014.jpg',
        'height'=>'160',
        'size'=> '42-44',
        'size_gr'=> 84,
        'size_tl'=> 64,
        'size_bed'=> 95,
        'lenght_front'=> 40,
        'lenght_back'=> 30,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 15',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_021.jpeg',
        'height'=>'173',
        'size'=> '44-46',
        'size_gr'=> 92,
        'size_tl'=> 69,
        'size_bed'=> 97,
        'lenght_front'=> 43,
        'lenght_back'=> 39,
        'lenght_arms'=> 60
    ],
    [
        'num'=>'Модель 16',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_022.jpeg',
        'height'=>'158',
        'size'=> '42-44',
        'size_gr'=> 85,
        'size_tl'=> 65,
        'size_bed'=> 90,
        'lenght_front'=> 43,
        'lenght_back'=> 41,
        'lenght_arms'=> 54
    ],
    [
        'num'=>'Модель 17',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/017.jpg',
        'height'=>'160',
        'size'=> '42-44',
        'size_gr'=> 85,
        'size_tl'=> 63,
        'size_bed'=> 89,
        'lenght_front'=> 42,
        'lenght_back'=> 34,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 18',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_028.jpeg',
        'height'=>'176',
        'size'=> '42-44',
        'size_gr'=> 85,
        'size_tl'=> 63,
        'size_bed'=> 93,
        'lenght_front'=> 41,
        'lenght_back'=> 37,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 19',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/019.jpg',
        'height'=>'165',
        'size'=> '42-44',
        'size_gr'=> 90,
        'size_tl'=> 71,
        'size_bed'=> 95,
        'lenght_front'=> 40,
        'lenght_back'=> 30,
        'lenght_arms'=> 53
    ],
    [
        'num'=>'Модель 20',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/020.jpg',
        'height'=>'165',
        'size'=> '40-42',
        'size_gr'=> 81,
        'size_tl'=> 62,
        'size_bed'=> 87,
        'lenght_front'=> 41,
        'lenght_back'=> 37,
        'lenght_arms'=> 57
    ],
    [
        'num'=>'Модель 21',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_031.jpeg',
        'height'=>'167',
        'size'=> '42-44',
        'size_gr'=> 83,
        'size_tl'=> 64,
        'size_bed'=> 93,
        'lenght_front'=> 44,
        'lenght_back'=> 37,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 22',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_032.jpeg',
        'height'=>'168',
        'size'=> '46-48',
        'size_gr'=> 96,
        'size_tl'=> 83,
        'size_bed'=> 104,
        'lenght_front'=> 42,
        'lenght_back'=> 35,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 23',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/023.jpg',
        'height'=>'174',
        'size'=> '44-46',
        'size_gr'=> 84,
        'size_tl'=> 69,
        'size_bed'=> 98,
        'lenght_front'=> 42,
        'lenght_back'=> 38,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 24',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/024.jpg',
        'height'=>'162',
        'size'=> '40-42',
        'size_gr'=> 80,
        'size_tl'=> 63,
        'size_bed'=> 94,
        'lenght_front'=> 48,
        'lenght_back'=> 43,
        'lenght_arms'=> 57
    ],
    [
        'num'=>'Модель 25',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/025.jpg',
        'height'=>'172',
        'size'=> '42',
        'size_gr'=> 81,
        'size_tl'=> 67,
        'size_bed'=> 89,
        'lenght_front'=> 46,
        'lenght_back'=> 41,
        'lenght_arms'=> 63
    ],
    [
        'num'=>'Модель 26',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/026.jpg',
        'height'=>'162',
        'size'=> '54-56',
        'size_gr'=> 119,
        'size_tl'=> 104,
        'size_bed'=> 121,
        'lenght_front'=> 53,
        'lenght_back'=> 43,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 27',
        'img'=>'http://odezhda-master.ru/images/catalog_4/55c774f19c120.jpg',
        'height'=>'179',
        'size'=> '46-48',
        'size_gr'=> 93,
        'size_tl'=> 75,
        'size_bed'=> 101,
        'lenght_front'=> 53,
        'lenght_back'=> 49,
        'lenght_arms'=> 61
    ],
    [
        'num'=>'Модель 28',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/028.jpg',
        'height'=>'165',
        'size'=> '52',
        'size_gr'=> 107,
        'size_tl'=> 93,
        'size_bed'=> 111,
        'lenght_front'=> 51,
        'lenght_back'=> 39,
        'lenght_arms'=> 61
    ],
    [
        'num'=>'Модель 29',
        'img'=>'http://odezhda-master.ru/images/mannequin/IMG_2901.JPG',
        'height'=>'162',
        'size'=> '48',
        'size_gr'=> 96,
        'size_tl'=> 76,
        'size_bed'=> 99,
        'lenght_front'=> 47,
        'lenght_back'=> 42,
        'lenght_arms'=> 54
    ],
    [
        'num'=>'Модель 30',
        'img'=>'http://odezhda-master.ru/images/mannequin/IMG_2938.JPG',
        'height'=>'162',
        'size'=> '44-46',
        'size_gr'=> 86,
        'size_tl'=> 68,
        'size_bed'=> 95,
        'lenght_front'=> 46,
        'lenght_back'=> 43,
        'lenght_arms'=> 49
    ],
    [
        'num'=>'Модель 31',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/031.jpg',
        'height'=>'165',
        'size'=> '50',
        'size_gr'=> 94,
        'size_tl'=> 83,
        'size_bed'=> 107,
        'lenght_front'=> 47,
        'lenght_back'=> 37,
        'lenght_arms'=> 55
    ],
    [
        'num'=>'Модель 32',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/032.jpg',
        'height'=>'165',
        'size'=> '44',
        'size_gr'=> 85,
        'size_tl'=> 69,
        'size_bed'=> 96,
        'lenght_front'=> 47,
        'lenght_back'=> 41,
        'lenght_arms'=> 54
    ],
    [
        'num'=>'Модель 33',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/033.jpg',
        'height'=>'173',
        'size'=> '52-54',
        'size_gr'=> 107,
        'size_tl'=> 97,
        'size_bed'=> 114,
        'lenght_front'=> 50,
        'lenght_back'=> 44,
        'lenght_arms'=> 52
    ],
    [
        'num'=>'Модель 34',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/034.jpg',
        'height'=>'165',
        'size'=> '44',
        'size_gr'=> 82,
        'size_tl'=> 66,
        'size_bed'=> 98,
        'lenght_front'=> 46,
        'lenght_back'=> 41,
        'lenght_arms'=> 51
    ],
    [
        'num'=>'Модель 35',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/035.jpg',
        'height'=>'169',
        'size'=> '44',
        'size_gr'=> 81,
        'size_tl'=> 64,
        'size_bed'=> 98,
        'lenght_front'=> 45,
        'lenght_back'=> 37,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 36',
        'img'=>'http://odezhda-master.ru/images/mannequin/f/036.jpg',
        'height'=>'174',
        'size'=> '42',
        'size_gr'=> 77,
        'size_tl'=> 62,
        'size_bed'=> 86,
        'lenght_front'=> 46,
        'lenght_back'=> 42,
        'lenght_arms'=> 57
    ],
];

$man =[
    [
        'num'=>'Модель 0',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_010.jpeg',
        'height'=>'175',
        'size'=> '46-48',
        'size_gr'=> 88,
        'size_tl'=> 83,
        'size_bed'=> 98,
        'lenght_front'=> 48,
        'lenght_back'=> 50,
        'lenght_arms'=> 57
    ],
    [
        'num'=>'Модель 1',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_011.jpeg',
        'height'=>'187',
        'size'=> '46-48',
        'size_gr'=> 105,
        'size_tl'=> 78,
        'size_bed'=> 99,
        'lenght_front'=> 45,
        'lenght_back'=> 42,
        'lenght_arms'=> 60
    ],
    [
        'num'=>'Модель 2',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_013.jpeg',
        'height'=>'198',
        'size'=> '50-52',
        'size_gr'=> 113,
        'size_tl'=> 102,
        'size_bed'=> 117,
        'lenght_front'=> 48,
        'lenght_back'=> 50,
        'lenght_arms'=> 64
    ],
    [
        'num'=>'Модель 3',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_015.jpeg',
        'height'=>'185',
        'size'=> '46-48',
        'size_gr'=> 99,
        'size_tl'=> 83,
        'size_bed'=> 101,
        'lenght_front'=> 66,
        'lenght_back'=> 50,
        'lenght_arms'=> 46
    ],
    [
        'num'=>'Модель 4',
        'img'=>'http://odezhda-master.ru/images/mannequin/m/005.jpg',
        'height'=>'178',
        'size'=> '48',
        'size_gr'=> 94,
        'size_tl'=> 84,
        'size_bed'=> 98,
        'lenght_front'=> 52,
        'lenght_back'=> 43,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 5',
        'img'=>'http://odezhda-master.ru/images/mannequin/m/006.jpg',
        'height'=>'182',
        'size'=> '48',
        'size_gr'=> 93,
        'size_tl'=> 81,
        'size_bed'=> 98,
        'lenght_front'=> 51,
        'lenght_back'=> 49,
        'lenght_arms'=> 58
    ],
    [
        'num'=>'Модель 6',
        'img'=>'http://odezhda-master.ru/images/mannequin/m/007.jpg',
        'height'=>'175',
        'size'=> '48',
        'size_gr'=> 96,
        'size_tl'=> 85,
        'size_bed'=> 100,
        'lenght_front'=> 52,
        'lenght_back'=> 47,
        'lenght_arms'=> 59
    ],
    [
        'num'=>'Модель 7',
        'img'=>'http://odezhda-master.ru/images/mannequin/m/008.jpg',
        'height'=>'179',
        'size'=> '48',
        'size_gr'=> 101,
        'size_tl'=> 83,
        'size_bed'=> 101,
        'lenght_front'=> 47,
        'lenght_back'=> 40,
        'lenght_arms'=> 58
    ],
];

$kids = [
    [
        'num'=>'Модель 0',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_019.jpeg',
        'height'=>'150',
        'age'=> '5 лет',
        'size_gr'=> 65,
        'size_tl'=> 60,
        'size_bed'=> 78,
        'lenght_front'=> 34,
        'lenght_back'=> 35,
        'lenght_arms'=> 48
    ],
    [
        'num'=>'Модель 1',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_024.jpeg',
        'height'=>'109',
        'age'=> '5 лет',
        'size_gr'=> 53,
        'size_tl'=> 49,
        'size_bed'=> 58,
        'lenght_front'=> 30,
        'lenght_back'=> 30,
        'lenght_arms'=> 30
    ],
    [
        'num'=>'Модель 2',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_025.jpeg',
        'height'=>'123',
        'age'=> '7 лет',
        'size_gr'=> 65,
        'size_tl'=> 56,
        'size_bed'=> 68,
        'lenght_front'=> 37,
        'lenght_back'=> 37,
        'lenght_arms'=> 44
    ],
    [
        'num'=>'Модель 3',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_026.jpeg',
        'height'=>'140',
        'age'=> '9 лет',
        'size_gr'=> 64,
        'size_tl'=> 59,
        'size_bed'=> 75,
        'lenght_front'=> 32,
        'lenght_back'=> 32,
        'lenght_arms'=> 44
    ],
    [
        'num'=>'Модель 4',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_027.jpeg',
        'height'=>'150',
        'size'=> '38-40',
        'size_gr'=> 69,
        'size_tl'=> 62,
        'size_bed'=> 77,
        'lenght_front'=> 35,
        'lenght_back'=> 35,
        'lenght_arms'=> 52
    ],
    [
        'num'=>'Модель 5',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_035.jpeg',
        'height'=>'162',
        'size'=> '40-42',
        'size_gr'=> 79,
        'size_tl'=> 66,
        'size_bed'=> 90,
        'lenght_front'=> 44,
        'lenght_back'=> 44,
        'lenght_arms'=> 55
    ],
    [
        'num'=>'Модель 6',
        'img'=>'http://odezhda-master.ru/images/catalog/model_m_036.jpeg',
        'height'=>'147',
        'size'=> '38-40',
        'size_gr'=> 63,
        'size_tl'=> 53,
        'size_bed'=> 70,
        'lenght_front'=> 40,
        'lenght_back'=> 40,
        'lenght_arms'=> 47
    ],
    [
        'num'=>'Модель 7',
        'img'=>'http://odezhda-master.ru/images/catalog/model_f_037.jpeg',
        'height'=>'129',
        'size'=> '36',
        'size_gr'=> 68,
        'size_tl'=> 60,
        'size_bed'=> 73,
        'lenght_front'=> 33,
        'lenght_back'=> 33,
        'lenght_arms'=> 45
    ],
];

$renderwoman = '';
foreach($woman as $key=>$value){
    $renderwoman .=
        '<div style="width: calc(100% / 3 - 20px); float: left; margin: 10px;">'.
        '<div style="float: left; width: 50%; height: 400px;">'.
        '<div style="background: transparent url('.$value['img'].') no-repeat scroll 0% 0% / contain ; min-height: auto; height: 340px;"></div>'.
        '</div>'.
        '<div>';
    unset($value['img']);
    foreach($value as $keyparam=>$valueparam) {
        $renderwoman .=     '<div style="padding: 0px 10px; font-size: 13px; font-weight: 400;">' . $param[$keyparam] . '</div>' . '<div style="padding: 0px 10px; font-size: 13px; font-weight: 300;">' . $valueparam . '</div>';
    }
    $renderwoman .='</div>'.
        '</div>';
}
$renderman = '';
foreach($man as $key=>$value){
    $renderman .=
        '<div style="width: calc(100% / 3 - 20px); float: left; margin: 10px;">'.
        '<div style="float: left; width: 50%; height: 400px;">'.
        '<div style="background: transparent url('.$value['img'].') no-repeat scroll 0% 0% / contain ; min-height: auto; height: 340px;"></div>'.
        '</div>'.
        '<div>';
    unset($value['img']);
    foreach($value as $keyparam=>$valueparam) {
        $renderman .=     '<div style="padding: 0px 10px; font-size: 13px; font-weight: 400;">' . $param[$keyparam] . '</div>' . '<div style="padding: 0px 10px; font-size: 13px; font-weight: 300;">' . $valueparam . '</div>';
    }
    $renderman .='</div>'.
        '</div>';
}


$renderkids = '';
foreach($kids as $key=>$value){
    $renderkids .=
        '<div style="width: calc(100% / 3 - 20px); float: left; margin: 10px;">'.
        '<div style="float: left; width: 50%; height: 400px;">'.
        '<div style="background: transparent url('.$value['img'].') no-repeat scroll 0% 0% / contain ; min-height: auto; height: 340px;"></div>'.
        '</div>'.
        '<div>';
    unset($value['img']);
    foreach($value as $keyparam=>$valueparam) {
        $renderkids .=     '<div style="padding: 0px 10px; font-size: 13px; font-weight: 400;">' . $param[$keyparam] . '</div>' . '<div style="padding: 0px 10px; font-size: 13px; font-weight: 300;">' . $valueparam . '</div>';
    }
    $renderkids .='</div>'.
        '</div>';
}
echo \yii\bootstrap\Tabs::widget([
    'options'=>['style'=>'float: left; width: 100%;'],
    'items' => [
        [
            'label' => 'Женщины',
            'content' => $renderwoman,
            'active' => true
        ],
        [
            'label' => 'Мужчины',
            'content' => $renderman,

        ],
        [
            'label' => 'Дети',
            'content' => $renderkids,

        ]

    ]]); ?>


