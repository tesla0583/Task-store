<?php

namespace App\Http\Controllers;

use App\Http\Contexts\FilterProductContext;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $context = new FilterProductContext(
            \request()->input('name'),
            \request()->input('minPrice'),
            \request()->input('maxPrice'),
        );

        return ProductResource::collection($this->productService->get($context));
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     *
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
        return new ProductResource($this->productService->make($request->toContext()));
    }

    /**
     * Display the specified resource.
     * @param int $id
     *
     * @return ProductResource
     */
    public function show(int $id): ProductResource
    {
        return new ProductResource($this->productService->getById($id));
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param int $id
     *
     * @return ProductResource
     */
    public function update(ProductRequest $request, int $id): ProductResource
    {
        return new ProductResource($this->productService->change($request->toContext(), $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     *
     * @return string
     */
    public function destroy(int $id): string
    {
        return response()->json(['status' => $this->productService->remove($id)]);
    }
}
