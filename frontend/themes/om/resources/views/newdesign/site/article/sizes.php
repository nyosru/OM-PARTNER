<?php
use yii\filters\AccessControl;
use yii\web\User;
use yii\bootstrap\Collapse;
/* @var $this yii\web\View */
?>
<div class="container">
<center><h1 style="margin-left: 20px;">Уважаемые покупатели<br>Убедительная просьба при заказе определенных категорий изделий:</h1></center><ul><li>1. Учитывать эластичность тканей (трикотаж синтетический, хлопковый,
        вязанный). На сантиметровой ленте изделие будет выглядеть меньше.</li><li>2. При выборе верхней одежды осенне-зимнего ассортимента следует
        учитывать толщину изделия, так как утеплители бывают различные по
        размеру и составу.</li><li>3. Заказывая спортивные костюмы, толстовки и подобные изделия,
        учитывайте, что изделия могут "сидеть" на фигуре свободно или облегающе
        (в зависимости от разработанной производителем модели. Обратите внимание
        на модель).</li></ul><h1 style="margin-left: 20px;"><strong>Определение размера женской одежды</strong></h1><p style="margin-left: 20px;">Для
    определения собственного размера, Вам необходимо произвести некоторые
    измерения. (Для этого вам понадобится сантиметровая лента.)</p><p style="margin-left: 20px;">Вам необходимо замерить 3 параметра вашей фигуры: Обхват груди, Обхват Талии, Обхват бедер.</p><p style="margin-left: 20px;">Измерение производится следующим образом:</p><ol><li><em>Для параметра <strong>«обхват груди»</strong> –расположите
            измерительную ленту по выступающим точкам груди, под подмышечными
            впадинами. На спине расположите ленту немного выше.</em></li><li><em><strong>«Обхват талии»</strong> измеряется строго по линии талии. Определить линию талии можно, слегка наклонившись вбок.</em></li><li><em>Измерение <strong>«обхвата бедер»</strong> производим по наиболее выступающим точкам ягодиц.</em></li></ol><p style="margin-left: 20px;"> Теперь, вооружившись результатами измерений, вы сможете точно подобрать свой размер.</p><p style="margin-left: 20px;">Для кофточек, блузок, платьев, пиджаков, пальто, курток, жилетов и т.д.- вам понадобится параметр – <strong>обхват груди</strong>.;</p><p style="margin-left: 20px;">Для брюк, юбок будем пользоваться – цифрами, полученными при измерении  <strong>талии и бёдер.</strong></p><p style="margin-left: 20px;"><strong>Для определения подходящего размера, полученные мерки можно соотнести с параметрами <a href="http://odezhda-master.ru/models.php">наших моделей</a></strong></p><p style="margin-left: 20px;"><strong> </strong></p><h1 style="margin-left: 20px;"><strong>Как мы работаем.</strong></h1><p style="margin-left: 20px;">Перед отправкой Ваших заказов, мы
    проводим проверку соответствия размеров одежды, чтобы вы получили именно
    те размеры, которые заказываете.</p><p style="margin-left: 20px;"><strong>Измерение «Обхват талии» </strong>-
    для пиджаков, курток, пальто, кардиганов и т.д. это - размер  в
    сантиметрах на уровне талии. Для брюк и юбок это размер в сантиметрах
    верхнего среза изделия.</p><p style="margin-left: 20px;"><strong>Измерение «Обхват бедер» </strong>-  измеряется по верхней точке выступающей части ягодиц.</p><p style="margin-left: 20px;"><strong>Измерение «Длина рукава» </strong>производится замером от плеча до края манжета по внешней стороне рукава</p><p style="margin-left: 20px;">Независимо
    от информации указанной на ярлыке, мы промеряем заказанные Вами
    предметы гардероба, используя упомянутый выше сантиметр, и портновские
    манекены. Поэтому, при выборе одежды у нас на сайте, указывайте Ваш
    фактический размер. Соответствие результатов Ваших измерений и размера,
    который необходимо указать в заказе  вы можете увидеть в таблицах
    размеров.</p><p style="margin-left: 20px;">Выберите интересующую Вас ссылку из таблицы ниже, и соответствующий  размерный ряд откроется в новом окне.</p><h1 style="margin-left: 20px;">Размеры детской одежды</h1><p style="margin-left: 20px;">Для
    определения размера детской одежды используют различные критерии.
    Обычно, помимо биометрических данных ( роста) используется критерий
    возраста. Для более точного определения размера пользуйтесь этими двумя
    параметрами.</p><p style="margin-left: 20px;">И помните, что дети быстро растут, поэтому в случае сомнений, делайте выбор в сторону большего размера.</p><p style="margin-left: 20px;">размера.</p><p style="margin-left: 20px;">        <img src="http://odezhda-master.ru/images/pixel_trans.gif" alt=""></p>

