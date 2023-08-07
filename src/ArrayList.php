<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Array list.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TKey of int|string
 * @template TValue
 * @extends ReadOnlyArrayList<TKey, TValue>
 */
class ArrayList extends ReadOnlyArrayList
{
  /**
   * Constructor.
   *
   * @param TValue ...$values
   */
  public function __construct(mixed ...$values)
  {
    parent::__construct(...$values);
  }

  /**
   * Create an empty {@see ArrayList}.
   *
   * @return self<int|string, mixed>
   */
  public static function empty(): self
  {
    return new self();
  }

  /**
   * Create {@see ArrayList} from values.
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
   * Create {@see ArrayList} from array.
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

  /**
   * Adds a new value.
   *
   * @param TValue $value
   *
   * @return void
   */
  public function add(mixed $value): void
  {
    $this->array[] = $value;
  }

  /**
   * Adds multiple values.
   *
   * @param TValue ...$values
   *
   * @return void
   */
  public function addRange(mixed ...$values): void
  {
    $this->array = [...$this->array, ...$values];
  }


  // addAt
  // Clear
  // Remove
  // RemoveRange
  // RemoveAt
  // RemoveAtRange
  // RemoveFirst
  // RemoveLast

  // OVERRIDE Sorted
  // OVERRIDE Reversed
}