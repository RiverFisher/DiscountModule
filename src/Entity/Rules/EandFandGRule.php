<?php

namespace App\Entity\Rules;

use App\Entity\Product;
use App\Entity\Rule;

class EandFandGRule extends Rule
{
  /**
   * @var Product
   */
  private $eKey;

  /**
   * @var Product
   */
  private $fKey;

  /**
   * @var Product
   */
  private $gKey;

  /**
   * @param array $data
   * @return array
   */
  public function calculate(array $data)
  {
    foreach ($data['products'] as $key => $value) {
      if ($value->getName() === 'E') {
        $this->eKey = $key;
      } elseif ($value->getName() === 'F') {
        $this->fKey = $key;
      } elseif ($value->getName() === 'G') {
        $this->gKey = $key;
      }

      if (isset($this->eKey) && isset($this->fKey) && isset($this->gKey)) {
        $data['products'][$this->eKey]->setCost(0.95 * $data['products'][$this->eKey]->getCost());
        $data['products'][$this->fKey]->setCost(0.95 * $data['products'][$this->fKey]->getCost());
        $data['products'][$this->gKey]->setCost(0.95 * $data['products'][$this->gKey]->getCost());
        break;
      }
    }

    return [
      'products' => $data['products'],
      'totalDiscount' => $data['totalDiscount']
    ];
  }
}
