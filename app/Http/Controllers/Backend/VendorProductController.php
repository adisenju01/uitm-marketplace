<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorProductDataTable;
use App\Traits\ImageUploadTrait;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('vendor.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
         /** Check if it's the owner of the product */
         if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        return view('vendor.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'status' => ['required']
        ]);

        $product = Product::findOrFail($id);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

        $product->thumb_image = empty(!$imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->is_approved = $product->is_approved;
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Delte the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        // $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        // foreach($galleryImages as $image){
        //     $this->deleteImage($image->image);
        //     $image->delete();
        // }

        /** Delete product variants if exist */
        // $variants = ProductVariant::where('product_id', $product->id)->get();

        // foreach($variants as $variant){
        //     $variant->productVariantItems()->delete();
        //     $variant->delete();
        // }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }
}
