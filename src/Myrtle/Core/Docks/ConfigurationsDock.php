<?php

namespace Myrtle\Core\Docks;

use Illuminate\Support\Facades\View;
use Myrtle\Core\Configurations\Policies\ConfigurationsDockPolicy;
use Myrtle\Core\Configurations\Providers\ConfigurationServiceProvider;

class ConfigurationsDock extends Dock
{
    /**
     * Description for Dock
     *
     * @var string
     */
    public $description = 'Configuration management';

    /**
     * Explicit Gate definitions
     *
     * @var array
     */
    public $gateDefinitions = [
        self::class . '.admin' => ConfigurationsDockPolicy::class . '@admin',
        self::class . '.access-admin' => ConfigurationsDockPolicy::class . '@accessAdmin',
        self::class . '.edit-settings' => ConfigurationsDockPolicy::class . '@editSettings',
        self::class . '.view-settings' => ConfigurationsDockPolicy::class . '@viewSettings',
        self::class . '.edit-permissions' => ConfigurationsDockPolicy::class . '@editPermissions',
        self::class . '.view-permissions' => ConfigurationsDockPolicy::class . '@viewPermissions',
    ];

    /**
     * Policy mappings
     *
     * @var array
     */
    public $policies = [
        ConfigurationsDockPolicy::class => ConfigurationsDockPolicy::class,
    ];

    /**
     * List of providers to be registered
     *
     * @var array
     */
    public $providers = [
        ConfigurationServiceProvider::class,
    ];

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/configurations.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of routes file paths to be loaded
     *
     * @return array
     */
    public function routes()
    {
        return [
            'admin' => dirname(__DIR__, 3) . '/routes/admin.php',
        ];
    }

    /**
     * Boot View Composers
     */
    public function viewComposers()
    {
        View::composer('admin::configurations.app.edit', function ($view) {
            $paginate = [
                1 => '1',
                5 => '5',
                8 => '8',
                10 => '10',
                15 => '15',
                16 => '16',
                20 => '20',
                25 => '25',
                50 => '50'
            ];
            $view->withPaginate($paginate);
        });

        View::composer('admin::configurations.session.edit', function ($view) {
            $lifetime = [
                5 => '5',
                10 => '10',
                15 => '15',
                30 => '30',
                60 => '60',
                90 => '90',
                120 => '120'
            ];
            $view->withLifetime($lifetime);
        });
    }
}
