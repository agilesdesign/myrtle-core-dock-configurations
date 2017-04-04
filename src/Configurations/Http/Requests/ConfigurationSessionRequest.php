<?php

namespace Myrtle\Core\Configurations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationSessionRequest extends FormRequest
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
}
