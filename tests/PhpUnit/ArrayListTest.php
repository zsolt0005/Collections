<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Zsolt\Collections\ArrayList;
use Zsolt\Collections\Exceptions\NotFoundException;

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
  public function testAddRangeIntKeysValues(): void
  {
    $testData = [5, 10, 15];

    $arrayList = ArrayList::empty();
    $arrayList->addRange(...$testData);

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
  public function testAddRangeStringKeysValues(): void
  {
    $testData = ['a' => 1, 'b' => 2];
    $addData = [3, 4];
    $expected = ['a' => 1, 'b' => 2, 3, 4];

    $arrayList = ArrayList::fromArray($testData);
    $arrayList->addRange(...$addData);

    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::addArray
   */
  public function testAddArray(): void
  {
    $testData = [5, 10, 15];
    $testData2 = [20, 25];
    $expected = [5, 10, 15, 20, 25];

    $arrayList = ArrayList::fromArray($testData);
    $arrayList->addArray($testData2);

    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::clear
   */
  public function testClear(): void
  {
    $testData = [5, 10, 15];

    $arrayList = ArrayList::fromArray($testData);
    $arrayList->clear();

    $toArray = $arrayList->toArray();

    self::assertSame([], $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::removeFirst
   */
  public function testRemoveFirst(): void
  {
    $testData = [5, 10, 15];
    $expected = [1 => 10, 2 => 15];

    $arrayList = ArrayList::fromArray($testData);
    $arrayList->removeFirst();

    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::removeFirst
   */
  public function testRemoveFirstEmpty(): void
  {
    $testData = [];

    $arrayList = ArrayList::fromArray($testData);

    $this->expectException(NotFoundException::class);
    $arrayList->removeFirst();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::removeLast
   */
  public function testRemoveLast(): void
  {
    $testData = [5, 10, 15];
    $expected = [5, 10];

    $arrayList = ArrayList::fromArray($testData);
    $arrayList->removeLast();

    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ArrayList::removeLast
   */
  public function testRemoveLastEmpty(): void
  {
    $testData = [];

    $arrayList = ArrayList::fromArray($testData);

    $this->expectException(NotFoundException::class);
    $arrayList->removeLast();
  }
}