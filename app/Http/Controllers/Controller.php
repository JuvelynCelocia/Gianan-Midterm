<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
     public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by stock
        if ($request->has('stock')) {
            $query->where('stock', '>=', $request->stock);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        return $query->get();
    }

    // ✅ Create Product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric|min:0.01',
            'cost_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock_level' => 'required|integer|min:0',
            'category' => 'required'
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    // ✅ Get Single Product
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    // ✅ Update Product (no negative values)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required',
            'sku' => 'sometimes|required|unique:products,sku,' . $id,
            'price' => 'sometimes|numeric|min:0.01',
            'cost_price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'min_stock_level' => 'sometimes|integer|min:0'
        ]);

        $product->update($request->all());

        return response()->json($product, 200);
    }

    // ✅ Delete Product
    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}

