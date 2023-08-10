<?php declare(strict_types = 1);

namespace Zsolt\Collections;

/**
 * PHP Types for the empty collections.
 *
 * @package Zsolt\Collections
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

  // TODO From class
}