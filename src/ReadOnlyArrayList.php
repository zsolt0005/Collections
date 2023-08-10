<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use ArrayIterator;
use IteratorAggregate;
use Zsolt\Collections\Exceptions\NotFoundException;
use Zsolt\Collections\Traits\ArrayListTrait;

/**
 * Read only array list.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue
 * @implements IteratorAggregate<int, TValue>
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

  use ArrayListTrait;

  /**
   * Get the array representation of the {@see ReadOnlyArrayList}.
   *
   * @return array<int, TValue>
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
  public function size(): int
  {
    return count($this->array);
  }

  /**
   * Get the element at the given index. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @param int $index
   *
   * @return TValue|null
   */
  public function getNullable(int $index): mixed
  {
    return $this->array[$index] ?? null;
  }

  /**
   * Get the element at the given index. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int $index
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function get(int $index): mixed
  {
    return $this->getNullable($index) ?? throw new NotFoundException();
  }

  /**
   * Checks whether the given key exists.
   *
   * @param int $index
   *
   * @return bool
   */
  public function hasIndex(int $index): bool
  {
    return isset($this->array[$index]);
  }

  /**
   * Gets all the existing keys.
   *
   * @return int[]
   */
  public function getIndexes(): array
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
   * @return int|null
   */
  public function indexOf(mixed $value): int|null
  {
    /** @var int|false $index */
    $index = array_search($value, $this->array, true);
    return $index === false ? null : $index;
  }

  /**
   * First index in the array. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return int|null
   */
  public function getFirstNullableIndex(): int|null
  {
    return $this->getIndexes()[0] ?? null;
  }

  /**
   * First index in the array. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return int
   * @throws NotFoundException
   */
  public function getFirstIndex(): int
  {
    return $this->getFirstNullableIndex() ?? throw new NotFoundException();
  }

  /**
   * Last index in the array. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return int|null
   */
  public function getLastNullableIndex(): int|null
  {
    $keys = $this->getIndexes();

    return !empty($keys)
      ? $keys[count($keys) - 1]
      : null;
  }

  /**
   * Last index in the array. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return int
   * @throws NotFoundException
   */
  public function getLastIndex(): int
  {
    return $this->getLastNullableIndex() ?? throw new NotFoundException();
  }

  /**
   * Gets the first value. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return TValue|null
   */
  public function getNullableFirst(): mixed
  {
    $firstKey = $this->getFirstNullableIndex();

    return $firstKey !== null
      ? $this->array[$firstKey]
      : null;
  }

  /**
   * Gets the first value. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function getFirst(): mixed
  {
    return $this->getNullableFirst() ?? throw new NotFoundException();
  }

  /**
   * Gets the last value. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return TValue|null
   */
  public function getNullableLast(): mixed
  {
    $lastKey = $this->getLastNullableIndex();

    return $lastKey !== null
      ? $this->array[$lastKey]
      : null;
  }

  /**
   * Gets the last value. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function getLast(): mixed
  {
    return $this->getNullableLast() ?? throw new NotFoundException();
  }

  /**
   * ForEach.
   *
   * @param callable(TValue): void $callback
   *
   * @return void
   */
  public function foreach(callable $callback): void
  {
    foreach($this->array as $value)
    {
      $callback($value);
    }
  }

  /**
   * ForEach with keys.
   *
   * @param callable(int, TValue): void $callback
   *
   * @return void
   */
  public function foreachIndexed(callable $callback): void
  {
    foreach($this->array as $key => $value)
    {
      $callback($key, $value);
    }
  }

  /**
   * ForEach <b>REVERSED</b>.
   *
   * @param callable(TValue): void $callback
   *
   * @return void
   */
  public function foreachReversed(callable $callback): void
  {
    $keys = $this->getIndexes();
    for($i = count($keys) - 1; $i >= 0; $i--)
    {
      $key = $keys[$i];
      $callback($this->array[$key]);
    }
  }

  /**
   * ForEach with keys <b>REVERSED</b>.
   *
   * @param callable(int, TValue): void $callback
   *
   * @return void
   */
  public function foreachIndexedReversed(callable $callback): void
  {
    $keys = $this->getIndexes();
    for($i = count($keys) - 1; $i >= 0; $i--)
    {
      $key = $keys[$i];
      $callback($key, $this->array[$key]);
    }
  }

  /**
   * Gets the internal array iterator.
   *
   * @return ArrayIterator<int, TValue>
   */
  public function getIterator(): ArrayIterator
  {
    return new ArrayIterator($this->array);
  }
}