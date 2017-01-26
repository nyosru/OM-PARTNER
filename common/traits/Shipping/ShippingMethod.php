<?php
namespace common\traits\Shipping;


trait ShippingMethod
{
    public function shippingMethod()
    {
        return [
            'flat2_flat2' => [
                'value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция, из г.Москва',
                'active' => '0',
                'wantpasport' => '0'
            ],
            'flat1_flat1' => [
                'value' => 'Бесплатная доставка до ТК Деловые Линии, из г.Иваново',
                'active' => '0',
                'wantpasport' => '1'],
            'flat3_flat3' => [
                'value' => 'Бесплатная доставка до ТК ПЭК, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'flat11_flat11' => [
                'value' => 'Бесплатная доставка до ТК КИТ, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'flat10_flat10' => [
                'value' => 'Бесплатная доставка до ТК ОПТИМА, из г.Москва',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'flat9_flat9' => [
                'value' => 'Бесплатная доставка до ТК Севертранс http://severtrans-msk.ru/, из г.Москва',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'flat12_flat12' => [
                'value' => 'Бесплатная доставка до ТК ЭНЕРГИЯ, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'flat7_flat7' => [
                'value' => 'Почта ЕМС России, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'russianpostpf_russianpostpf' => [
                'value' => 'Почта России - http://pochta.ru, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0'
            ],
            'courierExpress_courierExpress' => [
                'value' => 'Служба доставки Экспресс-Курьер http://www.edostavka.ru, из г.Иваново',
                'active' => '1',
                'wantpasport' => '0']
        ];
    }
}

