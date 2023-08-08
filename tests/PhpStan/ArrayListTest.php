<?php declare(strict_types = 1);

namespace Zsolt\Collections\PhpStan;

use Zsolt\Collections\ArrayList;
use Zsolt\Collections\Exceptions\NotFoundException;

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
}