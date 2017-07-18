<?php

namespace CarPricingService;

class PromotionRule extends Model
{
    private $options = [];
    private $discount;

    public function __construct($id, $name, $options, $discount)
    {
        $this->options = $options;
        $this->discount = $discount;

        parent::__construct($id, $name);
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function isRuleApplied($products)
    {
        $optionsApplied = [];
        /** @var PromotionOption $option */
        foreach ($this->options as $option) {
            if ($option->isOptionApplied($products)) {
                $optionsApplied[] = $option;
            }
        }

        return $optionsApplied;
    }
}