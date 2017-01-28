<?php
namespace common\traits\Products;

use yii\helpers\ArrayHelper;

/*
 * Размеры продукта
 */
trait ProductVariants
{
    private $product_sizes = [];
    private $count_product = 0;
    private $count_variants = 0;
    private $isset_variants = true;

    function product_variants($product)
    {
        $data_attr = [
            'prod' => $product['products']['products_id'],
            'model' => $product['products']['products_model'],
            'price' => $product['products']['products_price'],
            'image' => $product['products']['products_image'],
            'name' => $product['productsDescription']['products_name'],
            'min' => $product['products']['products_quantity_order_min'],
            'step' => $product['products']['products_quantity_order_units'],
            'count' => $product['products']['products_quantity'],
            'attrname' => '',
            'attr' => '',
        ];

        if (count($product['productsAttributesDescr']) > 0) {
            $product['productsAttributesDescr'] = ArrayHelper::index($product['productsAttributesDescr'], 'products_options_values_name');
            $product['productsAttributes'] = ArrayHelper::index($product['productsAttributes'], 'options_values_id');

            ksort($product['productsAttributesDescr'], SORT_NATURAL);
            foreach ($product['productsAttributesDescr'] as $item) {
                if ($product['productsAttributes'][$item['products_options_values_id']] && $product['productsAttributes'][$item['products_options_values_id']]['quantity'] > 0) {
                    $data_attr = ArrayHelper::merge($data_attr, [
                        'attrname' => $item['products_options_values_name'],
                        'attr' => $item['products_options_values_id'],
                        'count' => $product['productsAttributes'][$item['products_options_values_id']]['quantity'],
                    ]);
                    $this->product_sizes[] = [
                        'label' => $data_attr['attrname'],
                        'data_attr' => $data_attr,
                    ];
                    $this->count_variants++;
                    $this->count_product += $product['productsAttributes'][$item['products_options_values_id']]['quantity'];
                }
            }
        } else {
            $this->count_product = $product['products']['products_quantity'];
            $this->count_variants = 1;
            $this->isset_variants = false;
            $this->product_sizes = [
                'label' => '',
                'data_attr' => $data_attr,
            ];
        }
        return [
            'sizes' => $this->product_sizes,
            'count_product' => $this->count_product,
            'count_variants' => $this->count_variants,
            'isset_variants' => $this->isset_variants,
        ];
    }
}

?>