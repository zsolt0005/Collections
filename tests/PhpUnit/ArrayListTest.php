<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Zsolt\Collections\ArrayList;

/**
 * Tests for {@see ArrayList}.
 *
 * @package Zsolt\Collections
 * @author Zsolt Döme
 *
 * @covers \Zsolt\Collections\ArrayList
 */
final class ArrayListTest extends TestCase
{
  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::add
   */
  public function testAddValue(): void
  {
    $testData = [5, 10, 15];
    $arrayList = ArrayList::empty();
    $arrayList->add($testData[0]);
    $arrayList->add($testData[1]);
    $arrayList->add($testData[2]);

    $toArray = $arrayList->toArray();

    self::assertSame($testData, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::addRange
   */
  public function testAddAllValues(): void
  {
    $testData = [5, 10, 15];

    $arrayList = ArrayList::empty();
    $arrayList->addRange(...$testData);

    $toArray = $arrayList->toArray();

    self::assertSame($testData, $toArray);
  }
}