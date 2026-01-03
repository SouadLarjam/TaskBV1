<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date|date_format:Y-m-d H:i:s',
        ];
    }

     public function messages(): array
    {
        return [
            'title.max'      => 'Le titre ne peut pas dépasser 255 caractères',
            'due_date.date'  => 'La date doit être valide',
            'due_date.date_format' => 'La date doit être au format YYYY-MM-DD HH:MM:SS',
        ];
    }
}
