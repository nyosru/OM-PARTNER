<?php
namespace common\traits\Products;

class ProductsTableSizes
{
    const SPECIFICATION_VALUES_ID_ADIDAS = 15806;
    const SPECIFICATION_VALUES_ID_NIKE = 15807;
    const SPECIFICATION_VALUES_ID_REEBOK = 15841;
    const SPECIFICATION_VALUES_ID_ASICS = 15850;
    const SPECIFICATION_VALUES_ID_ONITSUKA = 15844;
    const ARTICLE_ID_FOOT_WEAR_NIKE_FOR_MEN = 65;
    const ARTICLE_ID_FOOT_WEAR_NIKE_FOR_WOMEN = 66;
    const ARTICLE_ID_FOOT_WEAR_NIKE_FOR_KIDS = 67;
    const ARTICLE_ID_FOOT_WEAR_REEBOK_FOR_WOMEN = 61;
    const ARTICLE_ID_FOOT_WEAR_REEBOK_FOR_MEN = 62;
    const ARTICLE_ID_FOOT_WEAR_ADIDAS_FOR_MEN = 63;
    const ARTICLE_ID_FOOT_WEAR_ADIDAS_FOR_WOMEN = 64;
    const ARTICLE_ID_FOOT_WEAR_ASICS_FOR_MEN = 57;
    const ARTICLE_ID_FOOT_WEAR_ASICS_FOR_WOMEN = 58;
    const ARTICLE_ID_FOOT_WEAR_ASICS_FOR_KIDS = 59;
    const ARTICLE_ID_FOOT_WEAR_ASICS_FOR_ALL = 60;
    const UNIVERSAL_SEX_KEY_NAME = 'унисекс';

    public static function config()
    {
        return [
            1984 => [ # женская обувь -> кросовки
                self::SPECIFICATION_VALUES_ID_ADIDAS => self::ARTICLE_ID_FOOT_WEAR_ADIDAS_FOR_WOMEN,
                self::SPECIFICATION_VALUES_ID_REEBOK => self::ARTICLE_ID_FOOT_WEAR_REEBOK_FOR_WOMEN,
                self::SPECIFICATION_VALUES_ID_ONITSUKA => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_WOMEN,
                self::SPECIFICATION_VALUES_ID_ASICS => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_WOMEN,
                self::SPECIFICATION_VALUES_ID_NIKE => self::ARTICLE_ID_FOOT_WEAR_NIKE_FOR_WOMEN,
            ],
            1999 => [ # мужская обувь -> кросовки
                self::SPECIFICATION_VALUES_ID_ADIDAS => self::ARTICLE_ID_FOOT_WEAR_ADIDAS_FOR_MEN,
                self::SPECIFICATION_VALUES_ID_REEBOK => self::ARTICLE_ID_FOOT_WEAR_REEBOK_FOR_MEN,
                self::SPECIFICATION_VALUES_ID_ONITSUKA => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_MEN,
                self::SPECIFICATION_VALUES_ID_ASICS => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_MEN,
                self::SPECIFICATION_VALUES_ID_NIKE => self::ARTICLE_ID_FOOT_WEAR_NIKE_FOR_MEN,
            ],
            2015 => [ # детская обувь -> кросовки
                self::SPECIFICATION_VALUES_ID_ONITSUKA => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_KIDS,
                self::SPECIFICATION_VALUES_ID_ASICS => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_KIDS,
                self::SPECIFICATION_VALUES_ID_NIKE => self::ARTICLE_ID_FOOT_WEAR_NIKE_FOR_KIDS,
            ],
            self::UNIVERSAL_SEX_KEY_NAME => [ # унисекс обувь
                self::SPECIFICATION_VALUES_ID_ONITSUKA => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_ALL,
                self::SPECIFICATION_VALUES_ID_ASICS => self::ARTICLE_ID_FOOT_WEAR_ASICS_FOR_ALL,
            ],
        ];
    }

    public static function go($products_name, $category, $brand)
    {
        if (false !== mb_strpos($products_name, self::UNIVERSAL_SEX_KEY_NAME)) {
            $categoryID = self::UNIVERSAL_SEX_KEY_NAME;
        } else {
            $categoryID = $category;
        }
        $articleID = static::getArticleIDByCategoryAndBrand($categoryID,$brand);
        if (empty($articleID)) {
            return '';
        }
        return '<a style="float: left; position: absolute; bottom: 2px; left: 12px; font-size: 12px; font-weight: 500;" href="http://odezhda-master.ru/article_info.php?articles_id=' . $articleID . '" target="blank">Таблица размеров</a>';
    }

    public static function getArticleIDByCategoryAndBrand($categoryID, $brandID)
    {
        return isset($brandID, static::config()[$categoryID], static::config()[$categoryID][$brandID]) ? static::config()[$categoryID][$brandID] : null;
    }
}

?>