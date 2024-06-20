<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\ProductListingApp;
use App\Models\ProductListingAppItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductListingAppItemDataTable;

class ProductListingAppController extends Controller
{
    public function index(ProductListingAppItemDataTable $dataTable)
    {
        $products = Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        return $dataTable->render('admin.product-listing-app.index', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:product_listing_app_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],[
            'product.unique' => 'The product is already in flash sale!'
        ]);


        $productListingAppItem = new ProductListingAppItem();
        $productListingAppItem->product_id = $request->product;
        //$productListingAppItem->flash_sale_id = $flashSaleDate->id;
        $productListingAppItem->show_at_home = $request->show_at_home;
        $productListingAppItem->status = $request->status;
        $productListingAppItem->save();

        toastr('Product Added Successfully!', 'success', 'Success');

        return redirect()->back();
        

    }

    public function chageShowAtHomeStatus(Request $request)
    {
        $productListingAppItem = ProductListingAppItem::findOrFail($request->id);
        $productListingAppItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $productListingAppItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeStatus(Request $request)
    {
        $productListingAppItem = ProductListingAppItem::findOrFail($request->id);
        $productListingAppItem->status = $request->status == 'true' ? 1 : 0;
        $productListingAppItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy(string $id)
    {
        $productListingAppItem = ProductListingAppItem::findOrFail($id);
        $productListingAppItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
