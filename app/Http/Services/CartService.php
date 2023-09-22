<?php

namespace App\Http\Services;

use App\Http\Contexts\CartRequestContext;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    public function get(CartRequestContext $context): Collection
    {
        return Cart::where('user_id', $context->getUserId())->with('product')->get();
    }

    public function add(CartRequestContext $context): bool
    {
        $user_id = $context->getUserId();
        $product_id = $context->getProductId();
        $quantity = $context->getQuantity();

        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if ($cart) {
            $cart->quantity += $quantity;
            return $cart->save();
        } else {
            return Cart::create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'user_id' => $user_id,
            ]);
        }
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

    public function remove(int $cartId): bool
    {
        /** @var Cart $cart*/

        $cart = Cart::findOrFail($cartId);
        return $cart->delete();
    }
}