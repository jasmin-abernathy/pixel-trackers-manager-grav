<?php

declare(strict_types=1);

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\PTM\FlatFileStorage;
use Grav\Plugin\PTM\PluginInventory;
use Grav\Plugin\PTM\RuleCatalog;

require_once __DIR__ . '/classes/FlatFileStorage.php';
require_once __DIR__ . '/classes/PluginInventory.php';
require_once __DIR__ . '/classes/RuleCatalog.php';

final class PtmPlugin extends Plugin
{
    private ?RuleCatalog $ruleCatalog = null;
    private ?PluginInventory $pluginInventory = null;
    private ?FlatFileStorage $storage = null;

    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    public function onPluginsInitialized(): void
    {
        if (!$this->grav['config']->get('plugins.ptm.enabled', true)) {
            return;
        }

        $this->ruleCatalog = new RuleCatalog(__DIR__ . '/data/rules.json');
        $this->pluginInventory = new PluginInventory($this->grav);

        $dataRoot = $this->grav['locator']->findResource('user-data://', true, true);
        if (!is_string($dataRoot) || $dataRoot === '') {
            $dataRoot = GRAV_ROOT . '/user/data';
        }

        $this->storage = new FlatFileStorage(
            rtrim($dataRoot, '/\\') . DIRECTORY_SEPARATOR . 'ptm'
        );
    }

    public function rules(): ?RuleCatalog
    {
        return $this->ruleCatalog;
    }

    public function inventory(): ?PluginInventory
    {
        return $this->pluginInventory;
    }

    public function storage(): ?FlatFileStorage
    {
        return $this->storage;
    }
}
