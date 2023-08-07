<?php

namespace Zsolt\Collections\Traits;

trait ArrayListTrait
{
  /**
   * Create an empty {@see self}.
   *
   * @return self<int|string, mixed>
   */
  public static function empty(): self
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