<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AulaRequest extends FormRequest
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
            'title' => 'bail|required|min:5|max:100',
            'description' => 'bail|required|min:5',
            'link' => 'bail|url|required|min:5',
            'image' => 'bail|url|required|min:5',
            'category' => 'bail|required|min:5|max:30'
        ];
    }
}
