<?php

namespace CarPricingService;

trait PrintToScreen {

    public function printToScreen()
    {
        $table = "| %5.5s | %-30.30s | %5.5s |\n";
        $br = "--------------------------------------------------\n";

        system('clear');

        echo $br;

        printf($table, "ID", "Product", "Price");

        echo $br;

        /** @var Product $product */
        foreach ($this->products as $product) {
            printf(
                $table,
                $product->getId(),
                $product->getName() . " (" . implode(" ", $product->getCategoriesNames()) . ")",
                $product->getPrice()
            );
        }

        echo $br;

        printf("| %-38.38s | %5.5s |\n", "TOTAL", $this->getTotal());

        if ($this->getPromotionApplied()) {
            echo $br;
            printf(
                "| %5.5s | %-30.30s | %5.5s |\n",
                "PROMO",
                $this->getPromotionApplied()->getName(),
                $this->getPromotionApplied()->getDiscount() . "%"
            );
        }

        echo $br;

        printf("| %-38.38s | %5.5s |\n", "GRAN TOTAL", $this->getGranTotal());

        echo $br;
    }
}
