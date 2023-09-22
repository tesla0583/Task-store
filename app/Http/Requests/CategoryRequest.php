<?php

namespace App\Http\Requests;

use App\Http\Contexts\CategoryRequestContext;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'parent_id' => 'integer|exists:categories,id',
            'description' => 'string'
        ];
    }

    public function toContext(): CategoryRequestContext
    {
        return new CategoryRequestContext(
            $this->input('code'),
            $this->input('name'),
            $this->input('parentId'),
            $this->input('description')
        );
    }
}
