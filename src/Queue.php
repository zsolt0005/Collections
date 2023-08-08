<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Queue (FIFO).
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue of mixed
 */
class Queue
{
  /** @var ArrayList<int, TValue> Underlying array of the {@see Queue} data type. */
  protected ArrayList $list;

  /**
   * Constructor. <br>
   * For a queue it is necessary to set its type, please use {@see Type}.
   *
   * @param TValue $type
   */
  public function __construct(mixed $type)
  {
    /** @var ArrayList<int, TValue> $emptyList */
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

  /**
   * Checks if the queue is empty.
   *
   * @return bool
   */
  public function isEmpty(): bool
  {
    return $this->list->count() === 0;
  }

  /**
   * Count of the remaining items in the queue.
   *
   * @return int
   */
  public function count(): int
  {
    return $this->list->count();
  }

  /**
   * Clears all items from the queue.
   *
   * @return void
   */
  public function clear(): void
  {
    $this->list->clear();
  }
}