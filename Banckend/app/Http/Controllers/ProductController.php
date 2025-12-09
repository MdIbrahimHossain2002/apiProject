<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // MAIN PAGE
    public function index()
    {
        $products = Product::with('employee')->get();
        $employees = Employee::all();
        return view('products.index', compact('products', 'employees'));
    }

    // CREATE
    public function store(Request $request)
    {
        Product::create($request->all());

        return response()->json([
            'success' => true, 
            'message' => 'Product added successfully'
        ]);
    }

    // EDIT / UPDATE / DELETE (single route)
    public function action(Request $request)
    {
        $type = $request->type;

        if ($type == 'edit') {
            return Product::find($request->id);
        }

        if ($type == 'update') {
            $prod = Product::find($request->id);
            $prod->update($request->all());

            return response()->json([
                'success' => true, 
                'message' => 'Product updated successfully'
            ]);
        }

        if ($type == 'delete') {
            Product::find($request->id)->delete();
            return response()->json([
                'success' => true, 
                'message' => 'Product deleted successfully'
            ]);
        }
    }
}
