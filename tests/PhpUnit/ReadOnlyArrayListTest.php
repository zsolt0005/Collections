<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests\PhpUnit;

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
  /** @var int[] Common test input. */
  private const VALUES = [1, 2, 3];

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::__construct
   */
  public function testCreateNewInstance(): void
  {
    $arrayList = new ReadOnlyArrayList(...self::VALUES);
    self::assertSame(self::VALUES, $arrayList->toArray());
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
    $arrayList = ReadOnlyArrayList::fromValues(...self::VALUES);
    self::assertSame(self::VALUES, $arrayList->toArray());
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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertSame(self::VALUES, $arrayList->toArray());
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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);
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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    foreach($arrayList as $key => $value)
    {
      self::assertSame(self::VALUES[$key], $value);
    }
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasIndex
   */
  public function testHasIndex(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertTrue($arrayList->hasIndex(0));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::hasIndex
   */
  public function testDoesNotHaveIndex(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertFalse($arrayList->hasIndex(5));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getIndexes
   */
  public function testGetIndexes(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertSame([0, 1, 2], $arrayList->getIndexes());
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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertSame(null, $arrayList->indexOf(0));
    self::assertSame(0, $arrayList->indexOf(1));
    self::assertSame(1, $arrayList->indexOf(2));
    self::assertSame(2, $arrayList->indexOf(3));
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getFirstIndex
   */
  public function testFirstIndex(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertSame(0, $arrayList->getFirstIndex());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getFirstIndex
   */
  public function testFirstIndexNonExisting(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray([]);

    $this->expectException(NotFoundException::class);
    $arrayList->getFirstIndex();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getFirstNullableIndex
   */
  public function testFirstNullableIndexNonExisting(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray([]);

    self::assertSame(null, $arrayList->getFirstNullableIndex());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getLastIndex
   */
  public function testLastIndex(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    self::assertSame(2, $arrayList->getLastIndex());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getLastIndex
   */
  public function testLastKeyNonExisting(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray([]);

    $this->expectException(NotFoundException::class);
    $arrayList->getLastIndex();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getLastNullableIndex
   */
  public function testLastNullableKeyNonExisting(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray([]);

    self::assertSame(null, $arrayList->getLastNullableIndex());
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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray([]);

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
    $arrayList = ReadOnlyArrayList::fromArray([]);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
    $arrayList = ReadOnlyArrayList::fromArray([]);

    $this->expectException(NotFoundException::class);
    $arrayList->getLast();
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::getNullableFirst
   */
  public function testGetNullableLastNotFound(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray([]);

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
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    $forEachArray = [];
    $arrayList->foreach(function ($value) use (&$forEachArray)
    {
      $forEachArray[] = $value;
    });

    self::assertSame(self::VALUES, $forEachArray);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws Exception
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreachIndexed
   */
  public function testForeachWithKeys(): void
  {
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    /** @throws Exception */
    $cb = function ($key, $value)
    {
      self::assertSame(self::VALUES[$key], $value);
    };

    $arrayList->foreachIndexed($cb);
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
    $valuesReversed = [3, 2, 1];
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

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
   * @covers \Zsolt\Collections\ReadOnlyArrayList::foreachIndexedReversed
   */
  public function testForeachWithKeysReversed(): void
  {
    $valuesReversed = [2 => 3, 1 => 2, 0 => 1];
    $arrayList = ReadOnlyArrayList::fromArray(self::VALUES);

    $forEachArray = [];
    $arrayList->foreachIndexedReversed(function ($key, $value) use (&$forEachArray)
    {
      $forEachArray[$key] = $value;
    });

    self::assertSame($valuesReversed, $forEachArray);
  }
}