<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects\Regex;

readonly class RegexItem
{
    public function __construct(
        public string $pattern,
        public int $position
    ) {}
}
