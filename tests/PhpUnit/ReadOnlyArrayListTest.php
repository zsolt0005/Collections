<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use stdClass;
use Zsolt\Collections\Exceptions\NotFoundException;
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
   * @covers \Zsolt\Collections\ReadOnlyArrayList::get
   */
  public function testGetExisting(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(1, $arrayList->get(0));
    self::assertSame(2, $arrayList->get(1));
    self::assertSame(3, $arrayList->get(2));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::get
   */
  public function testGetNonExisting(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $this->expectException(NotFoundException::class);
    $arrayList->get(10);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getNullable
   */
  public function testGetNullableExisting(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(1, $arrayList->getNullable(0));
    self::assertSame(2, $arrayList->getNullable(1));
    self::assertSame(3, $arrayList->getNullable(2));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getNullable
   */
  public function testGetNullableNonExisting(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->getNullable(10));
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

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::contains
   */
  public function testContainsScalar(): void
  {
    $values = [0, 1, 2];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertTrue($arrayList->contains(1));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::contains
   */
  public function testContainsReferenceType(): void
  {
    $class1 = new stdClass();
    $class2 = new stdClass();

    $values = [$class1, $class2];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertTrue($arrayList->contains($class1));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::indexOf
   */
  public function testIndexOf(): void
  {
    $values = [1, 2, 3, 'a' => 4];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->indexOf(0));
    self::assertSame(0, $arrayList->indexOf(1));
    self::assertSame(1, $arrayList->indexOf(2));
    self::assertSame(2, $arrayList->indexOf(3));
    self::assertSame('a', $arrayList->indexOf(4));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::firstKey
   */
  public function testFirstKeyInt(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(0, $arrayList->firstKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::firstKey
   */
  public function testFirstKeyString(): void
  {
    $values = ['a' => 1, 'b' => 2, 'c' => 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame('a', $arrayList->firstKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::firstKey
   */
  public function testFirstKeyNonExisting(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $this->expectException(NotFoundException::class);
    $arrayList->firstKey();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::firstNullableKey
   */
  public function testFirstNullableKeyNonExisting(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->firstNullableKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::lastKey
   */
  public function testLastKeyInt(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(2, $arrayList->lastKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::lastKey
   */
  public function testLastKeyString(): void
  {
    $values = ['a' => 1, 'b' => 2, 'c' => 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame('c', $arrayList->lastKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::lastKey
   */
  public function testLastKeyNonExisting(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $this->expectException(NotFoundException::class);
    $arrayList->lastKey();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::lastNullableKey
   */
  public function testLastNullableKeyNonExisting(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->lastNullableKey());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getFirst
   */
  public function testGetFirstFound(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(1, $arrayList->getFirst());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getFirst
   */
  public function testGetFirstNotFound(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $this->expectException(NotFoundException::class);
    $arrayList->getFirst();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getNullableFirst
   */
  public function testGetNullableFirstNotFound(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->getNullableFirst());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getLast
   */
  public function testGetLastFound(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(3, $arrayList->getLast());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getLast
   */
  public function testGetLastNotFound(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $this->expectException(NotFoundException::class);
    $arrayList->getLast();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getNullableLst
   */
  public function testGetNullableLastNotFound(): void
  {
    $values = [];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    self::assertSame(null, $arrayList->getNullableLast());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreach
   */
  public function testForeach(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $forEachArray = [];
    $arrayList->foreach(function ($value) use (&$forEachArray)
    {
      $forEachArray[] = $value;
    });

    self::assertSame($values, $forEachArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreachWithKeys
   */
  public function testForeachWithKeys(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    /** @throws Exception */
    $cb = function ($key, $value) use ($values)
    {
      self::assertSame($values[$key], $value);
    };

    $arrayList->foreachWithKeys($cb);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreachReversed
   */
  public function testForeachReversed(): void
  {
    $values = [1, 2, 3];
    $valuesReversed = [3, 2, 1];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $forEachArray = [];
    $arrayList->foreachReversed(function ($value) use (&$forEachArray)
    {
      $forEachArray[] = $value;
    });

    self::assertSame($valuesReversed, $forEachArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreachWithKeysReversed
   */
  public function testForeachWithKeysReversed(): void
  {
    $values = ['a' => 1, 'b' => 2, 'c' => 3];
    $valuesReversed = ['c' => 3, 'b' => 2, 'a' => 1];
    $arrayList = ReadOnlyArrayList::fromArray($values);

    $forEachArray = [];
    $arrayList->foreachWithKeysReversed(function ($key, $value) use (&$forEachArray)
    {
      $forEachArray[$key] = $value;
    });

    self::assertSame($valuesReversed, $forEachArray);
  }
}