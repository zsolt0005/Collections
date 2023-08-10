<?php declare(strict_types = 1);

namespace Zsolt\Collections\Models;

/**
 * PHP Types for the empty collections.
 *
 * @package Zsolt\Collections\Models
 * @author  Zsolt Döme
 */
class Type
{
  /** @return int */
  public static function int(): int{ return 0; }

  /** @return float */
  public static function float(): float { return 0.0; }

  /** @return string */
  public static function string(): string { return ''; }

  /** @return bool */
  public static function bool(): bool { return true; }

  /**
   * Returns a type based on the value specified.
   *
   * @template TValue
   * @param TValue $value
   *
   * @return TValue
   */
  public static function from(mixed $value): mixed { return $value; }

  /**
   * Returns a type based on the given class. <br>
   * **Do not use the return type outside the type inputs of the collections!** The returned object is an anonymous
   *  and empty class, **it does not extend the given class!**
   *
   * @template TValue of object
   * @param class-string<TValue> $class
   *
   * @return TValue
   */
  public static function fromClass(string $class): object
  {
    /** @var TValue $instance */
    $instance = new class {};

    return $instance;
  }
}