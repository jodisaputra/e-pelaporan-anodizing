<?php

namespace App\Http\Requests\Machine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:10240'], // max 10MB
        ];
    }
} 