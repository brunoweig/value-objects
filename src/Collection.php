<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

use Closure;
use UnderflowException;

/**
 * @template T
 */
readonly class Collection
{
    public function __construct(
        private array $data
    ) {}

    /**
     * @return ?T
     */
    public function first()
    {
        return $this->data[0] ?? null;
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    /**
     * @return T[]
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @throws UnderflowException
     * @return T
     */
    public function getFirst()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException('Collection is empty');
        }

        return $this->data[0];
    }

    /**
     * @param Closure(T): bool $fn
     * @return Collection
     */
    public function filter(Closure $fn): Collection
    {
        return new Collection(
            array_values(array_filter($this->data, $fn))
        );
    }

    public function count(): int
    {
        return count($this->data);
    }
}
