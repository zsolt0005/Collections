<?php declare(strict_types = 1);

namespace Zsolt\Collections\List;

use Zsolt\Collections\Exceptions\NotFoundException;

/**
 * Array list.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue
 * @extends ReadOnlyArrayList<TValue>
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
   * Adds a new value to the beginning.
   *
   * @param TValue $value
   *
   * @return void
   */
  public function prepend(mixed $value): void
  {
    array_unshift($this->array, $value);
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
   * @param array<int, TValue> $array
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

  /**
   * Removes the first element. <br>
   * <b>If empty,</b> fails with <b>{@see NotFoundException}</b>. <br>
   *
   * <b>Caution!</b> After removing an element of the array, the values keep the original keys. So if we remove an element
   *  with the index of 0, the first element will have an index of 1.
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeFirst(): void
  {
    $firstKey = $this->getFirstIndex();
    unset($this->array[$firstKey]);
  }

  /**
   * Removes the last element. <br>
   * <b>If empty,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeLast(): void
  {
    $firstKey = $this->getLastIndex();
    unset($this->array[$firstKey]);
  }

  /**
   * Remove by index.
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int $index
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeByIndex(int $index): void
  {
    if(!$this->hasIndex($index))
    {
      throw new NotFoundException();
    }

    unset($this->array[$index]);
  }

  /**
   * Remove by multiple indexes.
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int ...$indexes
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeByIndexes(int ...$indexes): void
  {
    foreach($indexes as $key)
    {
      $this->removeByIndex($key);
    }
  }

  /**
   * Remove by value.
   *  <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param TValue $value
   *
   * @return void
   * @throws NotFoundException
   */
  public function remove(mixed $value): void
  {
    $key = $this->indexOf($value);
    if($key === null)
    {
      throw new NotFoundException();
    }

    $this->removeByIndex($key);
  }

  /**
   * Removes all give values.
   *  <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param TValue $values
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeRange(mixed ...$values): void
  {
    foreach($values as $value)
    {
      $this->remove($value);
    }
  }

  /**
   * Returns the first element of the array **and removes it**. <br>
   * <b>If not found,</b> returns <b>{@see null}</b>.
   *
   * @return TValue|null
   */
  public function shiftNullable(): mixed
  {
    return array_shift($this->array);
  }

  /**
   * Returns the first element of the array **and removes it**. <br>
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function shift(): mixed
  {
    return $this->shiftNullable() ?? throw new NotFoundException();
  }

  /**
   * Returns the last element of the array **and removes it**. <br>
   * <b>If not found,</b> returns <b>{@see null}</b>.
   *
   * @return TValue|null
   */
  public function popNullable(): mixed
  {
    return array_pop($this->array);
  }

  /**
   * Returns the last element of the array **and removes it**. <br>
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @return TValue
   * @throws NotFoundException
   */
  public function pop(): mixed
  {
    return $this->popNullable() ?? throw new NotFoundException();
  }

  /**
   * Returns a {@see ReadOnlyArrayList} version of the current {@see ArrayList}.
   *
   * @return ReadOnlyArrayList<TValue>
   */
  public function toReadOnlyArrayList(): ReadOnlyArrayList
  {
    return ReadOnlyArrayList::fromArray($this->array);
  }
}