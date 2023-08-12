<?php

namespace App\Modules\Category\Requests;

use App\Modules\Category\DTOs\CategoryDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return auth()->check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:categories,slug,' . $this->category->id,
            'image' => 'nullable|file|image|max:' . (1024 * 5),
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
        ];
    }

    /**
     * @return CategoryDTO
     */
    public function toDto(): CategoryDTO
    {
        return new CategoryDTO(...$this->validated());
    }
}
