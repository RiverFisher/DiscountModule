<?php

namespace App\Entity\Rules;

use App\Entity\Product;
use App\Entity\Rule;

class DandERule extends Rule
{
  /**
   * @var int
   */
  private $dKey;

  /**
   * @var int
   */
  private $eKey;

  /**
   * @param array $data
   * @return array
   */
  public function calculate(array $data)
  {
    foreach ($data['products'] as $key => $value) {
      if ($value->getName() === 'D') {
        $this->d = $key;
      } elseif ($value->getName() === 'E') {
        $this->e = $key;
      }

      if (isset($this->dKey) && isset($this->eKey)) {
        $data['products'][$this->dKey]->setCost(0.9 * $data['products'][$this->dKey]->getCost());
        $data['products'][$this->eKey]->setCost(0.9 * $data['products'][$this->eKey]->getCost());
        break;
      }
    }

    return [
      'products' => $data['products'],
      'totalDiscount' => $data['totalDiscount']
    ];
  }
}
