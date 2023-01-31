<?php

namespace App\Requests\Api\V1\Delivery;

use Illuminate\Foundation\Http\FormRequest;

final class GetStatusRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ttn' => ['required', 'string', 'min: 10']
        ];
    }
}
