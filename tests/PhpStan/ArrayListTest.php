<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests\PhpStan;

use DateTime;
use Zsolt\Collections\Dictionary\KeyValuePair;
use Zsolt\Collections\Exceptions\NotFoundException;
use Zsolt\Collections\List\ArrayList;
use Zsolt\Collections\Models\Type;

/**
 * Test PHPStan type detection for generics.
 *
 * @package Zsolt\Collections\PhpStan
 * @author  Zsolt Döme
 */
final class ArrayListTest extends ATest
{
  /**
   * Test case.
   *
   * @return void
   * @throws NotFoundException
   */
  public function testToReadOnlyArrayList(): void
  {
    $list = ArrayList::fromValues(1, 2, 3);
    $readOnlyList = $list->toReadOnlyArrayList();

    $this->setInt($readOnlyList->getFirst());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws NotFoundException
   */
  public function testReferenceTypeValue(): void
  {
    $type = Type::from(KeyValuePair::create('key', 1));

    $list = ArrayList::empty($type);
    $list->add(KeyValuePair::create('key', 1));

    $first = $list->getFirst();
    $this->setString($first->key);
    $this->setint($first->value);
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testReferenceTypeValue2(): void
  {
    $type = Type::fromClass(DateTime::class);

    $list = ArrayList::empty($type);
    $list->add(new DateTime());
  }
}