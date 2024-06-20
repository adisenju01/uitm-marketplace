<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendProductController extends Controller
{
    /** Show product detail page */
    public function showProduct(string $slug)
    {
        //$product is for product-detail.blade to call from the Product column database
        // $product = Product::with(['vendor'])->where('slug', $slug)->where('status', 1)->first();
        $product = Product::with(['vendor'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }

}
