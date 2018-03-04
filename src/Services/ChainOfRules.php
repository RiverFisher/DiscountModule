<?php

namespace App\Services;

use App\Entity\Product;
use App\Entity\Rule;

class ChainOfRules
{
  /**
   * @var array
   */
  private $rules;

  /**
   * @var float
   */
  private $totalDiscountCoefficient;

  /**
   * @var array
   */
  private $products;

  /**
   * @var array
   */
  private $calculatedProducts;

  /**
   * ChainOfRules constructor
   */
  public function __construct()
  {
    $this->rules = [];
    $this->totalDiscountCoefficient = 1;
    $this->products = [];
  }

  /**
   * @return array
   */
  public function getRules(): array
  {
    return $this->rules;
  }

  /**
   * @param Rule $rule
   */
  public function addRule(Rule $rule)
  {
    if (!in_array($rule, $this->rules)) {
      $this->rules[] = $rule;
    }
  }

  /**
   * @param string $ruleName
   */
  public function removeRule(string $ruleName)
  {
    foreach ($this->rules as $key => $value) {
      if ($value->getName() === $ruleName) {
        unset($this->rules[$key]);
      }
    }
  }

  /**
   * @return float|null
   */
  public function getTotalDiscountCoefficient(): ?float
  {
    return $this->totalDiscountCoefficient;
  }

  /**
   * @param float|null $coefficient
   */
  public function setTotalDiscountCoefficient(?float $coefficient)
  {
    $this->totalDiscountCoefficient = $coefficient;
  }

  /**
   * @return array
   */
  public function getProducts(): array
  {
    return $this->products;
  }

  /**
   * @param Product $product
   */
  public function addProduct(Product $product)
  {
    if (!in_array($product, $this->products)) {
      $this->products[] = $product;
    }
  }

  /**
   * @param string $productName
   */
  public function removeProduct(string $productName)
  {
    foreach ($this->products as $key => $value) {
      if ($value->getName() === $productName) {
        unset($this->products[$key]);
      }
    }
  }

  /**
   * @return array
   */
  public function getCalculatedProducts(): array
  {
    return $this->calculatedProducts;
  }

  /**
   * @param array $calculatedProducts
   */
  public function setCalculatedProducts(array $calculatedProducts)
  {
    $this->calculatedProducts = $calculatedProducts;
  }

  public function calculate() {
    $data = ['products' => $this->getProducts(), 'totalDiscount' => $this->getTotalDiscountCoefficient()];

    foreach ($this->rules as $rule) {
      $data = $rule->calculate($data);
    }

    $this->calculatedProducts = $data['products'];
    $this->totalDiscountCoefficient = $data['totalDiscount'];
  }
}
