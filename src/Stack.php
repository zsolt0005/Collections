<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * Stack.
 *
 * @package Zsolt\Collections
 * @author  Zsolt Döme
 *
 * @template TValue
 */
class Stack
{
  /** @var ArrayList<TValue> Underlying array of the {@see Stack} data type. */
  protected ArrayList $list;

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
}