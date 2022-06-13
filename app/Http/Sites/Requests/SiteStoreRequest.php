<?php

namespace DDD\Http\Sites\Requests;

use DDD\Http\Sites\Rules\UniqueHost;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
// Rules
use Illuminate\Http\Exceptions\HttpResponseException;

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
                new UniqueHost($this->url),
            ],
        ];
    }
}
