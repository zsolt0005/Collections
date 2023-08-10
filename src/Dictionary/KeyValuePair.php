<?php declare(strict_types = 1);

namespace Zsolt\Collections\Dictionary;

/**
 * Key - Value pair.
 *
 * @package Zsolt\Collections\Dictionary
 * @author  Zsolt Döme
 *
 * @template TKey
 * @template TValue
 */
class KeyValuePair
{
  /**
   * Constructor.
   *
   * @param TKey $key
   * @param TValue $value
   */
  public function __construct(public mixed $key, public mixed $value)
  {
  }

  /**
   * Factory method.
   *
   * @template TNewKey
   * @template TNewValue
   *
   * @param TNewKey $key
   * @param TNewValue $value
   *
   * @return self<TNewKey, TNewValue>
   */
  public static function create(mixed $key, mixed $value): self
  {
    return new self($key, $value);
  }
}