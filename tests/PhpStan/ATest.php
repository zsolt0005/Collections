<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests\PhpStan;

/**
 * Abstract class to define common functions.
 *
 * @package Zsolt\Collections\PhpStan
 * @author  Zsolt Döme
 */
abstract class ATest
{
  /**
   * Test for int type.
   *
   * @param int $value
   *
   * @return void
   */
  protected function setInt(int $value): void {}

  /**
   * Test for int type.
   *
   * @param int|null $value
   *
   * @return void
   */
  protected function setNullableInt(?int $value): void {}

  /**
   * Test for string type.
   *
   * @param string $value
   *
   * @return void
   */
  protected function setString(string $value): void {}
}