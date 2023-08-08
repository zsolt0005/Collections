<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use Zsolt\Collections\Exceptions\NotFoundException;
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
    $firstKey = $this->firstKey();
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
    $firstKey = $this->lastKey();
    unset($this->array[$firstKey]);
  }

  /**
   * Remove by key.
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int|string $key
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeByKey(int|string $key): void
  {
    if(!$this->hasKey($key))
    {
      throw new NotFoundException();
    }

    unset($this->array[$key]);
  }

  /**
   * Remove by multiple keys.
   * <b>If not found,</b> fails with <b>{@see NotFoundException}</b>.
   *
   * @param int|string ...$keys
   *
   * @return void
   * @throws NotFoundException
   */
  public function removeByKeys(int|string ...$keys): void
  {
    foreach($keys as $key)
    {
      $this->removeByKey($key);
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

    $this->removeByKey($key);
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
}