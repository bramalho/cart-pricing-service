<?php
include "vendor/autoload.php";

$categoryComputer = new \CarPricingService\Category(1, 'Computer');
$categoryComputerLaptop = new \CarPricingService\Category(2, 'Laptop');
$categoryComputerDesktop = new \CarPricingService\Category(3, 'Desktop');
$categoryPhone = new \CarPricingService\Category(4, 'Phone');

$producerSamsung = new \CarPricingService\Producer(1, 'Samsung');
$producerApple = new \CarPricingService\Producer(2, 'Apple');

$productPhone1 = new \CarPricingService\Product(1, 'iPhone', 1000, [$categoryPhone], $producerApple);
$productPhone2 = new \CarPricingService\Product(2, 'Samsung', 1000, [$categoryPhone], $producerSamsung);

$productComputer1 = new \CarPricingService\Product(3, 'MacBook', 4000, [$categoryComputer, $categoryComputerLaptop], $producerApple);
$productComputer2 = new \CarPricingService\Product(3, 'PC', 4000, [$categoryComputer, $categoryComputerDesktop], $producerSamsung);

$promotionRules = [
    new \CarPricingService\PromotionRule(
        1,
        "Quantity 3",
        [new \CarPricingService\PromotionOption('quantity', '>', 3)],
        0.5
    ),
    new \CarPricingService\PromotionRule(
        2,
        "Category Laptop",
        [new \CarPricingService\PromotionOption('category', '=', 'Laptop')],
        0.75
    ),
    new \CarPricingService\PromotionRule(
        3,
        "Samsung",
        [new \CarPricingService\PromotionOption('producer', '=', 'Samsung')],
        1
    ),
    new \CarPricingService\PromotionRule(
        4,
        "Price 4000",
        [new \CarPricingService\PromotionOption('price', '>', 4000)],
        1.5
    ),
    new \CarPricingService\PromotionRule(
        5,
        "Laptop 4000",
        [
            new \CarPricingService\PromotionOption('category', '=', 'Laptop'),
            new \CarPricingService\PromotionOption('price', '>', 4000),
        ],
        1.25
    ),
    new \CarPricingService\PromotionRule(
        6,
        "Laptop Samsung",
        [
            new \CarPricingService\PromotionOption('category', '=', 'Laptop'),
            new \CarPricingService\PromotionOption('producer', '=', 'Samsung'),
        ],
        1.35
    ),
    new \CarPricingService\PromotionRule(
        7,
        "Laptop 4000, Quantity 3",
        [
            new \CarPricingService\PromotionOption('category', '=', 'Laptop'),
            new \CarPricingService\PromotionOption('price', '>', 4000),
            new \CarPricingService\PromotionOption('quantity', '>', 3),
        ],
        1.75
    ),
];

$cart = new \CarPricingService\Cart(
    1, 'My Cart',
    [
        $productComputer1,
        $productComputer2,
        $productPhone1,
        $productPhone2
    ],
    new \CarPricingService\Promotion(1, 'Great Promotion', $promotionRules));

$cart->calculate();
$cart->printToScreen();
