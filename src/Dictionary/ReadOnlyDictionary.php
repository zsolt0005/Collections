<?php declare(strict_types = 1);

namespace Zsolt\Collections\Dictionary;

use Zsolt\Collections\List\ArrayList;
use Zsolt\Collections\Models\Type;

/**
 * Dictionary.
 *
 * @package Zsolt\Collections\Dictionary
 * @author  Zsolt Döme
 *
 * @template TKey
 * @template TValue
 */
class ReadOnlyDictionary
{
  /** @var ArrayList<KeyValuePair<TKey, TValue>> Underlying storage of the {@see ReadOnlyDictionary} data type. */
  protected ArrayList $dictionary;

  /**
   * Constructor.
   *
   * @param KeyValuePair<TKey, TValue> $items
   */
  public function __construct(KeyValuePair ...$items)
  {
    $this->dictionary = ArrayList::fromValues(...$items);
  }

  /**
   * Factory method to create a new empty dictionary. <br>
   * For an empty dictionary it is necessary to set the types for the keys and values, please use {@see Type}.
   *
   * @template TNewKey
   * @template TNewValue
   *
   * @param TNewKey $keyType
   * @param TNewValue $valueType
   *
   * @return self<TNewKey, TNewValue>
   */
  public static function empty(mixed $keyType, mixed $valueType): self
  {
    /** @var ReadOnlyDictionary<TNewKey, TNewValue> $instance */
    $instance = new self();

    return $instance;
  }

  /**
   * Factory method to create a new dictionary. <br>
   *
   * @template TNewKey
   * @template TNewValue
   *
   * @param KeyValuePair<TNewKey, TNewValue> $items
   *
   * @return self<TNewKey, TNewValue>
   */
  public static function create(KeyValuePair ...$items): self
  {
    return new self(...$items);
  }

  /**
   * Gets the count of all values.
   *
   * @return int
   */
  public function size(): int
  {
    return $this->dictionary->size();
  }


  /**
   *
   * getNullable(key)
   * get(key)
   * getNullableFirst
   * getFirst
   * getNullableLast
   * getLast
   *
   * hasValue(value)
   * keyOf(value)
   *
   * hasKey(key)
   *
   * getKeys
   * getFirstNullableKey
   * getFirstKey
   * getLastNullableKey
   * getLastKey
   *
   * foreach
   * foreachWithKeys
   * foreachReversed
   * foreachWithKeysReversed
   *
   * toString / __toString
   *
   * toArrayKeys
   * toArrayValues
   * toArrayListKeys
   * toArrayListValues
   * toReadOnlyArrayListKeys
   * toReadOnlyArrayListValues
   *
   * getValuesIterator
   * getKeysIterator
   */
}