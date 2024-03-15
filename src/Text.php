<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

readonly class Text
{
    public function __construct(private string $value) {}

    public function get(): string
    {
        return $this->value;
    }

    public function slug(): Text
    {
        $value = $this->get();
        $result = strtolower($value);

        return new self($result);
    }

    public function contains(string $value): bool
    {
        return !!strpos($this->get(), $value);
    }

    public function substring(int $offset = 0, int $size = 0): Text
    {
        $_offset = $offset;
        $_size = $size ?: $this->length();

        if ($offset < 0) {
            $_offset += $this->length();
        }

        $result = substr($this->get(), $_offset, $_size);

        return new self($result);
    }

    public function isEmpty(): bool
    {
        return strlen(trim($this->get())) === 0;
    }

    public function length(): int
    {
        return strlen($this->get());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
