<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ServiceListingController extends Controller
{
    public function index()
    {
        //Fetch approved products
        $approvedServices = Service::where('is_approved', 1)->get();
        
        //Pass the correct variable name to the view
        return view('frontend.pages.service-listing', compact('approvedServices'));

    }
}
