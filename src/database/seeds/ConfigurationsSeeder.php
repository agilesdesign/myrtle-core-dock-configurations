<?php

use Illuminate\Database\Seeder;
use Myrtle\Core\Configurations\Models\Configuration;

class ConfigurationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		collect($this->configurations())->each(function ($item, $key) {
			Configuration::updateOrCreate(['group' => $key, 'options' => $item]);
		});
    }

    public function configurations()
    {
        return [
            'app' => [
                'name' => 'Myrtle',
                'env' => 'local',
                'debug' => '1',
                'ssl' => '0',
                'url' => 'http://myrtle.cms',
                'paginate' => '15',
            ],
            'session' => [
                'driver' => 'database',
                'connection' => config('database.default'),
                'lifetime' => '10',
                'expire_on_close' => '1',
                'encrypt' => '1',
                'cookie' => 'myrtle_session',
            ],
        ];
    }
}
