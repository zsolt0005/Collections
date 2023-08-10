<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use Zsolt\Collections\List\ArrayList;
use Zsolt\Collections\Models\Type;

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
   *
   * @param TValue ...$items
   */
  public function __construct(mixed ...$items)
  {
    /** @var ArrayList<TValue> $list */
    $list = ArrayList::fromValues(...$items);

    $this->list = $list;
  }

  use CollectionTrait;

  /**
   * Enqueues the given item.
   *
   * @param TValue $item
   *
   * @return void
   */
  public function enqueue(mixed $item): void
  {
    $this->list->add($item);
  }

  /**
   * Enqueues all the given items.
   *
   * @param TValue $items
   *
   * @return void
   */
  public function enqueueAll(mixed ...$items): void
  {
    $this->list->addAll(...$items);
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