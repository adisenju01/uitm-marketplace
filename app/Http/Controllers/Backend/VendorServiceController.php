<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorServiceDataTable;
use App\Traits\ImageUploadTrait;
use Str;

class VendorServiceController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorServiceDataTable $dataTable)
    {
        return $dataTable->render('vendor.service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendor.service.create');
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
            'short_description' => ['required', 'max: 600'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $service = new Service();
        $service->thumb_image = $imagePath;
        $service->name = $request->name;
        $service->slug = Str::slug($request->name);
        $service->vendor_id = Auth::user()->vendor->id;
        $service->short_description = $request->short_description;
        $service->price = $request->price;
        $service->status = $request->status;
        $service->is_approved = 0;
        $service->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('vendor.service.index');
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
        $service = Service::findOrFail($id);
         /** Check if it's the owner of the product */
         if($service->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        return view('vendor.service.edit', compact('service'));
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
            'short_description' => ['required', 'max: 600'],
            'status' => ['required']
        ]);

        $service = Service::findOrFail($id);

        if($service->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads', $service->thumb_image);

        $service->thumb_image = empty(!$imagePath) ? $imagePath : $service->thumb_image;
        $service->name = $request->name;
        $service->slug = Str::slug($request->name);
        $service->vendor_id = Auth::user()->vendor->id;
        $service->short_description = $request->short_description;
        $service->price = $request->price;
        $service->status = $request->status;
        $service->is_approved = $service->is_approved;
        $service->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        if($service->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Delte the main product image */
        $this->deleteImage($service->thumb_image);

        // /** Delete product gallery images */
        // $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        // foreach($galleryImages as $image){
        //     $this->deleteImage($image->image);
        //     $image->delete();
        // }

        $service->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->status = $request->status == 'true' ? 1 : 0;
        $service->save();

        return response(['message' => 'Status has been updated!']);
    }
}
