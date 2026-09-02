<?php

declare(strict_types=1);

namespace Grav\Plugin\PTM;

use Grav\Common\Grav;
use Grav\Common\Plugins;

final class PluginInventory
{
    private Grav $grav;
    private ?string $profilesFile;
    private ?array $profiles = null;

    public function __construct(Grav $grav, ?string $profilesFile = null)
    {
        $this->grav = $grav;
        $this->profilesFile = $profilesFile;
    }

    public function collect(): array
    {
        $config = $this->grav['config'];
        $profiles = $this->profilesBySlug();
        $items = [];

        foreach (Plugins::getPlugins() as $name => $plugin) {
            $slug = strtolower((string) $name);
            $profile = $profiles[$slug] ?? null;

            $items[] = [
                'name' => (string) $name,
                'enabled' => (bool) $config->get('plugins.' . $name . '.enabled', false),
                'class' => get_class($plugin),
                'known' => $profile !== null,
                'label' => (string) ($profile['label'] ?? $name),
                'role' => (string) ($profile['role'] ?? 'unclassified'),
                'privacy_kind' => (string) ($profile['privacy_kind'] ?? 'unclassified'),
                'severity' => (string) ($profile['severity'] ?? 'info'),
                'services' => array_values((array) ($profile['services'] ?? [])),
                'note' => (string) ($profile['note'] ?? 'Plugin Grav non encore catalogué par PTM. Ce n’est pas une alerte en soi.'),
            ];
        }

        usort($items, static fn(array $a, array $b): int => strnatcasecmp($a['name'], $b['name']));
        return $items;
    }

    private function profilesBySlug(): array
    {
        if ($this->profiles !== null) {
            return $this->profiles;
        }

        $this->profiles = [];
        if (!$this->profilesFile || !is_readable($this->profilesFile)) {
            return $this->profiles;
        }

        $decoded = json_decode((string) file_get_contents($this->profilesFile), true);
        if (!is_array($decoded) || empty($decoded['profiles']) || !is_array($decoded['profiles'])) {
            return $this->profiles;
        }

        foreach ($decoded['profiles'] as $profile) {
            if (!is_array($profile) || empty($profile['slug'])) {
                continue;
            }
            $slug = strtolower(trim((string) $profile['slug']));
            if ($slug !== '') {
                $this->profiles[$slug] = $profile;
            }
        }

        return $this->profiles;
    }
}
