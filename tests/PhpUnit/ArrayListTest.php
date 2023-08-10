<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests\PhpUnit;

use Exception;
use PHPUnit\Framework\TestCase;
use Zsolt\Collections\Exceptions\NotFoundException;
use Zsolt\Collections\List\ArrayList;
use Zsolt\Collections\Models\Type;

/**
 * Tests for {@see ArrayList}.
 *
 * @package Zsolt\Collections
 * @author Zsolt Döme
 *
 * @covers \Zsolt\Collections\List\ArrayList
 */
final class ArrayListTest extends TestCase
{
  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::add
   */
  public function testAddValue(): void
  {
    $testData = [5, 10, 15];
    $arrayList = ArrayList::empty(Type::int());
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
   * @covers \Zsolt\Collections\List\ArrayList::prepend
   */
  public function testPrependValue(): void
  {
    $expected = [4, 1, 2, 3];
    $arrayList = ArrayList::fromValues(1, 2, 3);
    $arrayList->prepend(4);

    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::addRange
   */
  public function testAddRangeIntKeysValues(): void
  {
    $testData = [5, 10, 15];

    $arrayList = ArrayList::empty(Type::int());
    $arrayList->addRange(...$testData);

    $toArray = $arrayList->toArray();

    self::assertSame($testData, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::addArray
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
   * @covers \Zsolt\Collections\List\ArrayList::clear
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
   * @covers \Zsolt\Collections\List\ArrayList::removeFirst
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
   * @covers \Zsolt\Collections\List\ArrayList::removeFirst
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
   * @covers \Zsolt\Collections\List\ArrayList::removeLast
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
   * @covers \Zsolt\Collections\List\ArrayList::removeLast
   */
  public function testRemoveLastEmpty(): void
  {
    $testData = [];

    $arrayList = ArrayList::fromArray($testData);

    $this->expectException(NotFoundException::class);
    $arrayList->removeLast();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::removeByIndex
   */
  public function testRemoveByExistingKey(): void
  {
    $testData = [1, 2, 3];
    $expected = [0 => 1, 2=> 3];

    $arrayList = ArrayList::fromArray($testData);

    $arrayList->removeByIndex(1);
    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::removeByIndex
   */
  public function testRemoveByNonExistingKey(): void
  {
    $testData = [1, 2, 3];

    $arrayList = ArrayList::fromArray($testData);

    $this->expectException(NotFoundException::class);
    $arrayList->removeByIndex(3);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::remove
   */
  public function testRemoveByExistingValue(): void
  {
    $testData = [1, 2, 3];
    $expected = [1, 2];

    $arrayList = ArrayList::fromArray($testData);

    $arrayList->remove(3);
    $toArray = $arrayList->toArray();

    self::assertSame($expected, $toArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::remove
   */
  public function testRemoveByNonExistingValue(): void
  {
    $testData = [1, 2, 3];

    $arrayList = ArrayList::fromArray($testData);

    $this->expectException(NotFoundException::class);
    $arrayList->remove(0);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::shift
   */
  public function testShiftExisting(): void
  {
    $testData = [1, 2, 3];

    $arrayList = ArrayList::fromArray($testData);

    self::assertSame(1, $arrayList->shift());
    self::assertSame(2, $arrayList->shift());
    self::assertSame(3, $arrayList->shift());
    self::assertSame(0, $arrayList->size());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::shift
   */
  public function testShiftNotExisting(): void
  {
    $arrayList = ArrayList::fromArray([]);

    $this->expectException(NotFoundException::class);
    $arrayList->shift();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::shiftNullable
   */
  public function testShiftNullableNotExisting(): void
  {
    $arrayList = ArrayList::fromArray([]);

    self::assertSame(null, $arrayList->shiftNullable());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::pop
   */
  public function testPopExisting(): void
  {
    $testData = [1, 2, 3];

    $arrayList = ArrayList::fromArray($testData);

    self::assertSame(3, $arrayList->pop());
    self::assertSame(2, $arrayList->pop());
    self::assertSame(1, $arrayList->pop());
    self::assertSame(0, $arrayList->size());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::pop
   */
  public function testPopNotExisting(): void
  {
    $arrayList = ArrayList::fromArray([]);

    $this->expectException(NotFoundException::class);
    $arrayList->pop();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\List\ArrayList::popNullable
   */
  public function testPopNullableNotExisting(): void
  {
    $arrayList = ArrayList::fromArray([]);

    self::assertSame(null, $arrayList->popNullable());
  }
}