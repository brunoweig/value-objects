<?php

declare(strict_types=1);

namespace Tests\Unit;

use BrunoWM\ValueObjects\Collection;
use BrunoWM\ValueObjects\Regex;
use BrunoWM\ValueObjects\Regex\RegexItem;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Regex::class)]
#[CoversClass(RegexItem::class)]
#[UsesClass(Collection::class)]
final class RegexTest extends TestCase
{
    #[Test]
    public function empty_result_when_pattern_not_match()
    {
        $regex = new Regex('abc');

        $result = $regex->match('teste');

        $this->assertTrue($result->isEmpty());
    }

    #[Test]
    public function not_empty_when_regex_returns_result()
    {
        $regex = new Regex('teste');

        $result = $regex->match('testes');

        $this->assertFalse($result->isEmpty());
    }

    #[Test]
    public function get_value()
    {
        $regex = new Regex('teste');

        $expected = new RegexItem('teste', 0);

        $result = $regex->match('testes');

        $this->assertEquals($expected, $result->getFirst());
    }

    #[Test]
    public function group_regex()
    {
        $expected = [
            new RegexItem('a', 0),
            new RegexItem('a', 2),
            new RegexItem('aa', 6),
            new RegexItem('a', 9),
        ];

        $regex = new Regex('(a\w*)');

        $result = $regex->match('a,a/b,aa,a/b/c');

        $this->assertEquals($expected, $result->toArray());
    }
}