<?php

namespace Myrtle\Core\Configurations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationAppRequest extends FormRequest
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
}
