<?php declare(strict_types = 1);

namespace Zsolt\Collections\Tests\PhpStan;

use Zsolt\Collections\Exceptions\NotFoundException;
use Zsolt\Collections\Models\Type;
use Zsolt\Collections\Queue;

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

  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateEmpty(): void
  {
    $queue = Queue::empty(Type::int());
    $queue->enqueue(5);
    $this->setNullableInt($queue->dequeue());
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testCreateFromValues(): void
  {
    $queue = Queue::fromValues(5, 4, 3);
    $queue->enqueue(2);
    $this->setNullableInt($queue->dequeue());
  }

  /**
   * Test case.
   *
   * @return void
   */
  public function testToArray(): void
  {
    $queue = new Queue(Type::int());
    $queue->enqueue(5);

    $array = $queue->toArray();

    $this->setInt($array[0]);
  }

  /**
   * Test case.
   *
   * @return void
   * @throws NotFoundException
   */
  public function testToArrayList(): void
  {
    $queue = new Queue(Type::int());
    $queue->enqueue(5);

    $list = $queue->toArrayList();

    $this->setInt($list->getFirst());
  }

  /**
   * Test case.
   *
   * @return void
   * @throws NotFoundException
   */
  public function testToReadOnlyArrayList(): void
  {
    $queue = new Queue(Type::int());
    $queue->enqueue(5);

    $list = $queue->toReadOnlyArrayList();

    $this->setInt($list->getFirst());
  }
}