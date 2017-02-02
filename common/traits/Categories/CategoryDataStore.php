<?php

namespace common\traits\Categories;


class CategoryDataStore
{
    protected $cat = [];
    protected $name = [];
    protected $template = [];
    protected $theme = [];

    public function __construct($cat, $name, $template, $theme)
    {
        $this->cat = $cat;
        $this->name = $name;
        $this->template = $template;
        $this->theme = $theme;
    }

    /**
     * @return array
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getTheme()
    {
        return $this->theme;
    }
}