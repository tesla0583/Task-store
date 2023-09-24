<?php

namespace App\Http\Requests;

use App\Http\Contexts\ProductRequestContext;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,9999999999.99',
//            'image' => [
//                'required',
//                File::image()
//                    ->types(['png', 'jpg', 'jpeg'])
//                    ->min(1024)
//                    ->max(12 * 1024)
//                    ->dimensions(
//                        Rule::dimensions()
//                            ->maxWidth(1000)
//                            ->maxHeight(500)
//                    )
//            ],
            'description' => 'string',
            'availability' => 'boolean',
            'category_id' => 'integer|exists:categories,id',
        ];
    }

    public function toContext(): ProductRequestContext
    {
        return new ProductRequestContext(
            $this->input('name'),
            $this->input('price'),
            $this->input('image'),
            $this->input('description'),
            $this->input('availability'),
            $this->input('category_id')
        );
    }
}
