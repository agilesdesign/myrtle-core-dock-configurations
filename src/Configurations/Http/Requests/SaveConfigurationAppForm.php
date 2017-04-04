<?php

namespace Myrtle\Core\Configurations\Http\Requests;

use Envitor\Facades\Envitor;
use Illuminate\Foundation\Http\FormRequest;

class SaveConfigurationAppForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'env' => 'required',
            'debug' => 'required',
            'ssl' => 'required',
            'paginate' => 'required'
        ];
    }

    /**
     * Handle invoked form process
     *
     * @return mixed
     */
    public function process()
    {
        $method = debug_backtrace()[1]['function'];

        return call_user_func_array([$this, $method], func_get_args());
    }

    /**
     * Process updates for config.app overrides
     *
     */
    public function update()
    {
        Envitor::set('APP_NAME', "'" . $this->name . "'");
        Envitor::set('APP_URL', $this->url);
		Envitor::set('APP_TIMEZONE', $this->timezone);
		Envitor::set('APP_ENV', $this->env);
		Envitor::set('APP_DEBUG', var_export((bool) (int) $this->debug, true));
		Envitor::set('APP_SSL', var_export((bool) (int) $this->ssl, true));
		Envitor::set('APP_PAGINATE', (int) $this->paginate);
    }
}
