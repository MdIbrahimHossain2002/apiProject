<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('employee')->get());
    }

    public function store(Request $request)
    {
        $prod = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product created',
            'data' => $prod
        ]);
    }

    public function update(Request $request)
    {
        $prod = Product::find($request->id);

        if (!$prod) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        $prod->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product updated',
            'data' => $prod
        ]);
    }

    public function delete(Request $request)
    {
        $prod = Product::find($request->id);

        if (!$prod) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }

        $prod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted'
        ]);
    }

}
