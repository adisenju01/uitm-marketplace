<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendServiceController extends Controller
{
    /** Show product detail page */
    public function showService(string $slug)
    {
        // $service = Service::with(['vendor'])->where('slug', $slug)->where('status', 1)->first();
        $service = Service::with(['vendor'])->where('slug', $slug)->where('status', 1)->first();
        
        return view('frontend.pages.service-detail', compact('service'));
    }
}
