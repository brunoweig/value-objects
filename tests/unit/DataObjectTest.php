<?php

declare(strict_types=1);

namespace Tests\Unit;


use BrunoWM\ValueObjects\Collection;
use BrunoWM\ValueObjects\DataObject;
use LengthException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(DataObject::class)]
final class DataObjectTest extends TestCase
{
    #[Test]
    public function throw_exception_when_empty_data()
    {
        $this->expectException(LengthException::class);

        new DataObject([]);
    }

    #[Test]
    public function get_null_when_column_not_filled()
    {
        $object = new DataObject(['name' => 'John Doe']);

        $this->assertNull($object->get('age'));
    }

    #[Test]
    public function get_value_by_column()
    {
        $object = new DataObject(['name' => 'John Doe']);

        $this->assertEquals('John Doe', $object->get('name'));
    }

    #[Test]
    public function has_value_by_column()
    {
        $object = new DataObject(['name' => 'John Doe']);

        $this->assertTrue($object->has('name'));
    }

    #[Test]
    public function create_object_with_collection()
    {
        $object = new DataObject([
            'total' => 2,
            'items' => [
                ['id' => 1],
                ['id' => 3],
            ]
        ]);

        $this->assertInstanceOf(Collection::class, $object->get('items'));
    }

    #[Test]
    public function create_object_with_objects()
    {
        $object = new DataObject([
            'address' => [
                'zipcode' => 'xxx',
                'location' => '',
            ]
        ]);

        $this->assertInstanceOf(DataObject::class, $object->get('address'));
    }
}