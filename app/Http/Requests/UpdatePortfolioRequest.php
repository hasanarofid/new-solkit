<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $portfolioId = $this->route('portfolio') ? $this->route('portfolio')->id : null;

        return [
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('portfolios', 'slug')->ignore($portfolioId)],
            'client_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:100',
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'impact_metric' => 'nullable|string|max:255',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|image|max:2048',
            'project_url' => 'nullable|url|max:255',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ];
    }
}
