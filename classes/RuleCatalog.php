<?php

declare(strict_types=1);

namespace Grav\Plugin\PTM;

use RuntimeException;

final class RuleCatalog
{
    private string $path;
    private ?array $catalog = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function all(): array
    {
        if ($this->catalog !== null) {
            return $this->catalog;
        }

        if (!is_file($this->path) || !is_readable($this->path)) {
            throw new RuntimeException('PTM Rules catalogue is missing or unreadable.');
        }

        $raw = file_get_contents($this->path);
        if ($raw === false) {
            throw new RuntimeException('Unable to read PTM Rules catalogue.');
        }

        $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($decoded) || !isset($decoded['services']) || !is_array($decoded['services'])) {
            throw new RuntimeException('Invalid PTM Rules catalogue.');
        }

        $this->catalog = $decoded;
        return $this->catalog;
    }

    public function version(): string
    {
        return (string) ($this->all()['catalog_version'] ?? 'unknown');
    }

    public function services(): array
    {
        return $this->all()['services'];
    }
}
