<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

use JsonSerializable;
use LengthException;

readonly class DataObject implements JsonSerializable
{
    private array $data;

    /**
     * @throws LengthException
     */
    public function __construct(array $data)
    {
        if (empty($data)) {
            throw new LengthException('Empty data object');
        }

        $result = [];

        foreach ($data as $key => $value) {
            $result[$key] = $this->formatValue($value);
        }

        $this->data = $result;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    public function getCollection(string $key): Collection
    {
        return $this->get($key, new Collection([]));
    }

    public function isEmpty(string $key): bool
    {
        $value = $this->get($key);

        if ($value instanceof Collection) {
            return $value->count() === 0;
        }

        return empty($value);
    }

    private function formatValue(mixed $value): mixed
    {
        if (!is_array($value)) {
            return $value;
        }

        if (!$this->isAssociative($value)) {
            return new Collection($value);
        }

        return new DataObject($value);
    }

    private function isAssociative(array $values): bool
    {
        $keys = array_keys($values);

        return $keys !== array_keys($keys);
    }

    public function merge(DataObject $input): DataObject
    {
        return new DataObject(
            array_merge($input->toArray(), $this->toArray())
        );
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
