<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Common functionality across collections.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue
 */
abstract class ACollectionBase
{
  /** @var ArrayList<TValue> Underlying array of the {@see Queue} data type. */
  protected ArrayList $list;

  /**
   * Checks if the queue is empty.
   *
   * @return bool
   */
  public function isEmpty(): bool
  {
    return $this->list->size() === 0;
  }

  /**
   * Size of the remaining items in the queue.
   *
   * @return int
   */
  public function size(): int
  {
    return $this->list->size();
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

  /**
   * To string.
   *
   * @return string
   */
  public function toString(): string
  {
    return $this->list->toString();
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
   * Get the array representation of the {@see Queue}.
   *
   * @return array<TValue>
   */
  public function toArray(): array
  {
    return $this->list->toArray();
  }

  /**
   * Get the {@see ArrayList} representation of the {@see Queue}.
   *
   * @return ArrayList<TValue>
   */
  public function toArrayList(): ArrayList
  {
    return ArrayList::fromArray($this->list->toArray());
  }

  /**
   * Get the {@see ReadOnlyArrayList} representation of the {@see Queue}.
   *
   * @return ReadOnlyArrayList<TValue>
   */
  public function toReadOnlyArrayList(): ReadOnlyArrayList
  {
    return $this->list->toReadOnlyArrayList();
  }
}