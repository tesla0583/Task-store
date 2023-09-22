<?php

namespace App\Http\Services;

use App\Http\Contexts\CategoryRequestContext;
use App\Models\Category;

class CategoryService
{
    public function make(CategoryRequestContext $context)
    {
        return Category::create([
            'code' => $context->getCode(),
            'name' => $context->getName(),
            'parent_id' => $context->getParentId(),
            'description' => $context->getDescription(),
        ]);
    }

    public function remove(int $categoryId): bool
    {
        /** @var Category $category */
        Category::where('parent_id' , $categoryId)->delete();

        $category = Category::findOrFail($categoryId);

        return $category->delete();
    }
}