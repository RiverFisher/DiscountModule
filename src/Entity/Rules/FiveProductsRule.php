<?php

namespace App\Entity\Rules;

use App\Entity\Product;
use App\Entity\Rule;

class FiveProductsRule extends Rule
{
  /**
   * @param array $data
   * @return array
   */
  public function calculate(array $data)
  {
    $numberOfDiscountProducts = 0;
    foreach ($data['products'] as $product) {
      if ($product->getName() !== 'A' && $product->getName() !== 'C') {
        $numberOfDiscountProducts++;
      }
    }
    if ($numberOfDiscountProducts >= 5) {
      $totalDiscount = $data['totalDiscount'] * 0.2;
    }

    return [
      'products' => $data['products'],
      'totalDiscount' => isset($totalDiscount) ? $totalDiscount : $data['totalDiscount']
    ];
  }
}
