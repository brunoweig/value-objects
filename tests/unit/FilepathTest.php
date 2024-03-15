<?php

declare(strict_types=1);

namespace Tests\Unit;

use BrunoWM\ValueObjects\Filepath;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Filepath::class)]
class FilepathTest extends TestCase
{
    private Filepath $filepath;

    protected function setUp(): void
    {
        $this->filepath = new Filepath('dir/subdir/filename.csv');
    }

    #[Test]
    public function file_extension()
    {
        $this->assertEquals('csv', $this->filepath->getExtension());
    }

    #[Test]
    public function file_name()
    {
        $this->assertEquals('filename', $this->filepath->getFilename());
    }

    #[Test]
    public function file_directory()
    {
        $this->assertEquals('dir/subdir', $this->filepath->getDirectory());
    }

    #[Test]
    public function file_path()
    {
        $this->assertEquals('filename.csv', $this->filepath->getFullFilename());
    }

    #[Test]
    public function file_full_path()
    {
        $this->assertEquals('dir/subdir/filename.csv', $this->filepath->getFullPath());
    }
}