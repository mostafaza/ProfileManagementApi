<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            //
            'pro_first_name' => 'nullable|string|max:255',
            'pro_last_name' => 'nullable|string|max:255',
            'pro_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pro_status' => 'nullable|in:inactive,pending,active',
        ];
    }
}
