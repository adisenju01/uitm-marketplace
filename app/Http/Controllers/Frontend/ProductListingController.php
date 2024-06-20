<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductListingAppItem;
use App\Models\Product;


class ProductListingController extends Controller
{
    public function index()
    {
        // $productListingAppItem = ProductListingAppItem::where('show_at_home', 1)->where('status', 1)->get();
        // return view('frontend.pages.product-listing', compact('productListingAppItem'));

        //Fetch approved products
      
        $approvedProducts = Product::with(['vendor'])->where('status', 1)->where('is_approved', 1)->get();
      
        
        //Pass the correct variable name to the view
        return view('frontend.pages.product-listing', compact('approvedProducts'));
        


    }
}
