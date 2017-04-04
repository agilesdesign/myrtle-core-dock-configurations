<?php

namespace Myrtle\Core\Configurations\Http\Requests;

use Envitor\Facades\Envitor;
use Illuminate\Foundation\Http\FormRequest;

class SaveConfigurationSessionForm extends FormRequest
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
            'driver' => 'required',
            'connection' => 'required',
            'lifetime' => 'required',
            'expire_on_close' => 'required',
            'encrypt' => 'required',
            'cookie' => 'required'
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
     * Process updates for config.session overrides
     *
     */
    public function update()
    {
		Envitor::set('SESSION_DRIVER', $this->driver);
		Envitor::set('SESSION_CONNECTION', $this->connection);
		Envitor::set('SESSION_LIFETIME', (int) $this->lifetime);
		Envitor::set('SESSION_EXPIRE_ON_CLOSE', var_export((bool) (int) $this->expire_on_close, true));
		Envitor::set('SESSION_ENCRYPT', var_export((bool) (int) $this->encrypt, true));
		Envitor::set('SESSION_COOKIE', $this->cookie);
    }
}
