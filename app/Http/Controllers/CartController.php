<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Http\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     * @param CartRequest $request
     *
     * @return CartResource
     */
    public function index(CartRequest $request): CartResource
    {
        return new CartResource($this->cartService->get($request->toContext()));
    }

    /**
     * Store a newly created resource in storage.
     * @param CartRequest $request
     *
     * @return string
     */
    public function store(CartRequest $request): string
    {
        return response()->json(['success' => $this->cartService->add($request->toContext())]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     *
     * @return string
     */
    public function destroy(int $id): string
    {
        return response()->json(['success' => $this->cartService->remove($id)]);
    }
}
