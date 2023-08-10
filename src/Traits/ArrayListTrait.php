<?php

namespace Zsolt\Collections\Traits;

use Zsolt\Collections\Type;

trait ArrayListTrait
{
  /**
   * Create an empty {@see self}. <br>
   * For an empty collection it is necessary to set its type, please use {@see Type}.
   *
   * @template TEmpty
   * @param TEmpty|null $type
   *
   * @return self<TEmpty>
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
   * @return self<TValues>
   */
  public static function fromValues(mixed ...$values): self
  {
    return new self(...$values);
  }

  /**
   * Create {@see self} from array.
   *
   * @template TArrayValue
   * @param array<int, TArrayValue> $array
   *
   * @return self<TArrayValue>
   */
  public static function fromArray(array $array): self
  {
    $instance = new self();
    $instance->array = $array;

    return $instance;
  }
}