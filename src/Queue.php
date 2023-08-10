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
   * @param TValue ...$values
   */
  public function __construct(mixed ...$values)
  {
    /** @var ArrayList<TValue> $list */
    $list = ArrayList::fromValues(...$values);

    $this->list = $list;
  }

  use CollectionTrait;

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