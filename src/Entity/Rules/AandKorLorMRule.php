<?php

namespace App\Entity\Rules;

use App\Entity\Product;
use App\Entity\Rule;

class AandKorLorMRule extends Rule
{
  /**
   * @var int
   */
  private $aKey;

  /**
   * @var int
   */
  private $kKey;

  /**
   * @var int
   */
  private $lKey;

  /**
   * @var int
   */
  private $mKey;

  /**
   * @param array $data
   * @return array
   */
  public function calculate(array $data)
  {
    foreach ($data['products'] as $key => $value) {
      if ($value->getName() === 'A') {
        $this->aKey = $key;
      } elseif ($value->getName() === 'K') {
        $this->kKey = $key;
      } elseif ($value->getName() === 'L') {
        $this->lKey = $key;
      } elseif ($value->getName() === 'M') {
        $this->mKey = $key;
      }

      if (isset($this->aKey) && (isset($this->kKey) || isset($this->lKey) || isset($this->mKey))) {
        $data['products'][$this->aKey]->setCost(0.95 * $data['products'][$this->aKey]->getCost());
        if ($this->kKey) {
          $data['products'][$this->kKey]->setCost(0.95 * $data['products'][$this->kKey]->getCost());
        } elseif ($this->lKey) {
          $data['products'][$this->lKey]->setCost(0.95 * $data['products'][$this->lKey]->getCost());
        } elseif ($this->mKey) {
          $data['products'][$this->mKey]->setCost(0.95 * $data['products'][$this->mKey]->getCost());
        }
        break;
      }
    }

    return [
      'products' => $data['products'],
      'totalDiscount' => $data['totalDiscount']
    ];
  }
}
