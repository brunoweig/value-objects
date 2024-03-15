<?php

declare(strict_types=1);

namespace Tests\Unit;

use BrunoWM\ValueObjects\Collection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Collection::class)]
class CollectionTest extends TestCase
{
    #[Test]
    public function empty_when_create_without_data()
    {
        $collection = new Collection([]);

        $this->assertTrue($collection->isEmpty());
    }

    #[Test]
    public function not_empty_when_create_with_data()
    {
        $collection = new Collection([1, 2]);

        $this->assertFalse($collection->isEmpty());
    }

    #[Test]
    public function get_first_item()
    {
        $collection = new Collection([3, 5, 10]);

        $this->assertEquals(3, $collection->getFirst());
    }

    #[Test]
    public function size_of()
    {
        $collection = new Collection([3, 5, 10]);

        $this->assertEquals(3, $collection->count());
    }

    #[Test]
    public function filter_data()
    {
        /** @var Collection<int> $collection */
        $collection = new Collection([6, 2, 9, 3, 8]);

        $filteredCollection = $collection->filter(fn($value) => $value % 2 === 0);

        $this->assertEquals(
            [6, 2, 8],
            $filteredCollection->toArray()
        );
    }
}
