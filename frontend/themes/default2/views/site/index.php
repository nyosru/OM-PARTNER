<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use common\models\Partners;
use yii\helpers\BaseUrl;

use yii\jui\Slider;

?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $check = Yii::$app->params[constantapp]['APP_ID'];
                $checks = Yii::$app->params[constantapp]['APP_CAT'];
                $this -> title = Yii::$app->params[constantapp]['APP_NAME'];
                foreach ($catdata as $value) {
                    if (in_array(intval($value['categories_id']), $checks)) {
                        $catdataallow[] = $value;
                    }
                }
                for ($i = 0; $i < count($catdataallow); $i++) {
                    $row = $catdataallow[$i];
                    if (empty($arr_cat[$row['parent_id']])) {
                        $arr_cat[$row['parent_id']] = $row;
                    }
                    $arr_cat[$row['parent_id']][] = $row;
                }
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
                    if (empty($arr[$parent_id])) {
                        return;
                    } else {
                        if ($parent_id !== 0) {$style = 'style="display: none;"';
                        }
                        echo '<ul id="accordion" class="accordion" ' . $style . '">';
                        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                            $catdesc = $arr[$parent_id][$i]['categories_id'];
                            if (!$arr[$parent_id][$i] == '') {
                                echo '<li class=""><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
                                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                }
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
                view_cat($arr_cat, 0, $catnamearr, $check);
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">
<? if(true){?>
           <div id="main-index">
               <div id="index-card-5" class="data-j index-card" data-cat="1720"><a href="/site/catalog#!cat=1720.452.1721.1722.1723.1724.1725.1726.1727&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/7.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2008"><a href="/site/catalog#!cat=2008.2009.2010.2011.2013.2014.2015.2016.2017.2018.2019.2020.2021.2022&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/1.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2047"><a href="/site/catalog#!cat=2047.835.1112.1163&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/2.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="1762"><a href="/site/catalog#!cat=1762.1649.1763.1764.1765.1766.1767.1768.1769.1770&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/5.jpg"></a></div>
               <div id="index-card-3" class="sort data-j index-sort" data="10"><a href="/site/catalog#!cat=932.938.939.940.1113.1275.1310.1313.1424.1576.1622.938.939.940.1113.1275.1310.1313.1424.1576.1622.1350.1693.1468.1698.1708.1717.1718.1719.1863.1694.1469.1867.1876.1877.1878.1695.1884.1885.1886.1887.1888.1696.1564.1608.1889.1890.1892.1697.1463.1479.1864.1865.1874.1704.1462.1474.1475.1476.1705.1467.1477.1478.1611.1706.1466.1882.1883.1707.1473.1894.1895.1897.1898.1899.1709.1490.1710.1472.1893.1711.1470.1480.1868.1869.1712.1875.1963.1964.1965.1966.1713.1489.1902.1714.1870.1871.1872.1873.1715.1716.1693.1468.1698.1708.1717.1718.1719.1863.1468.1698.1708.1717.1718.1719.1863.1694.1469.1867.1876.1877.1878.1469.1867.1876.1877.1878.1695.1884.1885.1886.1887.1888.1884.1885.1886.1887.1888.1696.1564.1608.1889.1890.1892.1564.1608.1889.1890.1892.1697.1463.1479.1864.1865.1874.1463.1479.1864.1865.1874.1704.1462.1474.1475.1476.1462.1474.1475.1476.1705.1467.1477.1478.1611.1467.1477.1478.1611.1706.1466.1882.1883.1466.1882.1883.1707.1473.1894.1895.1897.1898.1899.1473.1894.1895.1897.1898.1899.1709.1490.1490.1710.1472.1893.1472.1893.1711.1470.1480.1868.1869.1470.1480.1868.1869.1712.1875.1963.1964.1965.1966.1875.1963.1964.1965.1966.1713.1489.1902.1489.1902.1714.1870.1871.1872.1873.1870.1871.1872.1873.1715.1716.1397.1398.1400.1403.1405.1410.1398.1400.1403.1405.1410.1544.1543.1545.1566.1543.1545.1566.1549.998.999.1302.1347.1447.1553.1554.1555.1556.1557.998.999.1302.1347.1447.1553.1554.1555.1556.1557.1626.1627.1628.1629.1627.1628.1629.1632.1641.765.992.993.1565.1615.1720.452.1721.1722.1723.1724.1725.1726.1727.1728.1729.1730.1731.1732.1733.1734.1735.1736.1737.1738.1739.1740.1741.1742.1743.1744.1821.1746.1747.1748.1749.1750.1751.1752.1753.1754.1755.1756.1757.1758.1759.1760.1761.1762.1649.1763.1764.1765.1766.1767.1768.1769.1770.1771.1772.1773.1774.1775.1776.1777.1778.1779.1780.1781.1782.1783.1784.1785.1786.1787.1788.1789.1790.1791.1792.1793.1794.1795.1796.1822.1797.1798.1799.1800.1801.1802.1803.1804.1810.1811.1812.1813.1814.2105.477.691.858.865.1815.1641.765.992.993.1565.1615.765.992.993.1565.1615.1720.452.1721.1722.1723.1724.1725.1726.1727.452.1721.1722.1723.1724.1725.1726.1727.1728.1729.1730.1731.1732.1733.1729.1730.1731.1732.1733.1734.1735.1736.1737.1738.1739.1735.1736.1737.1738.1739.1740.1741.1742.1743.1744.1821.1741.1742.1743.1744.1821.1746.1747.1748.1749.1750.1751.1752.1753.1754.1755.1756.1757.1747.1748.1749.1750.1751.1752.1753.1754.1755.1756.1757.1758.1759.1760.1761.1759.1760.1761.1762.1649.1763.1764.1765.1766.1767.1768.1769.1770.1649.1763.1764.1765.1766.1767.1768.1769.1770.1771.1772.1773.1774.1772.1773.1774.1775.1776.1777.1778.1779.1776.1777.1778.1779.1780.1781.1782.1783.1784.1785.1786.1781.1782.1783.1784.1785.1786.1787.1788.1789.1790.1788.1789.1790.1791.1792.1793.1792.1793.1794.1795.1796.1822.1795.1796.1822.1797.1798.1799.1800.1801.1798.1799.1800.1801.1802.1803.1804.1803.1804.1810.1811.1812.1813.1814.1811.1812.1813.1814.2105.477.691.858.865.1815.1816.1817.1818.1819.1820.1823.1824.1825.477.691.858.865.1815.1816.1817.1818.1819.1820.1823.1824.1825.1816.1817.1818.1819.1820.1823.1824.1825.1668.1671.1674.1679.1680.1826.1827.1828.1829.1830.1831.1832.1833.1834.1835.1836.1837.1838.1839.1840.1841.1842.1843.1844.1845.1846.1847.1848.1849.1850.1851.1852.1853.1854.1855.1856.1857.1858.1859.1677.1682.1684.1860.1861.1678.1862.1672.1673.1879.2106.478.692.873.1676.1805.1671.1674.1679.1680.1826.1827.1828.1829.1830.1831.1832.1833.1834.1835.1827.1828.1829.1830.1831.1832.1833.1834.1835.1836.1837.1838.1839.1837.1838.1839.1840.1841.1842.1843.1841.1842.1843.1844.1845.1846.1847.1848.1845.1846.1847.1848.1849.1850.1851.1852.1853.1850.1851.1852.1853.1854.1855.1856.1857.1858.1855.1856.1857.1858.1859.1677.1682.1684.1860.1677.1682.1684.1860.1861.1678.1678.1862.1672.1673.1672.1673.1879.2106.478.692.873.1676.1805.1806.1807.1808.1809.478.692.873.1676.1805.1806.1807.1808.1809.1806.1807.1808.1809.1903.1880.1881.1904.1434.1912.1913.1914.1915.1916.1917.1918.1919.1920.1921.1922.1923.1925.1926.1927.1928.1929.1930.1931.1932.1957.1962.1968.1905.1348.1933.1934.1935.1936.1937.1938.1939.1940.1941.1942.1943.1944.1945.1946.1956.1958.1961.1967.1969.2036.1906.479.712.988.1344.1422.1443.1538.1618.1907.1908.1308.1357.1358.1359.1360.1361.1362.1373.1374.1429.1448.1623.1909.1947.1948.1949.1950.1951.1952.1910.1953.1954.1911.543.1536.1558.1880.1881.1904.1434.1912.1913.1914.1915.1916.1917.1918.1919.1920.1921.1922.1923.1925.1926.1927.1928.1929.1930.1931.1932.1957.1962.1968.1434.1912.1913.1914.1915.1916.1917.1918.1919.1920.1921.1922.1923.1925.1926.1927.1928.1929.1930.1931.1932.1957.1962.1968.1905.1348.1933.1934.1935.1936.1937.1938.1939.1940.1941.1942.1943.1944.1945.1946.1956.1958.1961.1967.1969.2036.1348.1933.1934.1935.1936.1937.1938.1939.1940.1941.1942.1943.1944.1945.1946.1956.1958.1961.1967.1969.2036.1906.479.712.988.1344.1422.1443.1538.1618.479.712.988.1344.1422.1443.1538.1618.1907.1908.1308.1357.1358.1359.1360.1361.1362.1373.1374.1429.1448.1623.1308.1357.1358.1359.1360.1361.1362.1373.1374.1429.1448.1623.1909.1947.1948.1949.1950.1951.1952.1947.1948.1949.1950.1951.1952.1910.1953.1954.1953.1954.1911.543.1536.1558.543.1536.1558.2040.1406.1421.1431.1432.1446.1531.1533.1570.1574.1575.2107.2108.2109.1406.1421.1431.1432.1446.1531.1533.1570.1574.1575.2107.2108.2109.2042.1407.1438.1439.1440.1441.1442.1482.1484.1485.1486.1487.1526.2044.2045.1527.1528.1408.1546.2023.2024.2025.2026.2027.2028.2029.2030.2031.2032.2033.2034.2035.2037.2038.2039.2041.2043.1516.1523.1524.1407.1438.1439.1440.1441.1442.1482.1484.1485.1486.1487.1438.1439.1440.1441.1442.1482.1484.1485.1486.1487.1526.2044.2045.2044.2045.1527.1528.1408.1546.1408.1546.2023.2024.2025.2026.2027.2028.2029.2030.2031.2032.2033.2034.2035.2024.2025.2026.2027.2028.2029.2030.2031.2032.2033.2034.2035.2037.2038.2039.2041.2038.2039.2041.2043.1516.1523.1524.1516.1523.1524.2046.1034.1111.1562.1609.1681.1976.1977.1978.1979.1980.1981.1982.1983.1984.1985.1986.1987.1988.1989.1990.1991.1992.1993.1994.1995.1996.1597.1997.1998.1999.2000.2001.2002.2004.2005.2006.2007.2008.2009.2010.2011.2013.2014.2015.2016.2017.2018.2019.2020.2021.2022.2047.835.1112.1163.1034.1111.1562.1609.1681.1976.1977.1978.1979.1980.1981.1982.1983.1984.1985.1986.1987.1988.1989.1990.1991.1992.1993.1994.1995.1977.1978.1979.1980.1981.1982.1983.1984.1985.1986.1987.1988.1989.1990.1991.1992.1993.1994.1995.1996.1597.1997.1998.1999.2000.2001.2002.2004.2005.2006.2007.1597.1997.1998.1999.2000.2001.2002.2004.2005.2006.2007.2008.2009.2010.2011.2013.2014.2015.2016.2017.2018.2019.2020.2021.2022.2009.2010.2011.2013.2014.2015.2016.2017.2018.2019.2020.2021.2022.2047.835.1112.1163.835.1112.1163.2048.1509.2049.2050.2058.2059.2060.2062.2063.2051.2072.2073.2075.2076.2077.2052.2053.2089.2090.2091.2092.2054.1539.1540.2055.1509.2049.2050.2058.2059.2060.2062.2063.2058.2059.2060.2062.2063.2051.2072.2073.2075.2076.2077.2072.2073.2075.2076.2077.2052.2053.2089.2090.2091.2092.2089.2090.2091.2092.2054.1539.1540.1539.1540.2055.2065.1315.1316.1355.986.1594.1620.1512.1513.1514.1515.1517.1518.1521.1541.1572.2066.833.967.1314.1323.1411.1412.1413.1416.2067.972.1331.2068.1563.2069.1372.2070.834.1115.1315.1316.1355.986.1594.1620.986.1594.1620.1512.1513.1514.1515.1517.1518.1521.1541.1572.2066.833.967.1314.1323.1411.1412.1413.1416.833.967.1314.1323.1411.1412.1413.1416.2067.972.1331.972.1331.2068.1563.1563.2069.1372.1372.2070.834.1115.834.1115&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/6.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="1836"><a href="/site/catalog#!cat=1836.1837.1838.1839&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/3.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2066"><a href="/site/catalog#!cat=2066.833.967.1314.1323.1411.1412.1413.1416&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/4.jpg"></a></div>
           </div>

            <div id="main-spec">

                <div id="index-card-4">Специальные предложения</div>
                <?
                foreach($dataproducts as $value){
                    $outer = '';
                    $product = $value[products];
                    $description = $value[productsDescription];
                    $attr_desc = $value[productsAttributesDescr];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr[products_options_values_name].'</div></div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }

                    $product[products_image] = str_replace(')',']]]]', $product[products_image]);
                    $product[products_image] = str_replace(' ','[[[[]]]]', $product[products_image]);
                    $product[products_image] = str_replace('(','[[[[', $product[products_image]);

                    $outer .= '<div  class="container-fluid float" id="index-card-1" product=""><div data-prod="'.$product[products_id].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product[products_image].');"></div><div class="name">'.$description[products_name].'</div><div class="model">Арт.'.$product[products_model].'</div><div class="price"><b>'.intval($product[products_price]).'</b> руб.</div><div id="prod-info" data-prod="'.$product[products_id].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }


                ?>
            </div>
            <div id="main-new">
                <div id="index-card-4">Новые поступления</div>
                <?
                foreach($newproducts as $value){
                    $outer = '';
                    $product = $value[products];
                    $description = $value[productsDescription];
                    $attr_desc = $value[productsAttributesDescr];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr[products_options_values_name].'</div></div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }

                    $product[products_image] = str_replace(')',']]]]', $product[products_image]);
                    $product[products_image] = str_replace(' ','[[[[]]]]', $product[products_image]);
                    $product[products_image] = str_replace('(','[[[[', $product[products_image]);

                    $outer .= '<div  class="container-fluid float" id="index-card-1" product=""><div data-prod="'.$product[products_id].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product[products_image].');"></div><div class="name">'.$description[products_name].'</div><div class="model">Арт.'.$product[products_model].'</div><div class="price"><b>'.intval($product[products_price]).'</b> руб.</div><div id="prod-info" data-prod="'.$product[products_id].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }


                ?>
            </div>

<a href="http://egorov1.rezerv.odezhda-master.ru/site/catalog/%D0%90%D0%BA%D1%81%D0%B5%D1%81%D1%81%D1%83%D0%B0%D1%80%D1%8B/#!cat=932.938.939.940.1113.1275.1310.1313.1424.1576.1622&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=undefined&searchword="></a>

        </div>
    </div>
<?}else{?>




<?}?>
