<?php

declare(strict_types=1);

namespace Grav\Plugin\PTM;

use RuntimeException;

final class FlatFileStorage
{
    private string $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = rtrim($baseDir, '/\\');
    }

    public function baseDir(): string
    {
        return $this->baseDir;
    }

    public function writeJson(string $relativePath, array $data): string
    {
        $target = $this->resolve($relativePath);
        $directory = dirname($target);

        if (!is_dir($directory) && !mkdir($directory, 0700, true) && !is_dir($directory)) {
            throw new RuntimeException('Unable to create PTM data directory.');
        }

        $json = json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        ) . PHP_EOL;

        $temporary = tempnam($directory, '.ptm-');
        if ($temporary === false) {
            throw new RuntimeException('Unable to create temporary PTM file.');
        }

        try {
            if (file_put_contents($temporary, $json, LOCK_EX) === false) {
                throw new RuntimeException('Unable to write PTM data.');
            }

            @chmod($temporary, 0600);
            if (!rename($temporary, $target)) {
                throw new RuntimeException('Unable to finalize PTM data file.');
            }
        } finally {
            if (is_file($temporary)) {
                @unlink($temporary);
            }
        }

        return $target;
    }

    public function readJson(string $relativePath): ?array
    {
        $target = $this->resolve($relativePath);
        if (!is_file($target)) {
            return null;
        }

        $raw = file_get_contents($target);
        if ($raw === false) {
            throw new RuntimeException('Unable to read PTM data.');
        }

        $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($decoded)) {
            throw new RuntimeException('Invalid PTM JSON data.');
        }

        return $decoded;
    }

    private function resolve(string $relativePath): string
    {
        $relativePath = trim(str_replace('\\', '/', $relativePath), '/');
        if ($relativePath === '' || str_contains($relativePath, '..')) {
            throw new RuntimeException('Invalid PTM storage path.');
        }

        if (!preg_match('~^[A-Za-z0-9._/-]+$~', $relativePath)) {
            throw new RuntimeException('Unsupported PTM storage path.');
        }

        return $this->baseDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
    }
}
