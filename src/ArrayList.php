<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use Zsolt\Collections\Traits\ArrayListTrait;

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

  use ArrayListTrait;

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
    $this->array = array_merge($this->array, $values);
  }

  /**
   * Adds all entries from the give array.
   *
   * @param array<TKey, TValue> $array
   *
   * @return void
   */
  public function addArray(array $array): void
  {
    $this->array = array_merge($this->array, $array);
  }

  /**
   * Clears all values.
   *
   * @return void
   */
  public function clear(): void
  {
    $this->array = [];
  }

  // Remove
  // RemoveRange
  // RemoveByKey
  // RemoveByKeys
  // RemoveFirst
  // RemoveLast
}