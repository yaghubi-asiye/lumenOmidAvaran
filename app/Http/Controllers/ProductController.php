<?php

namespace App\Http\Controllers;
use App\Models\Product;

class ProductController extends Controller
{
  
    public function indexWithComments()
    {
        $products = Product::with('comments')->get();
        return $this->jsonResponse($products, 200);
    }

    public function showWithComments($id)
    {
        $product = Product::with('comments')->find($id);
        if (!$product) {
            return $this->jsonResponse(['message' => 'Product not found'], 404);
        }
       
        return $this->jsonResponse($product, 200);
    }

    public function store()
    {
        $validator = $this->validateData();

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = Product::create(request()->all());

        return $this->jsonResponse($product, 201);
    }

    private function validateData()
    {
        return validator(request()->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'string',
            'brand' => 'string',
        ]);
    }
    protected function jsonResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }


}
