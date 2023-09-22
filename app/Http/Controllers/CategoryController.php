<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(CategoryRequest $request)
    {
        return new CategoryResource($this->categoryService->make($request->toContext()));
    }

    public function destroy(int $id)
    {
        return response()->json(['status' => $this->categoryService->remove($id)]);
    }
}
