<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

use DomainException;

readonly class Url
{
    private Text $scheme;
    private Text $host;
    private Text $fullUrl;

    /**
     * @throws DomainException
     */
    public function __construct(string $url)
    {
        $url = trim($url);

        $this->fullUrl = new Text($url);
        $this->scheme = new Text(parse_url($url, PHP_URL_SCHEME) ?? '');
        $this->host = new Text(parse_url($url, PHP_URL_HOST) ?? '');
    }

    public function isEmpty(): bool
    {
        return $this->host->isEmpty();
    }

    public function isSecure(): bool
    {
        return $this->scheme->get() === 'https';
    }

    public function getHost(): Text
    {
        return $this->host;
    }

    public function getFullUrl(): Text
    {
        return $this->fullUrl;
    }
}
