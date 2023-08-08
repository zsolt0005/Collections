<?php

namespace Zsolt\Collections\Traits;

use Zsolt\Collections\Type;

trait ArrayListTrait
{
  /**
   * Create an empty {@see self}. <br>
   * For an empty collection it is necessary to set its type, please use {@see Type}.
   *
   * @template TEmptyValue
   * @param TEmptyValue|null $type
   *
   * @return self<int|string, TEmptyValue>
   */
  public static function empty(mixed $type): self
  {
    return new self();
  }

  /**
   * Create {@see self} from values.
   *
   * @template TValues
   * @param TValues ...$values
   *
   * @return self<int|string, TValues>
   */
  public static function fromValues(mixed ...$values): self
  {
    return new self(...$values);
  }

  /**
   * Create {@see self} from array.
   *
   * @template TArray
   * @param TArray[] $array
   *
   * @return self<int|string, TArray>
   */
  public static function fromArray(array $array): self
  {
    $instance = new self();
    $instance->array = $array;

    return $instance;
  }
}