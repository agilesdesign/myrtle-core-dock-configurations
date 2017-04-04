<?php

namespace Myrtle\Core\Configurations\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Myrtle\Configurations\Support\LoadConfiguration;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMergeConfigOverrides();
    }

    /**
     * Bootstrap Config stuff
     *
     * @return void
     */
    protected function bootConfig()
    {
        $this->bootCustomConfigModelListeners();
        $this->bootCustomAppConfigs();
    }

    /**
     * Bootstrap Model Listeners
     *
     * @return void
     */
    protected function bootCustomConfigModelListeners()
    {
        Event::listen('eloquent.booting: *', function ($event, $data) {

            $data[0]->setPerPage((int)Config::get('app.paginate', 15));
        });
    }

    /**
     * Bootstrap Config Operations
     *
     * @return void
     */
    protected function bootCustomAppConfigs()
    {
        if (Config::get('app.ssl')) {
            //URL::forceSchema('https');
        }
    }

    /**
     * Merge configs overrides
     *
     * @return void
     */
    protected function registerMergeConfigOverrides()
    {
        (new LoadConfiguration)->bootstrap($this->app);
    }
}
