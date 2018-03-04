<?php

namespace App\Entity;

include ('RuleInterface.php');

use RuleInterface;

abstract class Rule implements RuleInterface
{
  /**
   * @var ?int
   */
  private $id;

  /**
   * @var
   */
  private $name;

  /**
   * @var ?string
   */
  private $description;

  /**
   * Rule constructor
   */
  public function __construct()
  {
    $this->name = get_class($this);
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
   * @return null|string
   */
  public function getName(): ?string
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
   * @return string|null
   */
  public function getDescription(): ?string
  {
    return $this->description;
  }

  /**
   * @param null|string $description
   */
  public function setDescription(?string $description)
  {
    $this->description = $description;
  }
}
