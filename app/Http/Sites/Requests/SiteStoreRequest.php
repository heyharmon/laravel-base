<?php

namespace DDD\Http\Sites\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

// Rules
use DDD\Http\Sites\Rules\UniqueHost;

class SiteStoreRequest extends FormRequest
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
            'url' => [
                'required',
                'url',
                new UniqueHost($this->url)
            ]
        ];
    }

    /**
     * Custom message for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'url.required' => 'Url is required',
            'url.url' => 'Must be a valid url. E.g., https://google.com',
        ];
    }
}
