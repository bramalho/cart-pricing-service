<?php
/**
 * Created by PhpStorm.
 * User: brunoramalho-olx
 * Date: 21/03/2017
 * Time: 15:36
 */

namespace CarPricingService;


class Promotion extends Model
{
    private $rules = [];

    public function __construct($id, $name, $rules = [])
    {
        $this->rules = $rules;

        parent::__construct($id, $name);
    }

    public function calculatePromotion($products)
    {
        $rulesApplied = [];
        /** @var PromotionRule $rule */
        foreach($this->rules as $rule) {
            if ($rule->isRuleApplied($products)) {
                $rulesApplied[] = $rule;
            }
        }

        return $this->getBestPromotion($rulesApplied);
    }

    private function getBestPromotion($rulesApplied)
    {
        $bestPromotion = null;
        $bestDiscount = 0;
        /** @var PromotionRule $ruleApplied */
        foreach ($rulesApplied as $ruleApplied) {
            if ($bestDiscount < $ruleApplied->getDiscount()) {
                $bestPromotion = $ruleApplied;
            }
        }

        return $bestPromotion;
    }
}