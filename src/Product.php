<?php

namespace CarPricingService;

class Product extends Model
{
    private $price;
    private $categories = [];
    private $producer;

    public function __construct($id, $name, $price, $categories, $producer)
    {
        $this->price = $price;
        $this->categories = $categories;
        $this->producer = $producer;

        parent::__construct($id, $name);
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getCategoriesNames()
    {
        $categoryNames = [];
        /** @var Category $category */
        foreach ($this->categories as $category) {
            $categoryNames[] = $category->getName();
        }

        return $categoryNames;
    }

    public function setProducer($producer)
    {
        $this->producer = $producer;
    }

    public function getProducer()
    {
        return $this->producer;
    }
}