<?php

declare(strict_types=1);

namespace Tests\Unit\ValueObject;

use BrunoWM\ValueObjects\Text;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Text::class)]
final class TextTest extends TestCase
{
    #[Test]
    public function value()
    {
        $string = new Text('New String');

        $this->assertEquals('New String', $string->get());
    }

    #[Test]
    public function has_no_substring()
    {
        $string = new Text('New String');

        $this->assertFalse($string->contains('Wrong'));
    }

    #[Test]
    public function has_substring()
    {
        $string = new Text('New String');

        $this->assertTrue($string->contains('ew'));
    }

    #[Test]
    public function is_empty()
    {
        $string = new Text(' ');

        $this->assertTrue($string->isEmpty());
    }

    #[Test]
    public function length()
    {
        $string = new Text('New String');

        $this->assertEquals(10, $string->length());
    }

    #[Test]
    public function substring_start() {
        $string = new Text('New String');

        $result = $string->substring(size: 3);

        $this->assertEquals('New', $result->get());
    }

    #[Test]
    public function substring_end() {
        $string = new Text('New String');

        $result = $string->substring(offset: -6);

        $this->assertEquals('String', $result->get());
    }
}
