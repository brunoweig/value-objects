<?php

declare(strict_types=1);

namespace BrunoWM\ValueObjects;

class Filepath
{
    const SEPARATOR = '/';

    private Text $directory;
    private Text $extension;
    private Text $filename;

    public function __construct(string $filepath)
    {
        $info = pathinfo($filepath);

        $this->directory = new Text($info['dirname']);
        $this->extension = new Text($info['extension']);
        $this->filename = new Text($info['filename']);
    }

    public static function createFromParts(string $directory, string $filename, string $extension): self
    {
        return new self($directory . self::SEPARATOR . $filename . "." . $extension);
    }

    public function getExtension(): Text
    {
        return $this->extension;
    }

    public function getFilename(): Text
    {
        return $this->filename;
    }

    public function getDirectory(): Text
    {
        return $this->directory;
    }

    public function getFullFilename(): Text
    {
        return new Text($this->filename . '.' . $this->extension);
    }

    public function getFullPath(): string
    {
        return $this->getDirectory() . self::SEPARATOR . $this->getFullFilename();
    }
}
