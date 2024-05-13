<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileDetailsRequest extends FormRequest
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
            'new_username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore(auth()->id())],
            'new_email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(auth()->id())],
        ];
    }
}
