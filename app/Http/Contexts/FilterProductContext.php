<?php

namespace App\Http\Contexts;


class FilterProductContext
{
    private $name;
    private $minPrice;
    private $maxPrice;

    public function __construct(string $name = null, float $minPrice = null, float $maxPrice = null)
    {
        $this->name= $name;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }
}