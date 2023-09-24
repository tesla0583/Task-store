<?php

namespace App\Http\Contexts;


class ProductRequestContext
{
    private $name;
    private $price;
    private $image;
    private $description;
    private $availability;
    private $categoryId;

    public function __construct(
        string $name,
        float $price,
        string $image,
        string $description,
        bool $availability,
        int $categoryId
    )
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
        $this->availability = $availability;
        $this->categoryId = $categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAvailability(): bool
    {
        return $this->availability;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

}