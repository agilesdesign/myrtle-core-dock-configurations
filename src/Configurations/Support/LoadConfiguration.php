<?php

namespace Myrtle\Core\Configurations\Support;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Foundation\Application;

class LoadConfiguration
{
    /**
     * Bootstrap
     *
     * @param Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
//        $this->mergeConfigOverrides();
//
//        $app->detectEnvironment(function () {
//            return config('app.env', 'production');
//        });
//
//        date_default_timezone_set(config('app.timezone'));
//
//        mb_internal_encoding('UTF-8');
    }

    /**
     * Merge config overrides
     *
     * @return void
     */
    protected function mergeConfigOverrides()
    {
        $this->getConfigOverrides()->each(function ($custom, $key) {
            $new = array_replace_recursive(config($key), (array)$custom);
            config()->set($key, $new);
        });
    }

    /**
     * Load config overrides from files
     *
     * @return Collection
     */
    protected function getConfigOverrides()
    {
        $path = $this->createConfigOverrideDirectory();

        $files = Finder::create()->files()->name('*.json')->in($path);

        return collect($files)->keyBy(function ($file, $key) {
            return trim(str_replace(storage_path('config'), '', $file->getPathName()), DIRECTORY_SEPARATOR);
        })->keyBy(function ($file, $key) {
            return str_replace(DIRECTORY_SEPARATOR, '.', $key) . '.';
        })->keyBy(function ($file, $key) {
            return str_replace('.json.', '', $key);
        })->transform(function ($file, $key) {
            return json_decode(file_get_contents($file->getPathName()), true);
            //return require $file->getPathName();
        });
    }

    /**
     * @return string
     */
    protected function createConfigOverrideDirectory(): string
    {
        $path = storage_path('config');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0775, true, true);
        }
        return $path;
    }
}
