<?php declare(strict_types = 1);

namespace Zsolt\Collections;

use Zsolt\Collections\List\ArrayList;
use Zsolt\Collections\Models\Type;

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
   * Adds the given item.
   *
   * @param TValue $items
   *
   * @return void
   */
  public function pushAll(mixed ...$items): void
  {
    $this->list->addAll(...$items);
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