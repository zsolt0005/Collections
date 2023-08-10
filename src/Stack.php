<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Stack (LIFO).
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue
 * @extends ACollectionBase<TValue>
 */
class Stack extends ACollectionBase
{
  /**
   * Constructor. <br>
   * For a queue it is necessary to set its type, please use {@see Type}.
   *
   * @param TValue $type
   */
  public function __construct(mixed $type)
  {
    /** @var ArrayList<TValue> $emptyList */
    $emptyList = ArrayList::empty($type);

    $this->list = $emptyList;
  }

  /**
   * Factory method to create a new queue. <br>
   * For a queue it is necessary to set its type, please use {@see Type}.
   *
   * @param TValue $type
   *
   * @return self<TValue>
   */
  public static function create(mixed $type): self
  {
    return new self($type);
  }

  /**
   * Adds the given item.
   *
   * @param TValue $value
   *
   * @return void
   */
  public function push(mixed $value): void
  {
    $this->list->add($value);
  }

  /**
   * Pops the next item.
   *
   * @return TValue|null
   */
  public function pop(): mixed
  {
    return $this->list->popNullable();
  }

  /**
   * Peek at next item to pop if not empty, **{@see null}** otherwise.
   *
   * @return TValue|null
   */
  public function peek(): mixed
  {
    return $this->list->getNullableFirst();
  }
}