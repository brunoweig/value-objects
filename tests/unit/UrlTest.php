<?php

declare(strict_types=1);

namespace Tests\Unit\ValueObject;

use BrunoWM\ValueObjects\Url;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Url::class)]
final class UrlTest extends TestCase
{
    #[Test]
    public function is_empty()
    {
        $url = new Url('  ');

        $this->assertTrue($url->isEmpty());
    }

    #[Test]
    public function is_secure()
    {
        $url = new Url('https://domain.com');

        $this->assertTrue($url->isSecure());
    }

    #[Test]
    public function is_not_secure()
    {
        $url = new Url('http://domain.com');

        $this->assertFalse($url->isSecure());
    }

    #[Test]
    public function host()
    {
        $url = new Url('https://domain.com?q=123');

        $this->assertEquals('domain.com', $url->getHost()->get());
    }

    #[Test]
    public function full_url()
    {
        $expected = 'https://domain.com?q=123';

        $url = new Url($expected);

        $this->assertEquals($expected, $url->getFullUrl()->get());
    }
}
