<?php

declare(strict_types=1);

namespace Grav\Plugin\PTM;

use Grav\Common\Plugins;
use Pimple\Container;

final class PluginInventory
{
    private Container $grav;

    public function __construct(Container $grav)
    {
        $this->grav = $grav;
    }

    public function collect(): array
    {
        $config = $this->grav['config'];
        $items = [];

        foreach (Plugins::getPlugins() as $name => $plugin) {
            $items[] = [
                'name' => (string) $name,
                'enabled' => (bool) $config->get('plugins.' . $name . '.enabled', false),
                'class' => get_class($plugin),
            ];
        }

        usort($items, static fn(array $a, array $b): int => strnatcasecmp($a['name'], $b['name']));
        return $items;
    }
}
