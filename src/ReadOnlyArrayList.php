<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use ArrayIterator;
use IteratorAggregate;
use Zsolt\Collections\Exceptions\NotFoundException;

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
   * @param int|string $index
   *
   * @return TValue|null
   */
  public function getNullable(int|string $index): mixed
  {
    return $this->array[$index] ?? null;
  }

  /**
   * Get the element at the given index. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int|string $key
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function get(int|string $key): mixed
  {
    return $this->getNullable($key) ?? throw new NotFoundException();
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

  /**
   * First key in the array. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return int|string|null
   */
  public function firstNullableKey(): int|string|null
  {
    return array_keys($this->array)[0] ?? null;
  }

  /**
   * First key in the array. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return int|string
   * @throws NotFoundException
   */
  public function firstKey(): int|string
  {
    return $this->firstNullableKey() ?? throw new NotFoundException();
  }

  /**
   * last key in the array. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return int|string|null
   */
  public function lastNullableKey(): int|string|null
  {
    $keys = array_keys($this->array);

    return !empty($keys)
      ? $keys[count($keys) - 1]
      : null;
  }

  /**
   * Last key in the array. <br>
   * <b>If not found</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return int|string
   * @throws NotFoundException
   */
  public function lastKey(): int|string
  {
    return $this->lastNullableKey() ?? throw new NotFoundException();
  }

  /**
   * Gets the first value. <br>
   * <b>If not found</b> return {@see null}.
   *
   * @return TValue|null
   */
  public function getNullableFirst(): mixed
  {
    $firstKey = $this->firstNullableKey();

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
    $lastKey = $this->lastNullableKey();

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
   * @param callable(TKey, TValue): void $callback
   *
   * @return void
   */
  public function foreachWithKeys(callable $callback): void
  {
    foreach($this->array as $key => $value)
    {
      $callback($key, $value);
    }
  }

  // ForEachReversed

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