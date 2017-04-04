<?php

namespace Myrtle\Core\Configurations\Http\Controllers\Administrator;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Myrtle\Configurations\Policies\ConfigurationsDockPolicy;
use Myrtle\Configurations\Http\Requests\SaveConfigurationAppForm;

class ConfigurationAppController extends Controller
{
    /**
     * The root key in Config
     *
     * @var string
     */
    protected $group = 'app';

    /**
     * Show the edit form config.app overrides
     *
     * @return Response
     */
    public function edit()
    {
        $this->authorize('app', ConfigurationsDockPolicy::class);

        $timezones = collect(\DateTimeZone::listIdentifiers())->keyBy(function($timezone) {
            return $timezone;
        });

        return view('admin::configurations.' . $this->group . '.edit')
            ->withGroup($this->group)
            ->withTimezones($timezones)
            ->withConfiguration(Config::get($this->group));
    }

    /**
     * Update the config.app overrides
     *
     * @param SaveConfigurationAppForm $form
     * @return Response
     */
    public function update(SaveConfigurationAppForm $form)
    {
        $this->authorize('app', ConfigurationsDockPolicy::class);

        $form->process();

        flasher()->alert('Application configuration has been saved', 'success');

        return redirect()->route('admin.configurations.' . $this->group . '.edit');
    }
}
