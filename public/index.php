<?php

use App\Entity\Product;
use App\Services\ChainOfRules;
use App\Services\Layout;

require __DIR__ . "/../vendor/autoload.php";

$layout = new Layout();

$productNames = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M"];
$costs = [49, 99, 199, 299, 399, 499, 999, 1499, 1999];
$products = [];

foreach ($productNames as $name) {
  $products[] = new Product($name, $costs[array_rand($costs)]);
}

print_r($layout->getColoredString("\r\nYou can select follow products for purchase:\r\n\r\n", "white", null));
print_r($layout->getColoredString("Name\tCost",
  "black", "light_gray"));
print_r($layout->getColoredString("\r\n", "white", null));
foreach ($products as $product) {
  print_r($layout->getColoredString($product->getName() . "\t", "white", null));
  print_r($layout->getColoredString($product->getCost() . "\r\n", "white", null));
}
print_r($layout->getColoredString("\r\n", "white", null));

$farther = false;
do {
  $text = readline("Print name of Product you're going to select or print \q to go to the next stage: ");
  if (in_array($text, $productNames)) {
    foreach ($products as $product) {
      if ($product->getName() == $text) {
        $product->setSelected(true);
        break;
      }
    }
  } elseif ($text == "\q") {
    $farther = true;
  }
} while (!$farther);

print_r($layout->getColoredString("\r\nYou're selected follow products:\r\n\r\n", "white", null));
print_r($layout->getColoredString("Name\tCost\tSelected?",
    "black", "light_gray"));
print_r($layout->getColoredString("\r\n", "white", null));
$numberOfSelectedProducts = 0;
foreach ($products as $product) {
  if ($product->isSelected()) {
    $numberOfSelectedProducts++;
    print_r($layout->getColoredString($product->getName() . "\t", "white", null));
    print_r($layout->getColoredString($product->getCost() . "\t", "white", null));
    print_r($layout->getColoredString("Yes\r\n", "green", null));
  } else {
    print_r($layout->getColoredString($product->getName() . "\t", "white", null));
    print_r($layout->getColoredString($product->getCost() . "\t", "white", null));
    print_r($layout->getColoredString("No\r\n", "red", null));
  }
}
print_r($layout->getColoredString("\r\n", "white", null));

$totalCostOfSelectedProducts = 0;
print_r($layout->getColoredString("Total cost of selected products is: ", "white", null));
foreach ($products as $key => $value) {
  if ($value->isSelected()) {
    $numberOfSelectedProducts--;
    $totalCostOfSelectedProducts += $value->getCost();
    print_r($layout->getColoredString($value->getCost() .
      ($numberOfSelectedProducts > 0 ? " + " : " = "), "white", null));
  }
}
print_r($layout->getColoredString($totalCostOfSelectedProducts . "\r\n\r\n", "white", null));

$chainOfRules = new ChainOfRules();
$chainOfRules->addRule(new \App\Entity\Rules\AandBRule());
$chainOfRules->addRule(new \App\Entity\Rules\DandERule());
$chainOfRules->addRule(new \App\Entity\Rules\EandFandGRule());
$chainOfRules->addRule(new \App\Entity\Rules\AandKorLorMRule());
$chainOfRules->addRule(new \App\Entity\Rules\ThreeProductsRule());
$chainOfRules->addRule(new \App\Entity\Rules\FourProductsRule());
$chainOfRules->addRule(new \App\Entity\Rules\FiveProductsRule());

foreach ($products as $product) {
  if ($product->isSelected()) {
    $chainOfRules->addProduct($product);
  }
}

$chainOfRules->calculate();

$calculatedProducts = $chainOfRules->getCalculatedProducts();
$totalDiscount = $chainOfRules->getTotalDiscountCoefficient();

$saleCost = 0;
$currentProduct = 0;
print_r($layout->getColoredString("But thanks to our discount program total cost of selected products is: ", "white", null));
foreach ($calculatedProducts as $key => $value) {
  $currentProduct++;
  $saleCost += $value->getCost();
  $totalCostOfSelectedProducts += $value->getCost();
  print_r($layout->getColoredString($value->getCost() .
    ($currentProduct < count($calculatedProducts) ? " + " : " = "), "white", null));
}
print_r($layout->getColoredString($saleCost . "\r\n\r\n", "white", null));

print_r($layout->getColoredString("We also provide discount for total products' cost if you bought simultaneously 3 or more products.", "white", null));
print_r($layout->getColoredString(" So you must pay in all " . $saleCost * (1 - $chainOfRules->getTotalDiscountCoefficient()) . " to buy selected products.", "white", null));
