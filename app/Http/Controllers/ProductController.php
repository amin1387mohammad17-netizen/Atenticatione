<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('products'));
    }

    public function index()
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        return view('products.show', compact('product'));
    }
}
