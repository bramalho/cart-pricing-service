<?php

namespace CarPricingService;

class PromotionOption
{
    private $type;
    private $operator;
    private $value;

    public function __construct($type, $operator, $value)
    {
        $this->type = $type;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function isOptionApplied($products)
    {
        switch ($this->type) {
            case 'quantity':
                return $this->calc([count($products)]);
            case 'category':
                return in_array($this->value, $this->getCategoriesNames($products));
            default:
                return $this->calc($this->getValue($this->type ,$products));
        }
    }

    private function calc($values)
    {
        foreach ($values as $value) {
            switch ($this->operator) {
                case '>':
                    if ($value > $this->value)
                        return true;
                    break;
                case '=':
                    if ($value == $this->value)
                        return true;
                    break;
                default:
                    break;
            }
        }
        return false;
    }

    private function getCategoriesNames($products)
    {
        $categoriesNames = [];
        /** @var Product $product */
        foreach ($products as $product) {
            $categoriesNames[] = $product->getCategoriesNames();
        }

        return $categoriesNames;
    }

    private function getValue($name, $products)
    {
        $values = [];
        foreach ($products as $product) {
            $values[] = $product->{'get' . ucfirst($name)}();
        }
        return $values;
    }
}