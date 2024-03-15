<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

class Filepath
{
    const SEPARATOR = '/';

    private string $directory;
    private string $extension;
    private string $filename;

    public function __construct(string $filepath)
    {
        $info = pathinfo($filepath);

        $this->directory = $info['dirname'];
        $this->extension = $info['extension'];
        $this->filename = $info['filename'];
    }

    public static function createFromParts(string $directory, string $filename, string $extension): self
    {
        return new self($directory . self::SEPARATOR . $filename . "." . $extension);
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    public function getFullFilename(): string
    {
        return $this->filename . '.' . $this->extension;
    }

    public function getFullPath(): string
    {
        return $this->getDirectory() . self::SEPARATOR . $this->getFullFilename();
    }
}
