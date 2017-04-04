<?php

namespace Myrtle\Core\Configurations\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Myrtle\Configurations\Models\Configuration;
use Myrtle\Configurations\Policies\ConfigurationsDockPolicy;
use Myrtle\Configurations\Http\Requests\SaveConfigurationSessionForm;

class ConfigurationSessionController extends Controller
{
    /**
     * The root key in Config
     *
     * @var string
     */
    protected $group = 'session';

    /**
     * Show the edit form config.session overrides
     *
     * @return Response
     */
    public function edit()
    {
        $this->authorize('session', ConfigurationsDockPolicy::class);

        return view('admin::configurations.' . $this->group . '.edit')
            ->withGroup($this->group)
            ->withConfiguration(Config::get($this->group));
    }

    /**
     * Update the config.session overrides
     *
     * @param SaveConfigurationSessionForm $form
     * @return Response
     */
    public function update(SaveConfigurationSessionForm $form)
    {
        $this->authorize('session', ConfigurationsDockPolicy::class);

        $form->process();

        flasher()->alert('Session configuration has been saved', 'success');

        return redirect()->route('admin.configurations.' . $this->group . '.edit');
    }
}
