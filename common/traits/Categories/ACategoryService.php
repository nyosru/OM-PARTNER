<?php
namespace common\traits\Categories;

abstract class ACategoryService
{
    protected $cat = [];
    protected $name = [];
    protected $template = [];
    protected $theme = [];

    public function __construct(CategoryDataStore $categoryDataStore) {
        $this->cat = $categoryDataStore->getCat();
        $this->name = $categoryDataStore->getName();
        $this->template = $categoryDataStore->getTemplate();
        $this->theme = $categoryDataStore->getTheme();
    }
}