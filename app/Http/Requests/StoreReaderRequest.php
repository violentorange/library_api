<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReaderRequest extends FormRequest
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
            'name' => ['required','string','max:100'],
            'email' => ['required','string', 'email','max:100', 'unique:readers'],
            'password' => ['required','string','min:8', 'confirmed'],
            'phone' => ['nullable','string','max:20'],
            'address' => ['required','string','max:200'],
        ];
    }
}
