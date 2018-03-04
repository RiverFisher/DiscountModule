<?php

namespace App\Entity;

class Product
{
  /**
   * @var ?int
   */
  private $id;

  /**
   * @var ?string
   */
  private $name;

  /**
   * @var ?int
   */
  private $cost;

  /**
   * @var bool
   */
  private $selected;

  /**
   * Product constructor
   *
   * @param string $name
   * @param int|null $cost
   */
  public function __construct(string $name, int $cost = null)
  {
    $this->selected = false;

    $this->name = $name;
    $this->cost = $cost;
  }

  /**
   * @return int|null
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param int|null $id
   */
  public function setId(?int $id)
  {
    $this->id = $id;
  }

  /**
   * @return string|null
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param null|string $name
   */
  public function setName(?string $name)
  {
    $this->name = $name;
  }

  /**
   * @return bool
   */
  public function isSelected(): bool
  {
    return $this->selected;
  }

  /**
   * @param bool $selected
   */
  public function setSelected(bool $selected)
  {
    $this->selected = $selected;
  }

  /**
   * @return int|null
   */
  public function getCost()
  {
    return $this->cost;
  }

  /**
   * @param int|null $cost
   */
  public function setCost(?int $cost)
  {
    $this->cost = $cost;
  }
}
