<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Zsolt\Collections\ReadOnlyArrayList;

/**
 * Tests for {@see ReadOnlyArrayList}.
 *
 * @package Zsolt\Collections
 * @author Zsolt Döme
 *
 * @covers \Zsolt\Collections\ReadOnlyArrayList
 */
final class ReadOnlyArrayListTest extends TestCase
{
  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::__construct
   */
  public function testCreateNewInstance(): void
  {
    $values = [1, 2, 3];
    $arrayList = new ReadOnlyArrayList(...$values);
    self::assertSame($values, $arrayList->toArray());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::fromValues
   */
  public function testCreateFromValues(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromValues(...$values);
    self::assertSame($values, $arrayList->toArray());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::fromArray
   */
  public function testCreateFromArray(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame($values, $arrayList->toArray());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::fromArray
   */
  public function testCreateFromAssocArray(): void
  {
    $values = ['a' => 1, 'b' => 2];
    $arrayList = ReadOnlyArrayList::fromArray($values);
    self::assertSame($values, $arrayList->toArray());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::toString
   */
  public function testToString(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);
    self::assertSame('[1, 2, 3]', $arrayList->toString());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList
   */
  public function testIsIterable(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    foreach($arrayList as $key => $value)
    {
      self::assertSame($values[$key], $value);
    }
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasKey
   */
  public function testHasIntKey(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertTrue($arrayList->hasKey(0));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasKey
   */
  public function testDoesNotHasIntKey(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertFalse($arrayList->hasKey(5));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasKey
   */
  public function testHasStringKey(): void
  {
    $values = ['a' => 1, 'b' => 2];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertTrue($arrayList->hasKey('a'));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasKey
   */
  public function testDoesNotStringIntKey(): void
  {
    $values = ['a' => 1, 'b' => 2];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertFalse($arrayList->hasKey('c'));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getKeys
   */
  public function testGetKeys(): void
  {
    $values = [0, 1, 'a' => 1];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame([0, 1, 'a'], $arrayList->getKeys());
  }
}