<?=Collapse::widget([
    'options'=>['class'=>'','style'=>['margin-top'=>'30px']],
    'items' => [
        [
            'label' => 'Детская одежда',
            'content' => '
            <table width="100%" style="float:left" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Таблица размеров детской одежды</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Таблица размеров детской одежды" title="Таблица размеров детской одежды"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
    <thead>
    <tr> <th colspan="5">Малыши до 1-ого года.</th> </tr>

    <tr> <th colspan="2">Российский размер.</th><th>Возраст (мес)</th><th>Рост(см)</th><th>Обхват груди(СМ)</th> </tr>

    </thead>
    <tbody>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">18</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">56</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">0-2</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">56</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">36</p></td></tr>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">18</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">58</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">3</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">58</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">38</p></td></tr>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">20</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">62</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">4</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">62</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">40</p></td></tr>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">20</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">68</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">6</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">68</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">44</p></td></tr>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">22</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">74</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">9</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">74</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">44</p></td></tr>
    <tr><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">24</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">80</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">12</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">80</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">48</p></td></tr>
    </tbody>
</table>
<p>&nbsp;</p>
<table class="table">
    <thead><tr> <th colspan="11">Малыши и дети до 10 лет.</th> </tr></thead>

    <tbody>
        <tr><td><strong>Размер<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">26</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">28</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">28-30</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">30-32</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">32</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">34</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">34-36</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">36</p></td></tr>

        <tr><td><strong>Возраст(г)<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">2</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">3</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">4</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">5</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">6</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">6-7</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">8</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">9-10</p></td></tr>

        <tr><td><strong>Рост<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">92-98</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">98-104</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">104-110</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">110-116</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">116-122</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">122-128</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">128-134</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">134-140</p></td></tr>

        <tr><td><strong>Обхват груди<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">54-56</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">55-57</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">56-58</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">57-59</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">58-62</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">61-65</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">64-68</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">67-71</p></td></tr>

        <tr><td><strong>Обхват талии<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">51-53</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">52-54</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">53-55</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">54-56</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">55-58</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">57-59</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">58-61</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">60-62</p></td></tr>

        <tr><td><strong>Обхват бедер<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">55-58</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">57-60</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">59-62</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">61-64</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">63-67</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">66-70</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">69-73</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">72-76</p></td></tr>

        <tr><td><strong>Длина спины<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">23</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">24</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">25-26</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">26-27</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">27-29</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">29-30</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">30-31</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">31-35</p></td></tr>

        <tr><td><strong>Длина рукава<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">30-32</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">32-36</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">36-38</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">38-41</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">41-43</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">43-46</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">46-48</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">48-51</p></td></tr>

        <tr><td><strong>Боковая длина<strong></strong></strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">53-56</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">57-60</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">61-64</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">65-68</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">69-72</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">73-76</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">77-80</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">81-84</p></td></tr>

    </tbody>
</table>
<p>&nbsp;</p>
<table class="table">
    <thead><tr> <th colspan="4">Подростки</th> </tr></thead>

    <tbody>
    <tr><td><strong>Размер</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">38</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">40-42</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">42-44</p></td></tr>

    <tr><td><strong>Рост</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">140-146</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">146-158</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">158-164</p></td></tr>

    <tr><td><strong>Обхват груди</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">70-74</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">73-80</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">79-83</p></td></tr>

    <tr><td><strong>Обхват талии</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">61-64</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">63-67</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">66-68</p></td></tr>

    <tr><td><strong>Обхват бедер</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">75-80</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">79-87</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">86-90</p></td></tr>

    <tr><td><strong>Длина спины</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">32-35</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">34-38</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">38-40</p></td></tr>

    <tr><td><strong>Длина рукава</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">52-53</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">53-57</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">57-59</p></td></tr>

    <tr><td><strong>Боковая длина(брюки)</strong></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">85-88</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">89-96</p></td><td><p style="text-align: center; text-indent: 0; margin-left: 5px; margin-right: 5px">97-100</p></td></tr>

    </tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>
        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->
   </tr></tbody></table>',
            'active' => true
        ],
        [
            'label' => 'Женская одежда',
            'content' => '<table style="float: left" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Таблицы размеров женской одежды</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Таблицы размеров женской одежды" title="Таблицы размеров женской одежды"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="13" valign="middle" align="center">
<p><strong><em>Для БЛУЗОК, ТУНИК, КУРТОК, ПЛАТЬЕВ</em></strong></p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Размер РФ</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват груди (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Длина рукава (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td style="background-color: #9acd32;" colspan="2" valign="middle" align="center">
<p align="center"><strong>Английский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Американский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Европейский размер</strong></p>
</td>
<td style="background-color: #9acd32;" colspan="2" valign="middle" align="center">
<p align="center"><strong>Итальянский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Японский размер</strong></p>
</td>
</tr>
<tr>
<td>
<p>38</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>76</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>58</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>58/60</strong></p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>0</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>0</p>
</td>
<td>
<p>3</p>
</td>
</tr>
<tr>
<td>
<p>40</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>80</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>62</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>59/61</strong></p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>2</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>I</p>
</td>
<td>
<p>5</p>
</td>
</tr>
<tr>
<td>
<p>42</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>84</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>66</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>59/61</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>II</p>
</td>
<td>
<p>7</p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>88</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>70</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>96</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>60/62</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>III</p>
</td>
<td>
<p>9</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>74</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>60/62</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>IV</p>
</td>
<td>
<p>11</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>96</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>78</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>V</p>
</td>
<td>
<p>13</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>VI</p>
</td>
<td>
<p>15</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>VII</p>
</td>
<td>
<p>17</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>90</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>20</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>VIII</p>
</td>
<td>
<p>19</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>22</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>IX</p>
</td>
<td>
<p>21</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>98</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>24</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>20</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>X</p>
</td>
<td>
<p>23</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>128</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>26</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>22</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>XI</p>
</td>
<td>
<p>25</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>132</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>28</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>24</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>XII</p>
</td>
<td>
<p>27</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>128</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>136</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>26</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>XIII</p>
</td>
<td>
<p>29</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>132</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>140</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>28</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>XIV</p>
</td>
<td>
<p>31</p>
</td>
</tr>
<tr>
<td>
<p>68</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>136</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>144</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>66</p>
</td>
<td>
<p>XV</p>
</td>
<td>
<p>33</p>
</td>
</tr>
<tr>
<td>
<p>70</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>140</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>148</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>61/63</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>68</p>
</td>
<td>
<p>XVI</p>
</td>
<td>
<p>35</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="11" valign="middle" align="center">
<p><strong><em>Для БРЮК, ЮБОК, ШОРТ</em></strong></p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Размер РФ</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td style="background-color: #9acd32;" colspan="2" valign="middle" align="center">
<p align="center"><strong>Английский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Американский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Европейский размер</strong></p>
</td>
<td style="background-color: #9acd32;" colspan="2" valign="middle" align="center">
<p align="center"><strong>Итальянаский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Японский Размер</strong></p>
</td>
</tr>
<tr>
<td>
<p>38</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>58</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>0</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>0</p>
</td>
<td>
<p>3</p>
</td>
</tr>
<tr>
<td>
<p>40</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>62</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>2</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>I</p>
</td>
<td>
<p>5</p>
</td>
</tr>
<tr>
<td>
<p>42</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>66</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>92</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>II</p>
</td>
<td>
<p>7</p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>70</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>96</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>III</p>
</td>
<td>
<p>9</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>74</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>IV</p>
</td>
<td>
<p>11</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>78</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>V</p>
</td>
<td>
<p>13</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>VI</p>
</td>
<td>
<p>15</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>VII</p>
</td>
<td>
<p>17</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>90</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>20</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>VIII</p>
</td>
<td>
<p>19</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>22</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>IX</p>
</td>
<td>
<p>21</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>98</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>124</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>24</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>20</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>X</p>
</td>
<td>
<p>23</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>128</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>26</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>22</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>XI</p>
</td>
<td>
<p>25</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>132</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>28</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>24</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>XII</p>
</td>
<td>
<p>27</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>136</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>26</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>XIII</p>
</td>
<td>
<p>29</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>140</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>28</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>XIV</p>
</td>
<td>
<p>31</p>
</td>
</tr>
<tr>
<td>
<p>68</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>144</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>66</p>
</td>
<td>
<p>XV</p>
</td>
<td>
<p>33</p>
</td>
</tr>
<tr>
<td>
<p>70</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>148</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>68</p>
</td>
<td>
<p>XVI</p>
</td>
<td>
<p>35</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="6" valign="middle" align="center">
<p><strong><em>ДЖИНСЫ</em></strong></p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Джинсы обхват талии (дюймы)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Американский размер</strong></p>
</td>
</tr>
<tr>
<td>
<p>38</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>58</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td width="21%">
<p>24</p>
</td>
<td width="23%">
<p>XXS</p>
</td>
<td>
<p>0</p>
</td>
</tr>
<tr>
<td>
<p>40</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>62</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td width="21%">
<p>25</p>
</td>
<td width="23%">
<p>XS</p>
</td>
<td>
<p>0-2</p>
</td>
</tr>
<tr>
<td>
<p>42</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>66</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>92</strong></p>
</td>
<td width="21%">
<p>26</p>
</td>
<td width="23%">
<p>S</p>
</td>
<td>
<p>2</p>
</td>
</tr>
<tr>
<td>
<p>42-44</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>66-70</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>92-96</strong></p>
</td>
<td width="21%">
<p>27</p>
</td>
<td width="23%">
<p>S/M</p>
</td>
<td>
<p>2-4</p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>70</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>96</strong></p>
</td>
<td width="21%">
<p>28</p>
</td>
<td width="23%">
<p>M</p>
</td>
<td>
<p>4</p>
</td>
</tr>
<tr>
<td>
<p>44-46</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>68-74</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>96-100</strong></p>
</td>
<td width="21%">
<p>29</p>
</td>
<td width="23%">
<p>M/L</p>
</td>
<td>
<p>4-6</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>74</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td width="21%">
<p>30</p>
</td>
<td width="23%">
<p>L</p>
</td>
<td>
<p>6</p>
</td>
</tr>
<tr>
<td>
<p>46-48</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>74-78</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100-104</strong></p>
</td>
<td width="21%">
<p>31</p>
</td>
<td width="23%">
<p>L/XL</p>
</td>
<td>
<p>6-8</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>78</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td width="21%">
<p>32</p>
</td>
<td width="23%">
<p>XL</p>
</td>
<td>
<p>8</p>
</td>
</tr>
<tr>
<td>
<p>48-50</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>78-82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104-108</strong></p>
</td>
<td width="21%">
<p>33</p>
</td>
<td width="23%">
<p>XL/XXL</p>
</td>
<td>
<p>8-10</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td width="21%">
<p>34</p>
</td>
<td width="23%">
<p>XXL</p>
</td>
<td>
<p>10</p>
</td>
</tr>
<tr>
<td>
<p>50-52</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>82-86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108-112</strong></p>
</td>
<td width="21%">
<p>35</p>
</td>
<td width="23%">
<p>XXL/3XL</p>
</td>
<td>
<p>10-12</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td width="21%">
<p>36</p>
</td>
<td width="23%">
<p>XXXL</p>
</td>
<td>
<p>12</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>90</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>116</strong></p>
</td>
<td width="21%">
<p>38</p>
</td>
<td width="23%">
<p>XXXL</p>
</td>
<td>
<p>14</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>120</strong></p>
</td>
<td width="21%">
<p>39</p>
</td>
<td width="23%">
<p>XXXL</p>
</td>
<td>
<p>16</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>98</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>124</strong></p>
</td>
<td width="21%">
<p>40</p>
</td>
<td width="23%">
<p>XXXL</p>
</td>
<td>
<p>18</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>128</strong></p>
</td>
<td width="21%">
<p>41</p>
</td>
<td width="23%">
<p>4XL</p>
</td>
<td>
<p>20</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>132</strong></p>
</td>
<td width="21%">
<p>42</p>
</td>
<td width="23%">
<p>4XL</p>
</td>
<td>
<p>22</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>136</strong></p>
</td>
<td width="21%">
<p>43</p>
</td>
<td width="23%">
<p>4XL</p>
</td>
<td>
<p>24</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td style="background-color: #9acd32;">
<p><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p><strong>140</strong></p>
</td>
<td width="21%">
<p>44</p>
</td>
<td width="23%">
<p>5XL</p>
</td>
<td>
<p>24+</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Мужская одежда',
            'content' => '<table style="float:left" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Таблица размеров мужской одежды</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Таблица размеров мужской одежды" title="Таблица размеров мужской одежды"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="10" valign="middle" align="center">
<p><strong>Пиджаки</strong><strong>,</strong><strong>&nbsp;</strong><strong>джемпера</strong><strong>,</strong><strong>&nbsp;</strong><strong>жилеты</strong><strong>, халаты,</strong><strong>&nbsp;</strong><strong>свитера</strong><strong>,</strong><strong>&nbsp;</strong><strong>куртки</strong><strong>,</strong><strong>&nbsp;</strong><strong>рубашки</strong></p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват груди (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Длина рукава (см)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Англия</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>США</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Европа</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Италия</strong></p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>70</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>59</strong></p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>42</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>76</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>96</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>60</strong></p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>44</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>96</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>61</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>62</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>63</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>63</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>106</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>64</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>64</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>118</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>65</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>128</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>65</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>128</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>132</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>66</strong></p>
</td>
<td>
<p>4XL</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>132</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>128</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>134</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>66</strong></p>
</td>
<td>
<p>4XL</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
</tr>
<tr>
<td>
<p>68</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>136</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>132</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>136</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>66</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>66</p>
</td>
</tr>
<tr>
<td>
<p>70</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>140</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>136</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>138</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>66</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>68</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td colspan="5">
<p><strong>Рубашки,</strong><strong> сорочки</strong></p>
</td>
</tr>
<tr>
<td>
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td>
<p align="center"><strong>Окружность шеи (см)</strong></p>
</td>
<td>
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td>
<p align="center"><strong>США</strong></p>
</td>
<td>
<p align="center"><strong>Европа</strong></p>
</td>
</tr>
<tr>
<td>
<p>42</p>
</td>
<td>
<p align="center">37</p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>14,5</p>
</td>
<td>
<p>37</p>
</td>
</tr>
<tr>
<td>
<p>42</p>
</td>
<td>
<p align="center">38</p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>15</p>
</td>
<td>
<p>38</p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td>
<p align="center">39</p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>15,5</p>
</td>
<td>
<p>39</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td>
<p align="center">40</p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>15,5</p>
</td>
<td>
<p>40</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td>
<p align="center">41</p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>41</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td>
<p align="center">42</p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>16,5</p>
</td>
<td>
<p>42</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td>
<p align="center">43</p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>17</p>
</td>
<td>
<p>43</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td>
<p align="center">44</p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>17,5</p>
</td>
<td>
<p>44</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td>
<p align="center">45</p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>45</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td>
<p align="center">46</p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>46</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td colspan="8">
<p><strong>Шорты, брюки</strong></p>
</td>
</tr>
<tr>
<td>
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td>
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td>
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td>
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td>
<p align="center"><strong>Англия</strong></p>
</td>
<td>
<p align="center"><strong>США</strong></p>
</td>
<td>
<p align="center"><strong>Европа</strong></p>
</td>
<td>
<p align="center"><strong>Италия</strong></p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td>
<p align="center"><strong>70</strong></p>
</td>
<td>
<p align="center"><strong>92</strong></p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>42</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td>
<p align="center"><strong>76</strong></p>
</td>
<td>
<p align="center"><strong>96</strong></p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>44</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td>
<p align="center"><strong>82</strong></p>
</td>
<td>
<p align="center"><strong>100</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td>
<p align="center"><strong>88</strong></p>
</td>
<td>
<p align="center"><strong>104</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td>
<p align="center"><strong>94</strong></p>
</td>
<td>
<p align="center"><strong>108</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td>
<p align="center"><strong>100</strong></p>
</td>
<td>
<p align="center"><strong>112</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td>
<p align="center"><strong>106</strong></p>
</td>
<td>
<p align="center"><strong>116</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td>
<p align="center"><strong>112</strong></p>
</td>
<td>
<p align="center"><strong>120</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td>
<p align="center"><strong>118</strong></p>
</td>
<td>
<p align="center"><strong>124</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td>
<p align="center"><strong>120</strong></p>
</td>
<td>
<p align="center"><strong>128</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td>
<p align="center"><strong>124</strong></p>
</td>
<td>
<p align="center"><strong>132</strong></p>
</td>
<td>
<p>4XL</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td>
<p align="center"><strong>128</strong></p>
</td>
<td>
<p align="center"><strong>134</strong></p>
</td>
<td>
<p>4XL</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
</tr>
<tr>
<td>
<p>68</p>
</td>
<td>
<p align="center"><strong>132</strong></p>
</td>
<td>
<p align="center"><strong>136</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>66</p>
</td>
</tr>
<tr>
<td>
<p>70</p>
</td>
<td>
<p align="center"><strong>136</strong></p>
</td>
<td>
<p align="center"><strong>138</strong></p>
</td>
<td>
<p>5XL</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>68</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td colspan="6">
<p><strong>Джинсы</strong></p>
</td>
</tr>
<tr>
<td>
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td>
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td>
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td>
<p align="center"><strong>Джинсы обхват талии (дюймы)</strong></p>
</td>
<td>
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td>
<p align="center"><strong>США</strong></p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td>
<p align="center"><strong>70</strong></p>
</td>
<td>
<p align="center"><strong>92</strong></p>
</td>
<td>
<p>28</p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>2-4</p>
</td>
</tr>
<tr>
<td>
<p>44-46</p>
</td>
<td>
<p align="center"><strong>70-76</strong></p>
</td>
<td>
<p align="center"><strong>92-96</strong></p>
</td>
<td>
<p>29</p>
</td>
<td>
<p>XXS/XS</p>
</td>
<td>
<p>4</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td>
<p align="center"><strong>76</strong></p>
</td>
<td>
<p align="center"><strong>96</strong></p>
</td>
<td>
<p>30</p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>6</p>
</td>
</tr>
<tr>
<td>
<p>46-48</p>
</td>
<td>
<p align="center"><strong>76-82</strong></p>
</td>
<td>
<p align="center"><strong>96-100</strong></p>
</td>
<td>
<p>31</p>
</td>
<td>
<p>XS/S</p>
</td>
<td>
<p>6-8</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td>
<p align="center"><strong>82</strong></p>
</td>
<td>
<p align="center"><strong>100</strong></p>
</td>
<td>
<p>32</p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>8</p>
</td>
</tr>
<tr>
<td>
<p>48-50</p>
</td>
<td>
<p align="center"><strong>82-88</strong></p>
</td>
<td>
<p align="center"><strong>100-104</strong></p>
</td>
<td>
<p>33</p>
</td>
<td>
<p>S/M</p>
</td>
<td>
<p>8-10</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td>
<p align="center"><strong>88</strong></p>
</td>
<td>
<p align="center"><strong>104</strong></p>
</td>
<td>
<p>34</p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>10</p>
</td>
</tr>
<tr>
<td>
<p>50-52</p>
</td>
<td>
<p align="center"><strong>88-94</strong></p>
</td>
<td>
<p align="center"><strong>104-108</strong></p>
</td>
<td>
<p>35</p>
</td>
<td>
<p>M/L</p>
</td>
<td>
<p>10-12</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td>
<p align="center"><strong>94</strong></p>
</td>
<td>
<p align="center"><strong>108</strong></p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>12</p>
</td>
</tr>
<tr>
<td>
<p>52-54</p>
</td>
<td>
<p align="center"><strong>94-100</strong></p>
</td>
<td>
<p align="center"><strong>108-112</strong></p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>L/XL</p>
</td>
<td>
<p>12-14</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td>
<p align="center"><strong>100</strong></p>
</td>
<td>
<p align="center"><strong>112</strong></p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>14</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td>
<p align="center"><strong>106</strong></p>
</td>
<td>
<p align="center"><strong>116</strong></p>
</td>
<td>
<p>41</p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>16</p>
</td>
</tr>
<tr>
<td>
<p>56-58</p>
</td>
<td>
<p align="center"><strong>106-112</strong></p>
</td>
<td>
<p align="center"><strong>116-120</strong></p>
</td>
<td>
<p>41</p>
</td>
<td>
<p>XXL/XXXL</p>
</td>
<td>
<p>16-18</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td>
<p align="center"><strong>112</strong></p>
</td>
<td>
<p align="center"><strong>120</strong></p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>18</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td>
<p align="center"><strong>118</strong></p>
</td>
<td>
<p align="center"><strong>124</strong></p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>20</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td>
<p align="center"><strong>120</strong></p>
</td>
<td>
<p align="center"><strong>128</strong></p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>22</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>

      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Кольца',
            'content' => '<table style="float: left;" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Размеры колец</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Размеры колец" title="Размеры колец"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><p><span style="font-size: medium;">Обмерьте Ваш палец у основания при помощи сантиметровой ленты в миллиметрах и сравните его с данными из таблицы.</span></p>
<table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Диаметр (дюйм)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Размер (mm)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Диаметр (mm)</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Япония</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>США<br> Канада</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Англия</strong></p>
</td>
<td style="background-color: #9acd32;" valign="middle" align="center">
<p align="center"><strong>Россия<br> Германия</strong></p>
</td>
</tr>
<tr>
<td>
<p>0,553</p>
</td>
<td style="background-color: #9acd32;">
<p>44</p>
</td>
<td>
<p align="center"><strong>14,1</strong></p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>3</p>
</td>
<td>
<p>F</p>
</td>
<td>
<p>14</p>
</td>
</tr>
<tr>
<td>
<p>0,569</p>
</td>
<td style="background-color: #9acd32;">
<p>45,2</p>
</td>
<td>
<p align="center"><strong>14,4</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>3 1/2</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>14 1/2</p>
</td>
</tr>
<tr>
<td>
<p>0,585</p>
</td>
<td style="background-color: #9acd32;">
<p>46,5</p>
</td>
<td>
<p align="center"><strong>14,8</strong></p>
</td>
<td>
<p>7</p>
</td>
<td>
<p>4</p>
</td>
<td>
<p>H 1/2</p>
</td>
<td>
<p>15</p>
</td>
</tr>
<tr>
<td>
<p>0,601</p>
</td>
<td style="background-color: #9acd32;">
<p>47,8</p>
</td>
<td>
<p align="center"><strong>15,3</strong></p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>4 1/2</p>
</td>
<td>
<p>I 1/2</p>
</td>
<td>
<p>15 1/2</p>
</td>
</tr>
<tr>
<td>
<p>0,618</p>
</td>
<td style="background-color: #9acd32;">
<p>49</p>
</td>
<td>
<p align="center"><strong>15,7</strong></p>
</td>
<td>
<p>9</p>
</td>
<td>
<p>5</p>
</td>
<td>
<p>J 1/2</p>
</td>
<td>
<p>15 3/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>50</p>
</td>
<td>
<p align="center"><strong>15,9</strong></p>
</td>
<td>
<p>9</p>
</td>
<td>
<p>5¼</p>
</td>
<td>
<p>K</p>
</td>
<td>
<p>16</p>
</td>
</tr>
<tr>
<td>
<p>0,634</p>
</td>
<td style="background-color: #9acd32;">
<p>50,3</p>
</td>
<td>
<p align="center"><strong>16,1</strong></p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>5 1/2</p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>16</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>51,2</p>
</td>
<td>
<p align="center"><strong>16,3</strong></p>
</td>
<td>
<p>11</p>
</td>
<td>
<p>5¾</p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>16 1/3</p>
</td>
</tr>
<tr>
<td>
<p>0,65</p>
</td>
<td style="background-color: #9acd32;">
<p>51,5</p>
</td>
<td>
<p align="center"><strong>16,5</strong></p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>16 1/2</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>52,5</p>
</td>
<td>
<p align="center"><strong>16,7</strong></p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>6¼</p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>16 2/3</p>
</td>
</tr>
<tr>
<td>
<p>0,666</p>
</td>
<td style="background-color: #9acd32;">
<p>52,8</p>
</td>
<td>
<p align="center"><strong>16,9</strong></p>
</td>
<td>
<p>13</p>
</td>
<td>
<p>6 1/2</p>
</td>
<td>
<p>N</p>
</td>
<td>
<p>17</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>53,8</p>
</td>
<td>
<p align="center"><strong>17,1</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>6¾</p>
</td>
<td>
<p>N</p>
</td>
<td>
<p>17 1/9</p>
</td>
</tr>
<tr>
<td>
<p>0,683</p>
</td>
<td style="background-color: #9acd32;">
<p>54</p>
</td>
<td>
<p align="center"><strong>17,3</strong></p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>7</p>
</td>
<td>
<p>O</p>
</td>
<td>
<p>17 1/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>55,1</p>
</td>
<td>
<p align="center"><strong>17,5</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>7¼</p>
</td>
<td>
<p>O</p>
</td>
<td>
<p>17 1/2</p>
</td>
</tr>
<tr>
<td>
<p>0,699</p>
</td>
<td style="background-color: #9acd32;">
<p>55,3</p>
</td>
<td>
<p align="center"><strong>17,7</strong></p>
</td>
<td>
<p>15</p>
</td>
<td>
<p>7 1/2</p>
</td>
<td>
<p>P</p>
</td>
<td>
<p>17 3/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>56,3</p>
</td>
<td>
<p align="center"><strong>17,9</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>7¾</p>
</td>
<td>
<p>P</p>
</td>
<td>
<p>17 8/9</p>
</td>
</tr>
<tr>
<td>
<p>0,716</p>
</td>
<td style="background-color: #9acd32;">
<p>56,6</p>
</td>
<td>
<p align="center"><strong>18,2</strong></p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>Q</p>
</td>
<td>
<p>18</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>57,6</p>
</td>
<td>
<p align="center"><strong>18,3</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>8¼</p>
</td>
<td>
<p>Q</p>
</td>
<td>
<p>18,3</p>
</td>
</tr>
<tr>
<td>
<p>0,732</p>
</td>
<td style="background-color: #9acd32;">
<p>57,8</p>
</td>
<td>
<p align="center"><strong>18,5</strong></p>
</td>
<td>
<p>17</p>
</td>
<td>
<p>8 1/2</p>
</td>
<td>
<p>Q½</p>
</td>
<td>
<p>18 1/2</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>58,9</p>
</td>
<td>
<p align="center"><strong>18,7</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>8¾</p>
</td>
<td>
<p>R</p>
</td>
<td>
<p>18 2/3</p>
</td>
</tr>
<tr>
<td>
<p>0,748</p>
</td>
<td style="background-color: #9acd32;">
<p>59,1</p>
</td>
<td>
<p align="center"><strong>18,9</strong></p>
</td>
<td>
<p>18</p>
</td>
<td>
<p>9</p>
</td>
<td>
<p>R½</p>
</td>
<td>
<p>19</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>60,2</p>
</td>
<td>
<p align="center"><strong>19,1</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>9¼</p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>19,1</p>
</td>
</tr>
<tr>
<td>
<p>0,764</p>
</td>
<td style="background-color: #9acd32;">
<p>60,3</p>
</td>
<td>
<p align="center"><strong>19,3</strong></p>
</td>
<td>
<p>19</p>
</td>
<td>
<p>9 1/2</p>
</td>
<td>
<p>S½</p>
</td>
<td>
<p>19 1/3</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>61,4</p>
</td>
<td>
<p align="center"><strong>19,5</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>9¾</p>
</td>
<td>
<p>T</p>
</td>
<td>
<p>19 1/2</p>
</td>
</tr>
<tr>
<td>
<p>0,781</p>
</td>
<td style="background-color: #9acd32;">
<p>61,6</p>
</td>
<td>
<p align="center"><strong>19,8</strong></p>
</td>
<td>
<p>20</p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>T 1/2</p>
</td>
<td>
<p>20</p>
</td>
</tr>
<tr>
<td>
<p>0,798</p>
</td>
<td style="background-color: #9acd32;">
<p>62,8</p>
</td>
<td>
<p align="center"><strong>20,2</strong></p>
</td>
<td>
<p>22</p>
</td>
<td>
<p>10 1/2</p>
</td>
<td>
<p>U 1/2</p>
</td>
<td>
<p>20 1/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>64</p>
</td>
<td>
<p align="center"><strong>20,3</strong></p>
</td>
<td>
<p>-</p>
</td>
<td>
<p>10¾</p>
</td>
<td>
<p>V</p>
</td>
<td>
<p>20 1/3</p>
</td>
</tr>
<tr>
<td>
<p>0,814</p>
</td>
<td style="background-color: #9acd32;">
<p>64,1</p>
</td>
<td>
<p align="center"><strong>20,7</strong></p>
</td>
<td>
<p>23</p>
</td>
<td>
<p>11</p>
</td>
<td>
<p>V 1/2</p>
</td>
<td>
<p>20 3/4</p>
</td>
</tr>
<tr>
<td>
<p>-</p>
</td>
<td style="background-color: #9acd32;">
<p>65,3</p>
</td>
<td>
<p align="center"><strong>21</strong></p>
</td>
<td>
<p>24</p>
</td>
<td>
<p>11 1/2</p>
</td>
<td>
<p>W</p>
</td>
<td>
<p>21</p>
</td>
</tr>
<tr>
<td>
<p>0,846</p>
</td>
<td style="background-color: #9acd32;">
<p>66,6</p>
</td>
<td>
<p align="center"><strong>21,2</strong></p>
</td>
<td>
<p>25</p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>W½</p>
</td>
<td>
<p>21 1/4</p>
</td>
</tr>
<tr>
<td>
<p>0,862</p>
</td>
<td style="background-color: #9acd32;">
<p>67,9</p>
</td>
<td>
<p align="center"><strong>21,9</strong></p>
</td>
<td>
<p>26</p>
</td>
<td>
<p>12 1/2</p>
</td>
<td>
<p>Z</p>
</td>
<td>
<p>21 3/4</p>
</td>
</tr>
<tr>
<td>
<p>0,879</p>
</td>
<td style="background-color: #9acd32;">
<p>69,1</p>
</td>
<td>
<p align="center"><strong>22,3</strong></p>
</td>
<td>
<p>27</p>
</td>
<td>
<p>13</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>22</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>22,6</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>13 1/2</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>22 1/2</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>23</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>14</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>23</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>23,4</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>14 1/2</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>23 1/2</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>23,8</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>15</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>23 3/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>24,2</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>15 1/2</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>24 1/4</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="background-color: #9acd32;">
<p>&nbsp;</p>
</td>
<td>
<p align="center"><strong>24,6</strong></p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>16</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>24 1/2</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Перчатки, варежеки',
            'content' => '<table style="float: left;" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Размер перчаток, варежек</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Размер перчаток, варежек" title="Размер перчаток, варежек"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><p>Размер перчаток определяется измерением обхвата вашей ладони выше «косточек», не захватывая большой палец.</p>
<table class="table">
<tbody>
<tr>
<td rowspan="2">
<p align="center"><strong>Российский размер</strong></p>
</td>
<td colspan="2">
<p align="center"><strong>Обхват ладони</strong></p>
</td>
<td rowspan="2">
<p align="center"><strong>Международный размер</strong></p>
</td>
</tr>
<tr>
<td>
<p align="center"><strong>см</strong></p>
</td>
<td>
<p align="center"><strong>дюймы</strong></p>
</td>
</tr>
<tr>
<td>
<p>6</p>
</td>
<td>
<p align="center"><strong>15,2</strong></p>
</td>
<td>
<p>6</p>
</td>
<td>
<p>XXS</p>
</td>
</tr>
<tr>
<td>
<p>6,5</p>
</td>
<td>
<p align="center"><strong>16,5</strong></p>
</td>
<td>
<p>6,5</p>
</td>
<td>
<p>XS</p>
</td>
</tr>
<tr>
<td>
<p>7</p>
</td>
<td>
<p align="center"><strong>17,8</strong></p>
</td>
<td>
<p>7</p>
</td>
<td>
<p>S</p>
</td>
</tr>
<tr>
<td>
<p>7,5</p>
</td>
<td>
<p align="center"><strong>19</strong></p>
</td>
<td>
<p>7,5</p>
</td>
<td>
<p>M</p>
</td>
</tr>
<tr>
<td>
<p>8</p>
</td>
<td>
<p align="center"><strong>20,3</strong></p>
</td>
<td>
<p>8</p>
</td>
<td>
<p>L</p>
</td>
</tr>
<tr>
<td>
<p>8,5</p>
</td>
<td>
<p align="center"><strong>21,6</strong></p>
</td>
<td>
<p>8,5</p>
</td>
<td>
<p>XL</p>
</td>
</tr>
<tr>
<td>
<p>9</p>
</td>
<td>
<p align="center"><strong>22,9</strong></p>
</td>
<td>
<p>9</p>
</td>
<td>
<p>XXL</p>
</td>
</tr>
<tr>
<td>
<p>9,5</p>
</td>
<td>
<p align="center"><strong>24</strong></p>
</td>
<td>
<p>9,5</p>
</td>
<td>
<p>XXXL</p>
</td>
</tr>
<tr>
<td>
<p>10</p>
</td>
<td>
<p align="center"><strong>25</strong></p>
</td>
<td>
<p>10</p>
</td>
<td>
<p>-</p>
</td>
</tr>
<tr>
<td>
<p>10,5</p>
</td>
<td>
<p align="center"><strong>26</strong></p>
</td>
<td>
<p>10,5</p>
</td>
<td>
<p>-</p>
</td>
</tr>
<tr>
<td>
<p>11</p>
</td>
<td>
<p align="center"><strong>27</strong></p>
</td>
<td>
<p>11</p>
</td>
<td>
<p>-</p>
</td>
</tr>
<tr>
<td>
<p>11,5</p>
</td>
<td>
<p align="center"><strong>28</strong></p>
</td>
<td>
<p>11,5</p>
</td>
<td>
<p>-</p>
</td>
</tr>
<tr>
<td>
<p>12</p>
</td>
<td>
<p align="center"><strong>30,5</strong></p>
</td>
<td>
<p>12</p>
</td>
<td>
<p>-</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Браслеты',
            'content' => '<table style="float: left;" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Размеры браслетов</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Размеры браслетов" title="Размеры браслетов"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
<tbody>
<tr>
<td>
<p align="center"><strong>Российский размер</strong></p>
</td>
<td>
<p align="center"><strong>Обхват (см)</strong></p>
</td>
<td>
<p align="center"><strong>Дюймы (Инч)</strong></p>
</td>
</tr>
<tr>
<td>
<p>17</p>
</td>
<td>
<p align="center"><strong>17</strong></p>
</td>
<td>
<p>6,5</p>
</td>
</tr>
<tr>
<td>
<p>18</p>
</td>
<td>
<p align="center"><strong>18</strong></p>
</td>
<td>
<p>7</p>
</td>
</tr>
<tr>
<td>
<p>19</p>
</td>
<td>
<p align="center"><strong>19</strong></p>
</td>
<td>
<p>7,5</p>
</td>
</tr>
<tr>
<td>
<p>20</p>
</td>
<td>
<p align="center"><strong>20</strong></p>
</td>
<td>
<p>8</p>
</td>
</tr>
<tr>
<td>
<p>21</p>
</td>
<td>
<p align="center"><strong>21</strong></p>
</td>
<td>
<p>8,5</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Головные уборы',
            'content' => '<table style="float: left" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Размеры головных уборов</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Размеры головных уборов" title="Размеры головных уборов"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><p>Обхват вашей головы в сантиметрах выше бровей – соответствует вашему европейскому размеру</p>
<table class="table">
<tbody>
<tr>
<td rowspan="2">
<p align="center"><strong>Российский размер</strong></p>
</td>
<td colspan="2">
<p align="center"><strong>Обхват головы</strong></p>
</td>
<td rowspan="2">
<p align="center"><strong>Международный размер</strong></p>
</td>
<td rowspan="2">
<p align="center"><strong>Размер UK/US</strong></p>
</td>
</tr>
<tr>
<td>
<p align="center"><strong>см</strong></p>
</td>
<td>
<p align="center"><strong>дюймы</strong></p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td>
<p align="center"><strong>54</strong></p>
</td>
<td>
<p align="center"><strong>21,6</strong></p>
</td>
<td>
<p>XXS</p>
</td>
<td>
<p>6¾</p>
</td>
</tr>
<tr>
<td>
<p>55</p>
</td>
<td>
<p align="center"><strong>55</strong></p>
</td>
<td>
<p align="center"><strong>21,6</strong></p>
</td>
<td>
<p>XS</p>
</td>
<td>
<p>6⅞</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td>
<p align="center"><strong>56</strong></p>
</td>
<td>
<p align="center"><strong>22</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>7</p>
</td>
</tr>
<tr>
<td>
<p>57</p>
</td>
<td>
<p align="center"><strong>57</strong></p>
</td>
<td>
<p align="center"><strong>22,4</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>7⅛</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td>
<p align="center"><strong>58</strong></p>
</td>
<td>
<p align="center"><strong>22,8</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>7¼</p>
</td>
</tr>
<tr>
<td>
<p>59</p>
</td>
<td>
<p align="center"><strong>59</strong></p>
</td>
<td>
<p align="center"><strong>23,2</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>7⅜</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td>
<p align="center"><strong>60</strong></p>
</td>
<td>
<p align="center"><strong>23,6</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>7½</p>
</td>
</tr>
<tr>
<td>
<p>61</p>
</td>
<td>
<p align="center"><strong>61</strong></p>
</td>
<td>
<p align="center"><strong>24</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>7⅝</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td>
<p align="center"><strong>62</strong></p>
</td>
<td>
<p align="center"><strong>24,4</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>7¾</p>
</td>
</tr>
<tr>
<td>
<p>63</p>
</td>
<td>
<p align="center"><strong>63</strong></p>
</td>
<td>
<p align="center"><strong>24,8</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>7⅞</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td>
<p align="center"><strong>64</strong></p>
</td>
<td>
<p align="center"><strong>25</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>8</p>
</td>
</tr>
<tr>
<td>
<p>65</p>
</td>
<td>
<p align="center"><strong>65</strong></p>
</td>
<td>
<p align="center"><strong>25,6</strong></p>
</td>
<td>
<p>XXXXL</p>
</td>
<td>
<p>8⅛</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Нижнее белье для мужчин',
            'content' => '<table style="float: left" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Таблица размеров  нижнего белья для мужчин</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Таблица размеров  нижнего белья для мужчин" title="Таблица размеров  нижнего белья для мужчин"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top"  width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
<tbody>
<tr>
<td>
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td>
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td>
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td>
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td>
<p align="center"><strong>Англия</strong></p>
</td>
<td>
<p align="center"><strong>США</strong></p>
</td>
<td>
<p align="center"><strong>Европа</strong></p>
</td>
<td>
<p align="center"><strong>Италия</strong></p>
</td>
</tr>
<tr>
<td>
<p>44</p>
</td>
<td>
<p align="center"><strong>78</strong></p>
</td>
<td>
<p align="center"><strong>95,6</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>36</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>42</p>
</td>
</tr>
<tr>
<td>
<p>46</p>
</td>
<td>
<p align="center"><strong>82</strong></p>
</td>
<td>
<p align="center"><strong>98,6</strong></p>
</td>
<td>
<p>S</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>38</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>44</p>
</td>
</tr>
<tr>
<td>
<p>48</p>
</td>
<td>
<p align="center"><strong>84</strong></p>
</td>
<td>
<p align="center"><strong>101,6</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>40</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
</tr>
<tr>
<td>
<p>50</p>
</td>
<td>
<p align="center"><strong>88</strong></p>
</td>
<td>
<p align="center"><strong>104,6</strong></p>
</td>
<td>
<p>M</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
</tr>
<tr>
<td>
<p>52</p>
</td>
<td>
<p align="center"><strong>92</strong></p>
</td>
<td>
<p align="center"><strong>107,6</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>42</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
</tr>
<tr>
<td>
<p>54</p>
</td>
<td>
<p align="center"><strong>96</strong></p>
</td>
<td>
<p align="center"><strong>110,6</strong></p>
</td>
<td>
<p>L</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>44</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
</tr>
<tr>
<td>
<p>56</p>
</td>
<td>
<p align="center"><strong>100</strong></p>
</td>
<td>
<p align="center"><strong>113,6</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>46</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
</tr>
<tr>
<td>
<p>58</p>
</td>
<td>
<p align="center"><strong>104</strong></p>
</td>
<td>
<p align="center"><strong>116,6</strong></p>
</td>
<td>
<p>XL</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>48</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
</tr>
<tr>
<td>
<p>60</p>
</td>
<td>
<p align="center"><strong>108</strong></p>
</td>
<td>
<p align="center"><strong>119,6</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>50</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
</tr>
<tr>
<td>
<p>62</p>
</td>
<td>
<p align="center"><strong>112</strong></p>
</td>
<td>
<p align="center"><strong>122,6</strong></p>
</td>
<td>
<p>XXL</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>52</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
</tr>
<tr>
<td>
<p>64</p>
</td>
<td>
<p align="center"><strong>116</strong></p>
</td>
<td>
<p align="center"><strong>125,6</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>54</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
</tr>
<tr>
<td>
<p>66</p>
</td>
<td>
<p align="center"><strong>120</strong></p>
</td>
<td>
<p align="center"><strong>128,6</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>56</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
</tr>
<tr>
<td>
<p>68</p>
</td>
<td>
<p align="center"><strong>124</strong></p>
</td>
<td>
<p align="center"><strong>131,6</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>58</p>
</td>
<td>
<p>62</p>
</td>
<td>
<p>66</p>
</td>
</tr>
<tr>
<td>
<p>70</p>
</td>
<td>
<p align="center"><strong>128</strong></p>
</td>
<td>
<p align="center"><strong>134,6</strong></p>
</td>
<td>
<p>XXXL</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>60</p>
</td>
<td>
<p>64</p>
</td>
<td>
<p>68</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>

      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
        [
            'label' => 'Нижнее белье и купальники',
            'content' => '<table style="float:left" width="100%" border="0" cellpadding="8" cellspacing="0">
      <tbody><tr>
        <td width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="pageHeading"><h1>Размеры нижнего белья и купальников</h1></td>
            <!--td align="right"><img src="http://odezhda-master.ru/imagemagic.php?img=templates/Original/images/content/reviews.gif&w=240&h=169&page=" width="85" height="60" border="0" alt="Размеры нижнего белья и купальников" title="Размеры нижнего белья и купальников"></td-->
          </tr>
        </tbody></table></td>
      </tr>


<!-- body_text //-->
    <tr><td valign="top" width="100%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td class="main">
          <p></p><table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="13">
<p><strong>БЮСТГАЛЬТЕРЫ</strong></p>
</td>
<td valign="middle" align="center">&nbsp;</td>
</tr>
<tr>
<td style="background-color: #9acd32;" rowspan="2">
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td style="background-color: #9acd32;" colspan="6">
<p align="center"><strong>Обхват груди (см) Чашечка</strong></p>
</td>
<td style="background-color: #9acd32;" rowspan="2">
<p align="center"><strong>Обхват под грудью (см)</strong></p>
</td>
<td style="background-color: #9acd32;" rowspan="2">
<p align="center"><strong>США</strong></p>
</td>
<td style="background-color: #9acd32;" rowspan="2" colspan="2">
<p align="center"><strong>Англия</strong></p>
</td>
<td style="background-color: #9acd32;" rowspan="2">
<p align="center"><strong>Европа</strong></p>
</td>
<td style="background-color: #9acd32;" rowspan="2">
<p align="center"><strong>Италия</strong></p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;">
<p align="center"><strong>A</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>B</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>C</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>D</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>E</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>F</strong></p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>65</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>78-79</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>80-81</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>82-83</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>84-85</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>86-87</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88-89</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>62-67</strong></p>
</td>
<td valign="middle" align="center">
<p>30(A-F)</p>
</td>
<td valign="middle" align="center">
<p>30(A-F)</p>
</td>
<td valign="middle" align="center">
<p>XS</p>
</td>
<td valign="middle" align="center">
<p>80(A-F)</p>
</td>
<td valign="middle" align="center">
<p>-</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>70</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>83-84</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>85-86</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>87-88</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>89-90</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>91-92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>93-94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>68-72</strong></p>
</td>
<td valign="middle" align="center">
<p>32(A-F)</p>
</td>
<td valign="middle" align="center">
<p>32(A-F)</p>
</td>
<td valign="middle" align="center">
<p>S</p>
</td>
<td valign="middle" align="center">
<p>85(A-F)</p>
</td>
<td valign="middle" align="center">
<p>1</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>75</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88-89</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>90-91</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>92-93</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>94-95</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>96-97</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>98-99</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>73-77</strong></p>
</td>
<td valign="middle" align="center">
<p>34(A-F)</p>
</td>
<td valign="middle" align="center">
<p>34(A-F)</p>
</td>
<td valign="middle" align="center">
<p>M</p>
</td>
<td valign="middle" align="center">
<p>90(A-F)</p>
</td>
<td valign="middle" align="center">
<p>2</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>80</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>93-94</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>95-96</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>97-98</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>99-100</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>101-102</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>103-104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>78-82</strong></p>
</td>
<td valign="middle" align="center">
<p>36(A-F)</p>
</td>
<td valign="middle" align="center">
<p>36(A-F)</p>
</td>
<td valign="middle" align="center">
<p>L</p>
</td>
<td valign="middle" align="center">
<p>95(A-F)</p>
</td>
<td valign="middle" align="center">
<p>3</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>85</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>98-99</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>100-101</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>102-103</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>104-105</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>106-107</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>108-109</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>83-87</strong></p>
</td>
<td valign="middle" align="center">
<p>38(A-F)</p>
</td>
<td valign="middle" align="center">
<p>38(A-F)</p>
</td>
<td valign="middle" align="center">
<p>XL</p>
</td>
<td valign="middle" align="center">
<p>100<br> (A-F)</p>
</td>
<td valign="middle" align="center">
<p>4</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>90</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>103-104</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>105-106</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>107-108</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>109-110</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>111-112</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>113-114</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88-92</strong></p>
</td>
<td valign="middle" align="center">
<p>40(A-F)</p>
</td>
<td valign="middle" align="center">
<p>40(A-F)</p>
</td>
<td valign="middle" align="center">
<p>-</p>
</td>
<td valign="middle" align="center">
<p>105<br> (A-F)</p>
</td>
<td valign="middle" align="center">
<p>5</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>95</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>108-109</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>110-111</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>112-113</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>114-115</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>116-117</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>118-119</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>93-97</strong></p>
</td>
<td valign="middle" align="center">
<p>42(A-F)</p>
</td>
<td valign="middle" align="center">
<p>42(A-F)</p>
</td>
<td valign="middle" align="center">
<p>-</p>
</td>
<td valign="middle" align="center">
<p>110<br> (A-F)</p>
</td>
<td valign="middle" align="center">
<p>6</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>100</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>113-114</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>115-116</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>117-118</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>119-120</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>121-122</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>123-124</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>98-102</strong></p>
</td>
<td valign="middle" align="center">
<p>44(A-F)</p>
</td>
<td valign="middle" align="center">
<p>44(A-F)</p>
</td>
<td valign="middle" align="center">
<p>-</p>
</td>
<td valign="middle" align="center">
<p>115<br> (A-F)</p>
</td>
<td valign="middle" align="center">
<p>7</p>
</td>
<td valign="middle" align="center">
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table class="table">
<tbody>
<tr>
<td style="background-color: #9acd32;" colspan="8">
<p><strong>НИЖНЕЕ БЕЛЬЁ</strong></p>
</td>
</tr>
<tr>
<td style="background-color: #9acd32;">
<p align="center"><strong>Россий-<br> ский размер</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Обхват талии (см)</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Обхват бедер (см)</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Междуна-<br> родный размер</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Англия</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>США</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Европа</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>Италия</strong></p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>38</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>58</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>82</strong></p>
</td>
<td valign="middle" align="center">
<p>XXS</p>
</td>
<td valign="middle" align="center">
<p>4</p>
</td>
<td valign="middle" align="center">
<p>0</p>
</td>
<td valign="middle" align="center">
<p>32</p>
</td>
<td valign="middle" align="center">
<p>0</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>40</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>62</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>86</strong></p>
</td>
<td valign="middle" align="center">
<p>XS</p>
</td>
<td valign="middle" align="center">
<p>6</p>
</td>
<td valign="middle" align="center">
<p>2</p>
</td>
<td valign="middle" align="center">
<p>34</p>
</td>
<td valign="middle" align="center">
<p>I</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>42</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>65</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>92</strong></p>
</td>
<td valign="middle" align="center">
<p>S</p>
</td>
<td valign="middle" align="center">
<p>8</p>
</td>
<td valign="middle" align="center">
<p>4</p>
</td>
<td valign="middle" align="center">
<p>36</p>
</td>
<td valign="middle" align="center">
<p>II</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>44</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>68</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>96</strong></p>
</td>
<td valign="middle" align="center">
<p>M</p>
</td>
<td valign="middle" align="center">
<p>10</p>
</td>
<td valign="middle" align="center">
<p>6</p>
</td>
<td valign="middle" align="center">
<p>38</p>
</td>
<td valign="middle" align="center">
<p>III</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>46</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>74</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>100</strong></p>
</td>
<td valign="middle" align="center">
<p>M</p>
</td>
<td valign="middle" align="center">
<p>12</p>
</td>
<td valign="middle" align="center">
<p>8</p>
</td>
<td valign="middle" align="center">
<p>40</p>
</td>
<td valign="middle" align="center">
<p>IV</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>48</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>78</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>104</strong></p>
</td>
<td valign="middle" align="center">
<p>L</p>
</td>
<td valign="middle" align="center">
<p>14</p>
</td>
<td valign="middle" align="center">
<p>10</p>
</td>
<td valign="middle" align="center">
<p>42</p>
</td>
<td valign="middle" align="center">
<p>V</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>50</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>82</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>108</strong></p>
</td>
<td valign="middle" align="center">
<p>L</p>
</td>
<td valign="middle" align="center">
<p>16</p>
</td>
<td valign="middle" align="center">
<p>12</p>
</td>
<td valign="middle" align="center">
<p>44</p>
</td>
<td valign="middle" align="center">
<p>VI</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>52</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>85</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>112</strong></p>
</td>
<td valign="middle" align="center">
<p>XL</p>
</td>
<td valign="middle" align="center">
<p>18</p>
</td>
<td valign="middle" align="center">
<p>14</p>
</td>
<td valign="middle" align="center">
<p>46</p>
</td>
<td valign="middle" align="center">
<p>VII</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>54</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>88</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>116</strong></p>
</td>
<td valign="middle" align="center">
<p>XL</p>
</td>
<td valign="middle" align="center">
<p>20</p>
</td>
<td valign="middle" align="center">
<p>16</p>
</td>
<td valign="middle" align="center">
<p>48</p>
</td>
<td valign="middle" align="center">
<p>VIII</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>56</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>92</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>120</strong></p>
</td>
<td valign="middle" align="center">
<p>XXL</p>
</td>
<td valign="middle" align="center">
<p>22</p>
</td>
<td valign="middle" align="center">
<p>18</p>
</td>
<td valign="middle" align="center">
<p>50</p>
</td>
<td valign="middle" align="center">
<p>IX</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>58</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>97</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>124</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>24</p>
</td>
<td valign="middle" align="center">
<p>20</p>
</td>
<td valign="middle" align="center">
<p>52</p>
</td>
<td valign="middle" align="center">
<p>X</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>60</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>101</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>128</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>26</p>
</td>
<td valign="middle" align="center">
<p>22</p>
</td>
<td valign="middle" align="center">
<p>54</p>
</td>
<td valign="middle" align="center">
<p>XI</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>62</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>106</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>132</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>28</p>
</td>
<td valign="middle" align="center">
<p>24</p>
</td>
<td valign="middle" align="center">
<p>56</p>
</td>
<td valign="middle" align="center">
<p>XII</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>64</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>110</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>136</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>30</p>
</td>
<td valign="middle" align="center">
<p>26</p>
</td>
<td valign="middle" align="center">
<p>58</p>
</td>
<td valign="middle" align="center">
<p>XIII</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>66</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>114</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>140</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>32</p>
</td>
<td valign="middle" align="center">
<p>28</p>
</td>
<td valign="middle" align="center">
<p>60</p>
</td>
<td valign="middle" align="center">
<p>XIV</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>68</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>118</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>144</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>34</p>
</td>
<td valign="middle" align="center">
<p>30</p>
</td>
<td valign="middle" align="center">
<p>62</p>
</td>
<td valign="middle" align="center">
<p>XV</p>
</td>
</tr>
<tr>
<td valign="middle" align="center">
<p>70</p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>122</strong></p>
</td>
<td style="background-color: #9acd32;">
<p align="center"><strong>148</strong></p>
</td>
<td valign="middle" align="center">
<p>XXXL</p>
</td>
<td valign="middle" align="center">
<p>36</p>
</td>
<td valign="middle" align="center">
<p>32</p>
</td>
<td valign="middle" align="center">
<p>64</p>
</td>
<td valign="middle" align="center">
<p>XVI</p>
</td>
</tr>
</tbody>
</table><p></p>
        </td>
      </tr>
      <tr>
        <td class="smallText" align="left">Эта статья была опубликована 24 Сентябрь 2014 г..</td>
      </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>

<!-- tell_a_friend //-->
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
          <tr>
            <td>
            </td>
          </tr>
      <tr>
        <td><img src="images/pixel_trans.gif" alt="" height="1" width="1" border="0"></td>
      </tr>
<!-- tell_a_friend_eof //-->
      <tr>
        <td>

        </td>
      </tr>
    </tbody></table></td>
<!-- body_text_eof //-->


   </tr></tbody></table>',

        ],
    ]]); ?>
</div>

