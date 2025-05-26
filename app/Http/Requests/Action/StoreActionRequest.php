<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action_status' => ['required', 'string', 'max:255'],
            'action_description' => ['required', 'string'],
            'action_date' => ['required', 'date'],
            'technician_name' => ['required', 'string', 'max:255'],
            'spare_part_id' => ['required', 'exists:spare_parts,id'],
            'spare_part_quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'action_status.required' => 'The action status is required.',
            'action_description.required' => 'The action description is required.',
            'action_date.required' => 'The action date is required.',
            'technician_name.required' => 'The technician name is required.',
            'spare_part_id.required' => 'The spare part is required.',
            'spare_part_id.exists' => 'The selected spare part is invalid.',
            'spare_part_quantity.required' => 'The spare part quantity is required.',
            'spare_part_quantity.integer' => 'The spare part quantity must be a number.',
            'spare_part_quantity.min' => 'The spare part quantity must be at least 1.'
        ];
    }
} 