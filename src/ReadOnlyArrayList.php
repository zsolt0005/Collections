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
   * @param int|string $key
   *
   * @return TValue
   */
  public function get(int|string $key): mixed
  {
    return $this->array[$key];
  }

  /**
   * Checks whether the given key exists.
   *
   * @param int|string $key
   *
   * @return bool
   */
  public function hasKey(int|string $key): bool
  {
    return isset($this->array[$key]);
  }

  /**
   * Gets all the existing keys.
   *
   * @return TKey[]
   */
  public function getKeys(): array
  {
    return array_keys($this->array);
  }

  /**
   * Check if the value already exists.
   *
   * @param TValue $value
   *
   * @return bool
   */
  public function contains(mixed $value): bool
  {
    return in_array($value, $this->array, true);
  }

  /**
   * Index of the given value if exists, <b>{@see null}</b> otherwise.
   *
   * @param TValue $value
   *
   * @return int|string|null
   */
  public function indexOf(mixed $value): int|string|null
  {
    $index = array_search($value, $this->array, true);
    return $index === false ? null : $index;
  }

  // Find
  // FindAll
  // FindIndex
  // First
  // Last
  // FirstIndex
  // LastIndex
  // ForEach

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