<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use ArrayIterator;
use IteratorAggregate;

/**
 * Read only array list.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TKey of int|string
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 */
class ReadOnlyArrayList implements IteratorAggregate
{
  /** @var TValue[] Underlying array of the {@see ReadOnlyArrayList} data type. */
  protected array $array = [];

  /**
   * Constructor.
   *
   * @param TValue ...$values
   */
  public function __construct(mixed ...$values)
  {
    $this->array = $values;
  }

  /**
   * Create an empty {@see ReadOnlyArrayList}.
   *
   * @return self<int|string, mixed>
   */
  public static function empty(): self
  {
    return new self();
  }

  /**
   * Create {@see ReadOnlyArrayList} from values.
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
   * Create {@see ReadOnlyArrayList} from array.
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
   * Get the array representation of the {@see ReadOnlyArrayList}. <br>
   * <b>Important!</b> This method creates a copy of the data stored in it.
   *
   * @return array<TKey, TValue>
   */
  public function toArray(): array
  {
    return $this->array;
  }

  /**
   * To string.
   *
   * @return string
   */
  public function toString(): string
  {
    return '[' . implode(', ', $this->array) . ']';
  }

  /**
   * To string.
   *
   * @return string
   */
  public function __toString(): string
  {
    return $this->toString();
  }

  /**
   * Gets the count of all values.
   *
   * @return int
   */
  public function count(): int
  {
    return count($this->array);
  }

  /**
   * Get the element at the given index. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @param TKey $index
   *
   * @return TValue|null
   */
  public function getNullable(int|string $index): mixed
  {
    return $this->array[$index] ?? null;
  }

  /**
   * Get the element at the given index. <br>
   * <b>If not found</b> fails with <b>Undefined array key</b> warning message.
   *
   * @param TKey $index
   *
   * @return TValue
   */
  public function get(int|string $index): mixed
  {
    return $this->array[$index];
  }

  // Contains
  // Find
  // FindAll
  // FindIndex
  // First
  // Last
  // FirstIndex
  // LastIndex
  // ForEach
  // IndexOf
  // Sorted
  // Reversed

  /**
   * Gets the internal array iterator.
   *
   * @return ArrayIterator<TKey, TValue>
   */
  public function getIterator(): ArrayIterator
  {
    return new ArrayIterator($this->array);
  }
}