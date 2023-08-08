# Collections
**Welcome to the PHP Collection Library repository!** <br>
This library is designed to provide a comprehensive set of collection types and utility functions to enhance your PHP projects. <br>
Read more about the [Data Structures](https://www.geeksforgeeks.org/what-is-data-structure-types-classifications-and-applications/).

## Installation
**Coming soon.** ```composer require zsolt/collections```

## Give a Star! ⭐
If you like or are using this project please give it a star. Thanks!
___

## Docs
**Coming soon**

## Features
#### ReadOnlyArrayList
Provides more elegant way to work with arrays. It's a **read-only** version of the **ArrayList**, it does not allow to manipulate
with the data once it is created.
```php
$arrayList = ReadOnlyArrayList::fromValues(1, 2, 3, 4);
$arrayList->toString(); // [1, 2, 3, 4]

$arrayList->count(); // 4
$arrayList->keys(); // [0, 1, 2, 3]
$arrayList->hasKey(5); // false
$arrayList->get(2); // 3
$arrayList->getNullable(5); // null

$arrayList->foreach(static fn(mixed $value) => echo $value); // 1234
$arrayList->foreachReversed(static fn(mixed $value) => echo $value); // 4321

foreach($arrayList as $key => $value) { echo $value; } // 1234
```

#### ArrayList
**Mutable** version of the ReadOnlyArrayList. Allows manipulation with data.
```php
$arrayList = ArrayList::fromValues(1, 2, 3);
$arrayList->toString(); // [1, 2, 3]

$arrayList->add(4);
$arrayList->toString(); // [1, 2, 3, 4]

$arrayList->addRange(5, 6, 7);
$arrayList->toString(); // [1, 2, 3, 4, 5, 6, 7]

$arrayList->removeFirst();
$arrayList->removeLast();
$arrayList->toString(); // [2, 3, 4, 5, 6]

$arrayList->remove(4);
$arrayList->removeRange(5, 6);
$arrayList->toString(); // [2, 3]
```

#### Queue (Coming soon)
```php
$queue = Queue::create(Type::int());
$queue->enqueue(5);
$queue->enqueue(4);
$queue->enqueue(3);
$queue->enqueue(2);

$queue->dequeue(); // 5
$queue->dequeue(); // 4
$queue->peek(); // 3
$queue->dequeue(); // 3

$queue->isEmpty(); // false
$queue->count(); // 2

$queue->clear();

$queue->isEmpty(); // true
$queue->count(); // 0
$queue->dequeue(); // null
```

#### Stack (Coming soon)
```php
```

#### LinkedList (Coming soon)
```php
```

#### Dictionary (Coming soon)
```php
```

#### Tree (Coming soon)
```php
```

## TODO
 * Queue
   * toString
   * toArray
   * toArrayList
   * toReadOnlyArrayList