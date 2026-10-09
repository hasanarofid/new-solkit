<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
            'tagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
