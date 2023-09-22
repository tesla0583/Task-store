<?php

namespace App\Http\Contexts;


class CartRequestContext
{
    private $productId;
    private $quantity;
    private $userId;

    public function __construct(int $productId, int $quantity, int $userId)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->userId = $userId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}