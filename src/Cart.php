<?php

namespace CarPricingService;


class Cart extends Model
{
    use PrintToScreen;

    private $products = [];
    /** @var  Promotion $promotion */
    private $promotion;
    private $total = 0;
    private $granTotal = 0;
    /** @var  Promotion $promotionApplied */
    private $promotionApplied;

    public function __construct($id, $name, $products = [], $promotion )
    {
        $this->products = $products;
        $this->promotion = $promotion;

        parent::__construct($id, $name);
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getGranTotal()
    {
        return $this->granTotal;
    }

    /**
     * @return Promotion
     */
    public function getPromotionApplied()
    {
        return $this->promotionApplied;
    }

    public function calculate()
    {
        foreach ($this->products as $product) {
            $this->total += $product->getPrice();
        }

        $this->granTotal = $this->total;

        $this->promotionApplied = $this->promotion->calculatePromotion($this->products);

        if ($this->promotionApplied) {
            $this->granTotal = ($this->total - ($this->promotionApplied->getDiscount() / 100) * $this->total);
        }
    }
}