<?php

namespace App\Http\Services;

use App\Http\Contexts\ProductRequestContext;
use App\Http\Contexts\FilterProductContext;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function get(FilterProductContext $context): Collection
    {
//        return Product::all();

        $query = Product::query();

        if (!is_null($context->getName())) {
            $query->where('name', $context->getName());
        }

        if (!is_null($context->getMinPrice()) && !is_null($context->getMaxPrice())) {
            $query->whereBetween('price', [$context->getMinPrice(), $context->getMaxPrice()]);
        }

        return $query->get();
    }

    public function make(ProductRequestContext $context): Product
    {
        return Product::create([
            'name' => $context->getName(),
            'price' => $context->getPrice(),
            'image' => $context->getImage(),
            'description' => $context->getDescription(),
            'availability' => $context->getAvailability(),
            'category_id' => $context->getCategoryId()
        ]);
    }

    public function getById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function change(ProductRequestContext $context, $id): Product
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $context->getName(),
            'price' => $context->getPrice(),
            'image' => $context->getImage(),
            'description' => $context->getDescription(),
            'availability' => $context->getAvailability(),
            'category_id' => $context->getCategoryId()
        ]);


        return $product;
    }

    public function remove(int $productId): bool
    {
        /** @var Product $product */
        $product = Product::findOrFail($productId);

        return $product->delete();
    }
}