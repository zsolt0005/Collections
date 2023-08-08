<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Queue (FIFO).
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue of mixed
 * @extends ACollectionBase<TValue>
 */
class Queue extends ACollectionBase
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
   * Enqueues the given item.
   *
   * @param TValue $value
   *
   * @return void
   */
  public function enqueue(mixed $value): void
  {
    $this->list->add($value);
  }

  /**
   * Dequeues the next item.
   *
   * @return TValue|null
   */
  public function dequeue(): mixed
  {
    return $this->list->shiftNullable();
  }

  /**
   * Peek at next item to dequeue if not empty, **{@see null}** otherwise.
   *
   * @return TValue|null
   */
  public function peek(): mixed
  {
    return $this->list->getNullableFirst();
  }
}