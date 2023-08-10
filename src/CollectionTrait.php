<?php

namespace Zsolt\Collections;

trait CollectionTrait
{
  /**
   * Factory method to create a new queue. <br>
   * For an empty {@see self} it is necessary to set its type, please use {@see Type}.
   *
   * @template TValueType
   * @param TValueType $type
   *
   * @return self<TValueType>
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
}