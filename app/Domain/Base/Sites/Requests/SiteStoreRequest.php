<?php

namespace DDD\Domain\Base\Sites\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SiteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'domain' => 'required|string|unique:sites',
            'launch_info' => 'nullable|array',
            'launch_info.launch_date' => 'nullable|date',
            'launch_info.freeze_date' => 'nullable|date',
            'launch_info.dev_domain' => 'nullable|string',
            'launch_info.prod_domain' => 'nullable|string',
            'launch_info.prod_ip' => 'nullable|ip',
            'launch_info.notes' => 'nullable|string',
        ];
    }

    /**
     * Return exception as json
     */
    protected function failedValidation(Validator $validator): Exception
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
