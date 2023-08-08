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
  /**
   * Integer type.
   *
   * @return int
   */
  public static function int(): int
  {
    return 0;
  }

  /**
   * String type.
   *
   * @return string
   */
  public static function string(): string
  {
    return '';
  }
}