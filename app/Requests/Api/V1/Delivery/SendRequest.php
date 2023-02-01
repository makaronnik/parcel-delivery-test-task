<?php

namespace App\Requests\Api\V1\Delivery;

use Illuminate\Foundation\Http\FormRequest;

final class SendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        return [
            'parcel_width' => ['required', 'decimal:0,2', 'min:0.1'],
            'parcel_height' => ['required', 'decimal:0,2', 'min:0.1'],
            'parcel_length' => ['required', 'decimal:0,2', 'min:0.1'],
            'parcel_weight' => ['required', 'decimal:0,2', 'min:0.1'],
            'sender_full_name' => ['required', 'string', 'min:10', 'max:100'],
            'sender_phone' => ['required', 'string', 'min:10', 'max:10', 'regex:/^\d{10}$/'],
            'sender_email' => ['required', 'email', 'email'],
            'sender_address' => ['required', 'string', 'min:10', 'max:100'],
        ];
    }
}
