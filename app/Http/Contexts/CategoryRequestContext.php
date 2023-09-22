<?php

namespace App\Http\Contexts;


class CategoryRequestContext
{
    private $code;
    private $name;
    private $parentId;
    private $description;

    public function __construct(string $code, string $name, ?int $parentId, string $description)
    {
        $this->code = $code;
        $this->name = $name;
        $this->parentId = $parentId;
        $this->description = $description;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

}