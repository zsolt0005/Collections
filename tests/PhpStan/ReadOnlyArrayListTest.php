<?php declare(strict_types = 1);

namespace Zsolt\Collections\PhpStan;

use Zsolt\Collections\ReadOnlyArrayList;

/**
 * Test PHPStan type detection for generics
 *
 * @package Zsolt\Collections\PhpStan
 * @author  Zsolt Döme
 */
final class ReadOnlyArrayListTest extends ATest
{
  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateNewInstance(): void
  {
    $values = [1, 2, 3];
    $arrayList = new ReadOnlyArrayList(...$values);
    $this->setInt($arrayList->get(0));
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateFromValues(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromValues(...$values);
    $this->setInt($arrayList->get(0));
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateFromArray(): void
  {
    $values = [1, 2, 3];
    $arrayList = ReadOnlyArrayList::fromArray($values);
    $this->setInt($arrayList->get(0));
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateFromAssocArray(): void
  {
    $values = ['a' => 1, 'b' => 2];
    $arrayList = ReadOnlyArrayList::fromArray($values);
    $this->setInt($arrayList->get('a'));
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testIsIterable(): void
  {
    $values = [1, 2, 3];
    /** @var ReadOnlyArrayList<int, int> $arrayList */
    $arrayList = ReadOnlyArrayList::fromArray($values);

    foreach($arrayList as $key => $value)
    {
      $this->setInt($key);
      $this->setInt($value);
    }
  }
}