<?php

namespace App\Entity\Rules;

use App\Entity\Product;
use App\Entity\Rule;

class AandBRule extends Rule
{
  /**
   * @var int
   */
  private $aKey;

  /**
   * @var int
   */
  private $bKey;

  /**
   * @param array $data
   * @return array
   */
  public function calculate(array $data)
  {
    foreach ($data['products'] as $key => $value) {
      if ($value->getName() === 'A') {
        $this->aKey = $key;
      } elseif ($value->getName() === 'B') {
        $this->bKey = $key;
      }

      if (isset($this->aKey) && isset($this->bKey)) {
        $data['products'][$this->aKey]->setCost(0.9 * $data['products'][$this->aKey]->getCost());
        $data['products'][$this->bKey]->setCost(0.9 * $data['products'][$this->bKey]->getCost());
        break;
      }
    }

    return [
      'products' => $data['products'],
      'totalDiscount' => $data['totalDiscount']
    ];
  }
}
