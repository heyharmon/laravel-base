<?php

namespace DDD\Domain\Designs\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DesignUpdateRequest extends FormRequest
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
            'title' => 'nullable|string',
            'variables' => 'nullable|array',

            'variables.color_white' => 'nullable|string',
            'variables.color_black' => 'nullable|string',
            'variables.color_primary' => 'nullable|string',
            'variables.color_accent' => 'nullable|string',
            'variables.color_contrast_high' => 'nullable|string',
            'variables.color_contrast_higher' => 'nullable|string',
            'variables.color_background' => 'nullable|string',
            'variables.text_base_size' => 'nullable|string',
            'variables.font_primary' => 'nullable|string',
            'variables.font_primary_weight' => 'nullable|string',
            'variables.font_secondary' => 'nullable|string',
            'variables.font_secondary_weight' => 'nullable|string',
            'variables.button_radius' => 'nullable|string',
        ];
    }
}
