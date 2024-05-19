<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTugasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'file_path' => ' |file|max:10240',
        ];
    }
}
