<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

use BrunoWM\ValueObjects\Regex\RegexItem;
use BrunoWM\ValueObjects\Collection;

readonly class Regex {
    private string $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = '/' . trim($pattern, '/') . '/';
    }

    /**
     * @return Collection<RegexItem>
     */
    public function match(string $subject): Collection
    {
        $result = [];

        preg_match_all($this->pattern, $subject, $result, PREG_OFFSET_CAPTURE);

        return new Collection($this->formatMatch($result));
    }

    /**
     * @return RegexItem[]
     */
    private function formatMatch(array $result): array
    {
        return array_map(
            fn(array $item) => new RegexItem(
                pattern: $item[0],
                position: $item[1],
            ),
            $result[1] ?? $result[0]
        );
    }
}