<?php declare(strict_types = 1);

namespace Zsolt\Collections\PhpStan;

use Zsolt\Collections\Queue;
use Zsolt\Collections\Type;

/**
 * Test PHPStan type detection for generics.
 *
 * @package Zsolt\Collections\PhpStan
 * @author  Zsolt Döme
 */
final class QueueTest extends ATest
{
  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateNewInstance(): void
  {
    $queue = new Queue(Type::int());
    $queue->enqueue(5);
    $this->setNullableInt($queue->dequeue());
  }
}